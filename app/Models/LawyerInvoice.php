<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LawyerInvoice extends Model
{

    const STATUS_CONFIRMED = 1;
    const STATUS_PENDING = 1;

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'lawyer_case_id',
        'status',
        'amount',
        'court_fees',
        'executor_fees',
        'attorneys_fees',
        'other',
    ];

    public function LawyerCase()
    {
        return $this->belongsTo(LawyerCase::class, 'lawyer_case_id', 'id');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', '=', LawyerInvoice::STATUS_CONFIRMED);
    }
}
