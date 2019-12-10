<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UserBalance;
use App\Models\UserBalanceHistory;
use App\Models\BalanceBank;
use App\Models\BalanceBankHistory;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $balance = UserBalance::with('user')->where('user_id', $user_id)->first();

        return view('balance.balance', compact('balance', 'user_id'));
    }

    public function topup(Request $request)
    {
        $user_id    = $request->user_id;
        $isi        = $request->isi;
        $bank_balance = BalanceBank::first();
        $user_balance = UserBalance::with('user')->where('user_id', $user_id)->first();

        // mengurangi pengirim
        if($isi <= 0)
        {
            return redirect()->back()->with('danger', 'Isikan data dengan benar');
        }

        if($bank_balance->balance < $isi)
        {
            return redirect()->back()->with('danger', 'Uang tidak cukup!');
        }

        // insert histori bank
        $ins_bank_history = array(
            'balance_bank_id'   => $bank_balance->id,
            'balance_before'    => $bank_balance->balance,
            'balance_after'     => $bank_balance->balance - $isi,
            'activity'          => 'Topup Rp. '.number_format($isi, 0, ',', '.').' by '.$user_balance->user->name,
            'type'              => 'debit',
            'ip'                => $_SERVER['REMOTE_ADDR'],
            'location'          => 'Yogyakarta/Indonesia',
            'user_agent'        => $user_balance->user->name,
            'author'            => $user_balance->user->name,
            'created_at'        => date('Y-m-d H:s:i'),
        );

        BalanceBankHistory::insert($ins_bank_history);

        // pengurangan balance bank
        $bank = BalanceBank::findOrFail($bank_balance->id);

        $bank->balance = $bank_balance->balance - $isi;
        $bank->balance_archive = $bank_balance->balance;

        $bank->save();

        // insert histori user
        $ins_user_history = array(
            'user_balance_id'   => $user_balance->id,
            'balance_before'    => $user_balance->balance,
            'balance_after'     => $user_balance->balance + $isi,
            'activity'          => 'Topup Rp. '.number_format($isi, 0, ',', '.'),
            'type'              => 'credit',
            'ip'                => $_SERVER['REMOTE_ADDR'],
            'location'          => 'Yogyakarta/Indonesia',
            'user_agent'        => $user_balance->user->name,
            'author'            => $user_balance->user->name,
            'created_at'        => date('Y-m-d H:s:i'),
        );

        UserBalanceHistory::insert($ins_user_history);

        // penambahan balance user
        $user = UserBalance::findOrFail($user_balance->id);

        $user->balance = $user_balance->balance + $isi;
        $user->balance_archive = $user_balance->balance;

        $user->save();

        return redirect()->route('person')->with('success', 'Topup berhasil!');
    }
}
