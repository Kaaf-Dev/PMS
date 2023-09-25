<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LawyerInvoice extends Model
{

    const STATUS_CONFIRMED = 1;
    const STATUS_PENDING = 2;

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

    public function scopePending($query)
    {
        return $query->where('status', '=', LawyerInvoice::STATUS_PENDING);
    }

    public function calculateAmount()
    {
        return ($this->court_fees + $this->executor_fees + $this->attorneys_fees + $this->other);
    }

    public function getCourtFeesHumanAttribute()
    {
        $value = '-';
        if ($this->court_fees) {
            $value = number_format($this->court_fees, '2');
        }
        return $value;
    }

    public function getExecutorFeesHumanAttribute()
    {
        $value = '-';
        if ($this->executor_fees) {
            $value = number_format($this->executor_fees, '2');
        }
        return $value;
    }

    public function getAttorneysFeesHumanAttribute()
    {
        $value = '-';
        if ($this->attorneys_fees) {
            $value = number_format($this->attorneys_fees, '2');
        }
        return $value;
    }

    public function getOtherHumanAttribute()
    {
        $value = '-';
        if ($this->other) {
            $value = number_format($this->other, '2');
        }
        return $value;
    }

    public function getAmountHumanAttribute()
    {
        $value = '-';
        if ($this->amount) {
            $value = number_format($this->amount, '2');
        }
        return $value;
    }

    public function getStatusStringAttribute()
    {
        $status_list = [
            LawyerInvoice::STATUS_CONFIRMED => 'معتمدة',
            LawyerInvoice::STATUS_PENDING => 'قيد المعالجة',
        ];
        return $status_list[$this->status ?? LawyerInvoice::STATUS_PENDING];
    }

    public function getStatusClassAttribute()
    {
        $status_list = [
            LawyerInvoice::STATUS_CONFIRMED => 'success',
            LawyerInvoice::STATUS_PENDING => 'warning',
        ];
        return $status_list[$this->status ?? LawyerInvoice::STATUS_PENDING];
    }
}
