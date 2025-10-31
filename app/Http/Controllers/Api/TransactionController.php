<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;

class TransactionController extends Controller
{
    public function index()
    {
        try {
            $userId = auth()->id();
            $user = auth()->user();

            if ($user->hasRole('user')) {
                $transactions = Transaction::with(['psikolog:id,name,photo,last_seen', 'pasien:id,name'])
                    ->where('id_pasien', $userId)
                    ->orderBy('updated_at', 'desc')
                    ->get()
                    ->map(function ($transaction) {
                        $transaction->created_at = Carbon::parse($transaction->created_at)
                            ->setTimezone('Asia/Jakarta')
                            ->format('Y-m-d H:i:s');
                        return $transaction;
                    });
            } else {
                $transactions = Transaction::with(['psikolog:id,name,photo,last_seen', 'pasien:id,name'])
                    ->where('id_psikolog', $userId)
                    ->orderBy('updated_at', 'desc')
                    ->get()
                    ->map(function ($transaction) {
                        $transaction->created_at = Carbon::parse($transaction->created_at)
                            ->setTimezone('Asia/Jakarta')
                            ->format('Y-m-d H:i:s');
                        return $transaction;
                    });
            }

            return response()->json([
                'status' => true,
                'message' => 'Data riwayat berhasil diambil',
                'data' => $transactions
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'psikolog_id' => 'required|exists:users,id'
            ]);

            $user = auth()->user();
            if (!$user->hasRole('user')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Hanya user yang dapat membuat transaksi'
                ], 403);
            }

            // Cek apakah sudah ada transaksi yang aktif dengan psikolog ini
            $existingTransaction = Transaction::where('id_pasien', $user->id)
                ->where('id_psikolog', $request->psikolog_id)
                ->whereIn('status', ['Belum dibayar', 'Dibayar'])
                ->first();

            if ($existingTransaction) {
                return response()->json([
                    'status' => true,
                    'message' => 'Transaksi sudah ada',
                    'data' => [
                        'redirect_url' => null,
                        'snap_token' => $existingTransaction->snap_token,
                        'transaction_status' => $existingTransaction->status
                    ]
                ], 200);
            }

            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('midtrans.is_production');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $psikolog = \App\Models\User::with('detailPsikolog')->find($request->psikolog_id);
            if (!$psikolog || !$psikolog->detailPsikolog) {
                return response()->json([
                    'status' => false,
                    'message' => 'Data psikolog tidak ditemukan atau belum lengkap'
                ], 404);
            }
            
            $harga = $psikolog->detailPsikolog->harga;

            // Generate ID transaksi dengan format TRX-YYYYMMDD-RANDOM7
            $date = now()->format('Ymd');
            $random = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 7));
            $idTransaksi = "TRX-{$date}-{$random}";

            $transaction = Transaction::create([
                'id_transaksi' => $idTransaksi,
                'id_pasien' => $user->id,
                'id_psikolog' => $request->psikolog_id,
                'harga' => $harga,
                'status' => 'Belum dibayar'
            ]);

            $params = array(
                'transaction_details' => array(
                    'order_id' => $transaction->id_transaksi,
                    'gross_amount' => $harga,
                ),
                'customer_details' => array(
                    'first_name' => $user->name,
                    'email' => $user->email,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $transaction->snap_token = $snapToken;
            $transaction->save();

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat',
                'snap_token' => $snapToken,
                'redirect_url' => null
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $request->validate([
                'snap_token' => 'required|string',
                'status' => 'required|string'
            ]);

            $transaction = Transaction::where('snap_token', $request->snap_token)->first();
            
            if (!$transaction) {
                return response()->json([
                    'status' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ], 404);
            }

            $transaction->status = $request->status;
            $transaction->save();

            return response()->json([
                'status' => true,
                'message' => 'Status transaksi berhasil diperbarui',
                'data' => $transaction
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function checkStatus(Request $request)
    {
        try {
            $request->validate([
                'snap_token' => 'required|string'
            ]);

            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('midtrans.is_production');

            $transaction = Transaction::where('snap_token', $request->snap_token)->first();
            if (!$transaction) {
                return response()->json([
                    'status' => false,
                    'message' => 'Transaksi tidak ditemukan'
                ], 404);
            }

            $status = \Midtrans\Transaction::status($transaction->id_transaksi);
            
            // Cast response to stdClass object
            if (!is_object($status)) {
                $status = (object) $status;
            }
            
            $transactionStatus = (string) $status->transaction_status;

            return response()->json([
                'status' => true,
                'message' => 'Status transaksi berhasil diambil',
                'transaction_status' => $transactionStatus
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getMidtransConfig()
    {
        try {
            return response()->json([
                'status' => true,
                'message' => 'Konfigurasi Midtrans berhasil diambil',
                'data' => [
                    'client_key' => config('midtrans.client_key'),
                    'snap_url' => config('midtrans.snap_url'),
                    'is_production' => config('midtrans.is_production')
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
} 