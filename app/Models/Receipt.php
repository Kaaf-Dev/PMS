<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipt extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'transaction_id',
        'no',
        'amount',
        'date',
        'notes',
    ];

    protected $dates = [
        'date',
    ];

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
