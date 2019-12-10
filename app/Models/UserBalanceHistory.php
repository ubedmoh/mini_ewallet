<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBalanceHistory extends Model
{
    protected $table = 'user_balance_history';

    protected $fillable = [
        'user_balance_id', 'balance_before', 'balance_after', 'activity', 'type', 'ip', 'location', 'user_agent', 'author',
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
