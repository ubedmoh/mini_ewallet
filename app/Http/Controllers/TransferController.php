<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\UserBalance;
use App\Models\UserBalanceHistory;
use App\Models\BalanceBank;
use App\Models\BalanceBankHistory;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();

        $all_user = User::where('id', '!=', $user_id)->get();

        $balance = UserBalance::with('user')->where('user_id', $user_id)->first();

        return view('transfer.transfer', compact('user_id', 'all_user', 'balance'));
    }

    public function transfer(Request $request)
    {
        $to     = UserBalance::with('user')->where('user_id', $request->to)->first();
        $from   = UserBalance::with('user')->where('user_id', $request->user_id)->first();
        $isi    = $request->isi;

        // mengurangi pengirim
        if($isi <= 0)
        {
            return redirect()->back()->with('danger', 'Isikan data dengan benar');
        }

        if($isi > $from->balance)
        {
            return redirect()->back()->with('danger', 'Uang tidak cukup!');
        }

        // insert history pengirim
        $ins_pengirim = array(
            'user_balance_id'   => $from->id,
            'balance_before'    => $from->balance,
            'balance_after'     => $from->balance - $isi,
            'activity'          => $from->user->name.' transfer to '.$to->user->name.' Rp. '.$isi,
            'type'              => 'debit',
            'ip'                => $_SERVER['REMOTE_ADDR'],
            'location'          => 'Yogyakarta/Indonesia',
            'user_agent'        => $from->user->name,
            'author'            => $from->user->name,
            'created_at'        => date('Y-m-d H:s:i'),
        );

        UserBalanceHistory::insert($ins_pengirim);

        // mengurangi balance pengirim
        $from_balance = UserBalance::findOrFail($from->id);

        $from_balance->balance = $from->balance - $isi;
        $from_balance->balance_archive = $from->balance;

        $from_balance->save();

        // insert history penerima
        $ins_penerima = array(
            'user_balance_id'   => $to->id,
            'balance_before'    => $to->balance,
            'balance_after'     => $to->balance + $isi,
            'activity'          => $to->user->name.' transfer from '.$from->user->name.' Rp. '.$isi,
            'type'              => 'credit',
            'ip'                => $_SERVER['REMOTE_ADDR'],
            'location'          => 'Yogyakarta/Indonesia',
            'user_agent'        => $to->user->name,
            'author'            => $to->user->name,
            'created_at'        => date('Y-m-d H:s:i'),
        );

        UserBalanceHistory::insert($ins_penerima);

        // menambah balance penerima
        $to_balance = UserBalance::findOrFail($to->id);

        $to_balance->balance = $to->balance + $isi;
        $to_balance->balance_archive = $to->balance;

        $to_balance->save();

        return redirect()->route('transfer')->with('success', 'Berhasil transfer!');
    }
}
