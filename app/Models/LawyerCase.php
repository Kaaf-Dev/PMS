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
        'court_id',
        'lawyer_id',
        'contract_id',
        'status_id',
        'case_no',
        'decision',
        'first_side',
        'second_side',
        'amount',
        'collected_amount',
    ];

    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }

    public function court()
    {
        return $this->belongsTo(Court::class, 'court_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(lawyerCaseStatus::class, 'status_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(LawyerInvoice::class, 'lawyer_case_id', 'id');
    }

    public function getAmountHumanAttribute()
    {
        return number_format($this->amount, '2') . ' د.ب.';
    }

}
