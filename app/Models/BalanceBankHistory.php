<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BalanceBankHistory extends Model
{
    protected $table = 'balance_bank_history';

    protected $fillable = [
        'balance_bank_id', 'balance_before', 'balance_after', 'activity', 'type', 'ip', 'location', 'user_agent', 'author'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];
}
