<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback(Request $request)
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
