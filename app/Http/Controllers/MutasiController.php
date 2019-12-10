<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userbalance;
use App\Models\UserBalanceHistory;
use Illuminate\Support\Facades\Auth;

class MutasiController extends Controller
{
    public function index(Request $request)
    {
        return view('mutasi.mutasi');
    }

    public function getmutasi(Request $request)
    {
        $user_id = Auth::id();

        $mulai = $request->tglmulai;
        $akhir = $request->tglakhir;

        if($akhir == null || $mulai == null)
		{
			echo '<tr><td colspan="6">No Data</td><tr>';
		}elseif($mulai > $akhir)
		{
			echo '<tr><td colspan="6">No Data</td><tr>';
		}else{
            $user_bal = UserBalance::where('user_id', $user_id)->first();
            $bal_history = UserBalanceHistory::where('user_balance_id', $user_bal->id)
                                                ->whereDate('created_at', '>=', $mulai)
                                                ->whereDate('created_at', '<=', $akhir)
                                                ->get();
			// echo json_encode($data);die;
			$i = 1;
			foreach ($bal_history as $value) {
				echo '<tr>';
				echo '<td>'.$i.'</td>';
				echo '<td>'.date('d-M-Y H:i', strtotime($value->created_at)).'</td>';
                echo '<td>'.$value->activity.'</td>';
                if($value->type == 'credit')
                {
                    echo '<td>Rp. '.number_format(($value->balance_after - $value->balance_before), 0, ',', '.').'</td>';
                    echo '<td align="center"> - </td>';
                }else{

                    echo '<td align="center"> - </td>';
                    echo '<td>'.($value->balance_before - $value->balance_after).'</td>';
                }
				echo '<td>'.$value->balance_after.'</td>';
				echo '<tr>';
				$i++;
			}
			if($bal_history->count() <= 0 )
				echo '<tr><td colspan="6">No Data</td><tr>';
		}
    }
}
