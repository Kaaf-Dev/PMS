<?php

namespace App\Models;

use Carbon\Carbon;
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

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->no) {
                $model->no = $model->getNextNo();
            }

            if (!$model->date) {
                $model->date = Carbon::now();
            }

            if (!$model->due) {
                $model->due = Carbon::now()->addDays(15);
            }

        });
    }


    public function Contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function Type()
    {
        return $this->belongsTo(InvoiceType::class, 'type', 'id');
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

    public function getIsPartialPaidAttribute()
    {
        $paid_amount = $this->paid_amount;
        $amount = $this->amount;
        return (
            0 < $paid_amount and $paid_amount  < $amount
        );
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

        } elseif($this->is_partial_paid) {
            $status_class = 'warning';

        } else {
            $status_class = 'danger';

        }

        return $status_class;
    }

    public function getPaidStringAttribute()
    {
        if ($this->is_paid) {
            $paid_string = 'مدفوعة';

        } elseif($this->is_partial_paid) {
            $paid_string = 'مدفوعة جزئيًا';

        } else {
            $paid_string = 'غير مدفوعة';

        }

        return $paid_string;
    }

    public function getNextNo()
    {
        $carbon = Carbon::now();
        $year = $this->date ? $this->date->format('Y') : $carbon->format('Y');
        $month = $this->date ? $this->date->format('m') : $carbon->format('m');
        $contract_id = $this->contract_id ?? 0;

        $max_no = self::where('contract_id', '=', $contract_id)
            ->whereYear('date', '=', $year)
            ->whereMonth('date', '=', $month)
            ->where('no', 'like', '_________')
            ->max('no');

        if ($max_no) { // no exists and increase it by one
            $max_no_array = str_split($max_no, 6);
            $no = (int) ($max_no_array[1] + 1);
            $next_no = $max_no_array[0];
            $next_no .= str_pad($no, 3, '0', STR_PAD_LEFT);

        } else { // create new no
            $next_no = $year . $month . '001';
        }

        return $next_no;
    }

}
