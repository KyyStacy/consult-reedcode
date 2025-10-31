<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $transactions = Transaction::with(['psikolog', 'pasien'])
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('id_transaksi', 'like', '%' . $searchTerm . '%');
            })
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('admin.transaksi', compact('transactions'));
    }

    public function Riwayat()
    {
        $userId = Auth::user()->id;

        if (Auth::user()->hasRole('user')) {
            $transactions = Transaction::with(['psikolog', 'pasien'])
                ->where('id_pasien', $userId)
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        } else {
            $transactions = Transaction::with(['psikolog', 'pasien'])
                ->where('id_psikolog', $userId)
                ->orderBy('updated_at', 'desc')
                ->paginate(10);
        }

        return view('home.riwayat', compact('transactions'));
    }

    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction(Request $request, $psikologId)
    {
        $userId = Auth::id();

        $existingTransaction = Transaction::where('id_pasien', $userId)
            ->where('id_psikolog', $psikologId)
            ->whereIn('status', ['Belum dibayar', 'Dibayar'])
            ->first();

        if ($existingTransaction) {
            if ($existingTransaction->status === 'Dibayar') {
                return response()->json([
                    'redirect_url' => route('chat', [
                        'from_user_id' => $userId,
                        'user' => $psikologId,
                        'transaction_id' => $existingTransaction->id,
                    ])
                ]);
            } else {
                return $this->getOrCreateSnapToken($existingTransaction);
            }
        }

        $transaction = new Transaction();
        $transaction->id_transaksi = $this->generateUniqueTransactionId();
        $transaction->id_pasien = $userId;
        $transaction->id_psikolog = $psikologId;
        $transaction->harga = User::find($psikologId)->detailPsikolog->harga;
        $transaction->status = 'Belum dibayar';
        $transaction->save();

        return $this->getOrCreateSnapToken($transaction);
    }

    private function generateUniqueTransactionId()
    {
        do {
            $id_transaksi = strtoupper('TRX-' . date('Ymd') . '-' . Str::random(7));
            $existingTransaction = Transaction::where('id_transaksi', $id_transaksi)->first();
        } while ($existingTransaction);

        return $id_transaksi;
    }

    private function getOrCreateSnapToken($transaction)
    {
        if ($transaction->snap_token) {
            return response()->json(['snap_token' => $transaction->snap_token]);
        }

        $psikolog = User::find($transaction->id_psikolog);
        $amount = $psikolog->detailPsikolog->harga;

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->id_transaksi,
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'callbacks' => [
                'finish' => route('transaksi.finish'),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $transaction->snap_token = $snapToken;
            $transaction->save();

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function finishTransaction(Request $request)
    {
        $orderId = $request->query('order_id');
        $statusCode = $request->query('status_code');
        $transactionStatus = $request->query('transaction_status');

        $transaction = Transaction::where('id_transaksi', $orderId)->firstOrFail();

        if ($statusCode == '200' && $transactionStatus == 'settlement') {
            $transaction->status = 'Dibayar';
            $transaction->save();
        }

        return redirect()->route('list-psikolog')->with('success', 'Pembayaran berhasil. Anda sekarang dapat memulai konsultasi.');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
            'status' => 'required|string',
        ]);

        $transaction = Transaction::where('id_transaksi', $request->order_id)->firstOrFail();
        $transaction->status = $request->status;
        $transaction->save();

        return response()->json(['success' => true]);
    }

    public function handlePaymentCallback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $transaction = Transaction::where('id_transaksi', $request->order_id)->firstOrFail();

            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $transaction->status = 'Dibayar';
            } elseif ($request->transaction_status == 'cancel' || $request->transaction_status == 'expire') {
                $transaction->status = 'Dibatalkan';
            } elseif ($request->transaction_status == 'pending') {
                $transaction->status = 'Belum dibayar';
            }

            $transaction->save();

            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error'], 403);
        }
    }
}