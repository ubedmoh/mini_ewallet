<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BalanceBank;
use App\Models\BalanceBankHistory;

class BankController extends Controller
{
    public function balance()
    {
        $data = BalanceBank::first();

        if($data)
        {
            $return = array(
                'status'    => 'success',
                'data'      => $data
            );
        }else{
            $return = array(
                'status'    => 'success',
                'message'      => 'data not found'
            );
        }

        return response()->json($return);
    }

    public function topup(Request $request)
    {
        $isi = $request->topup;
        $bank_balance = BalanceBank::first();

        // insert histori bank
        $ins_bank_history = array(
            'balance_bank_id'   => $bank_balance->id,
            'balance_before'    => $bank_balance->balance,
            'balance_after'     => $bank_balance->balance + $isi,
            'activity'          => 'Topup Rp. '.number_format($isi, 0, ',', '.').' into bank',
            'type'              => 'credit',
            'ip'                => $_SERVER['REMOTE_ADDR'],
            'location'          => 'Yogyakarta/Indonesia',
            'user_agent'        => 'Bank',
            'author'            => 'Bank',
        );

        BalanceBankHistory::insert($ins_bank_history);

        $bank = BalanceBank::findOrFail($bank_balance->id);

        $bank->balance = $bank_balance->balance + $isi;
        $bank->balance_archive = $bank_balance->balance;

        $bank->save();

        $return = array(
            'status'    => 'success',
            'data'      => $bank,
        );

        return response()->json($return);
    }
}
