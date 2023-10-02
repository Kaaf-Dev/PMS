<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionsDirectPay extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'transactions_direct_pays';
    protected $fillable = [
        'transaction_id',
        'gatewayEntryPoint',
        'amount',
        'authenticationStatus',
        'currency',
        'merchantAmount',
        'merchantCategoryCode',
        'FAILURE',
        'response_decoded'
    ];

}
