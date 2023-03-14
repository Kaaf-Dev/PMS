<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Invoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    const TYPE_RENTAL = 1;
    const TYPE_SERVICES = 2;
    const TYPE_OTHER = 99;

    protected $fillable = [
        'contract_id',
        'no',
        'type',
        'amount',
        'date',
        'due',
    ];

    protected $dates = [
        'date',
        'due',
    ];

    public function Contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    public function scopePaid($query)
    {
        $query->whereExists(function ($query) {
            $query->selectRaw('1')
                ->from('receipts')
                ->whereColumn('receipts.invoice_id', '=', 'invoices.id')
                ->whereColumn('receipts.amount', '>=', 'invoices.amount');
        });

    }

    public function getIsPaidAttribute()
    {
        return $this->paid_amount >= $this->amount;
    }

    public function getPaidAmountAttribute()
    {
        return Receipt::where([
            ['invoice_id', '=', $this->id],
        ])->sum('amount');
    }

    public function getTypeStringAttribute()
    {
        $strings = [
            self::TYPE_RENTAL => 'بدل إيجار',
            self::TYPE_SERVICES => 'بدل خدمات',
            self::TYPE_OTHER => 'أخرى',
        ];

        return $strings[$this->type ?? 1];
    }

    public function getPaidClassAttribute()
    {
        if ($this->is_paid) {
            $status_class = 'success';
        } else {
            $status_class = 'danger';
        }
        return $status_class;
    }

    public function getPaidStringAttribute()
    {
        if ($this->is_paid) {
            $paid_string = 'مدفوعة';
        } else {
            $paid_string = 'غير مدفوعة';
        }
        return $paid_string;
    }
}
