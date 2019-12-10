<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    protected $table = 'user_balance';

    protected $fillable = [
        'user_id', 'balance', 'balance_archive'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function history()
    {
        return $this->hasMany('App\Models\UserBalanceHistory', 'user_balance_id', 'id');
    }
}
