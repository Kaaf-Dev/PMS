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

    public function discounts()
    {
        return $this->hasMany(Discount::class, 'invoice_id', 'id');
    }

    public function scopePaid($query)
    {
        $query->whereExists(function ($query) {
            $query->selectRaw('1')
                ->from('receipts')
                ->leftJoin('discounts', 'receipts.invoice_id', '=', 'discounts.invoice_id')
                ->whereColumn('receipts.invoice_id', '=', 'invoices.id')
                ->groupBy('invoices.id')
                ->havingRaw('SUM(receipts.amount) + IFNULL(SUM(discounts.amount), 0) >= invoices.amount');
        });

    }

    public function scopeUnpaid($query)
    {
        $query->where(function ($query) {
            $query->orWhereDoesntHave('receipts', function ($subQuery) {
                $subQuery->whereNull('receipts.deleted_at');
            })->orWhere(function ($subQuery) {
                $subQuery->whereExists(function ($existsQuery) {
                    $existsQuery->select(DB::raw(1))
                        ->from('receipts')
                        ->whereColumn('receipts.invoice_id', 'invoices.id')
                        ->whereNull('receipts.deleted_at')
                        ->groupBy('receipts.invoice_id')
                        ->havingRaw('SUM(receipts.amount) + IFNULL((SELECT SUM(amount) FROM discounts WHERE invoice_id = invoices.id AND discounts.deleted_at IS NULL), 0) < invoices.amount');
                });
            });
        })->orWhere(function ($query) {
            $query->orWhereDoesntHave('discounts', function ($subQuery) {
                $subQuery->whereNull('discounts.deleted_at');
            })->orWhere(function ($subQuery) {
                $subQuery->whereExists(function ($existsQuery) {
                    $existsQuery->select(DB::raw(1))
                        ->from('discounts')
                        ->whereColumn('discounts.invoice_id', 'invoices.id')
                        ->groupBy('discounts.invoice_id')
                        ->havingRaw('SUM(discounts.amount) >= invoices.amount');
                });
            });
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
        return $this->receipts->sum('amount');
    }

    public function getUnPaidAmountAttribute(){
        return $this->amount - $this->getPaidAmountAttribute();
    }

    public function getUnPaidAmountHumanAttribute()
    {
        return number_format($this->getUnPaidAmountAttribute(), '2');
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

    public function getDueHumanAttribute()
    {
        return $this->due->format('Y/m/d');
    }

    public function getAmountAttribute()
    {
        return $this->getRawOriginal('amount') - $this->discounts()->sum('amount');
    }

    public function getAmountHumanAttribute()
    {
        return number_format($this->amount ?? 0, 2);
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
