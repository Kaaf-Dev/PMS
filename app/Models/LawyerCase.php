<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LawyerCase extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'lawyer_id',
        'contract_id',
        'subject',
        'needed_action',
        'action',
        'court_date',
        'decision',
        'decision_details',
        'attorneys_fees',
        'court_fees',
        'first_side',
        'second_side',
        'amount',
        'collected_amount',
    ];

    protected $casts = [
        'court_date' => 'date:Y-m-d',
    ];

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }

    public function getAmountHumanAttribute()
    {
        return number_format($this->amount, '2') . ' د.ب.';
    }

    public function invoices()
    {
        return $this->hasMany(LawyerInvoice::class, 'lawyer_case_id', 'id');
    }

}
