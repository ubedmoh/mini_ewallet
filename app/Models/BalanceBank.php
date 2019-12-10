<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceBank extends Model
{
    protected $table = 'balance_bank';

    protected $fillable = [
        'balance', 'balance_archive', 'code', 'enable'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function bank_history()
    {
        return $this->hasMany('App\Models\BalanceBankHistory', 'balance_bank_id', 'id');
    }
}
