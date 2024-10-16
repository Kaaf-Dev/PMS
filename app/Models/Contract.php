<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory;
    use SoftDeletes;

    const CONTRACT_STATUS_ACTIVE = 1;
    const CONTRACT_STATUS_INACTIVE = 0;
    const CONTRACT_STATUS_EXPIRE = 2;

    protected $fillable = [
        'user_id',
        'notes',
        'active',
        'start_at',
        'end_at',
    ];

    protected $casts = [
        'active' => 'boolean',
        'cost' => 'float',
    ];

    protected $dates = [
        'start_at',
        'end_at',
    ];

    protected $appends = [
        'cost',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(ContractAttachment::class, 'contract_id');
    }

    public function LawyerCase()
    {
        return $this->hasOne(LawyerCase::class, 'contract_id', 'id');
    }

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class, 'contract_apartment');
    }

    public function contractApartments()
    {
        return $this->hasMany(ContractApartment::class, 'contract_id', 'id');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function unPaidInvoices()
    {
        return $this->hasMany(Invoice::class)->unPaid();
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'contract_id', 'id');
    }

    public function contractReplies()
    {
        return $this->hasMany(ContractReply::class, 'contract_id', 'id');
    }

    public function maintenanceInvoices()
    {
        return $this->hasManyThrough(
            MaintenanceInvoice::class,
            Ticket::class,
            'contract_id',
            'ticket_id',
            'id',
            'id',
        );
    }

    public function scopeActive($query, Carbon $date = null)
    {
        $current_date = $date ?? Carbon::now(); // get date from parameter or get now date
        $query->where('active', '=', '1') // check activation flag
        ->whereDate('start_at', '<=', $current_date);
//        ->where(function($query) use ($current_date){ // check date flag
//            $query->whereRaw('? BETWEEN `start_at` AND `end_at`', [$current_date->format('Y-m-01')])
//                ->orWhereRaw('`start_at` <= ? and `end_at` IS NULL', [$current_date->format('Y-m-01')]);
//        });
        return $query;
    }

    public function scopeContractGenerateActive($query)
    {
        return $query->whereIn('active', [self::CONTRACT_STATUS_ACTIVE, self::CONTRACT_STATUS_EXPIRE]);
    }

    public function getActiveStatusAttribute()
    {
        $current_date = Carbon::now();
        $start_at = $this->start_at;
        $end_at = $this->end_at;
        $is_active = false;

        if ($this->active) {
            if ($start_at and $end_at) {
                $is_active = $current_date->between($start_at, $end_at);
                if (!$is_active) {
                    $is_active = 2;
                }
            } elseif ($start_at) {
                $is_active = $current_date->lte($start_at);
            }
        }
        return $is_active;
    }

    public function getActiveStatusStringAttribute()
    {
        $strings = [
            0 => 'غير فعّال',
            1 => 'فعّال',
            2 => 'العقد منتهي',
        ];

        return $strings[$this->active_status ?? 0];
    }

    public function getActiveStatusClassAttribute()
    {
        $strings = [
            0 => 'danger',
            1 => 'success',
            2 => 'warning',
        ];

        return $strings[$this->active_status ?? 0];
    }

    public function getCostAttribute()
    {
        return $this->apartments()->sum('contract_apartment.cost');
    }

    public function getCostHumanAttribute()
    {
        return number_format($this->cost ?? 0, 2) . ' د.ب.';
    }

    public function cancel()
    {
        $this->active = false;
        return ($this->save());
    }

    public function Reactive()
    {
        $this->active = true;
        return ($this->save());
    }

    public function getStartAtHumanAttribute()
    {
        $human = '-';
        if ($this->start_at) {
            $human = $this->start_at->format('Y/m/d');
        }
        return $human;
    }

    public function getEndAtHumanAttribute()
    {
        $human = '-';
        if ($this->end_at) {
            $human = $this->end_at->format('Y/m/d');
        }
        return $human;
    }

    public function getInvoicesTotalAttribute()
    {
        return $this->invoices()->sum('amount');
    }

    public function getReceiptsTotalAttribute()
    {
        // Retrieve the receipts associated with the invoices of the contract
        $receipts = $this->invoices->flatMap(function ($invoice) {
            return $invoice->receipts;
        });

        // Calculate the sum of the receipt amounts
        return $receipts->sum('amount');

    }

    public function getTotalAmountPaidAttribute()
    {
        return $this->receipts_total ?? 0;
    }

    public function getTotalAmountRemainingAttribute()
    {
        $total = $this->invoices_total ?? 0;
        $paid = $this->receipts_total ?? 0;
        return $total - $paid;
    }

    public function getTotalAmountRemainingHumanAttribute()
    {
        $total_amount_remaining = $this->total_amount_remaining;
        return number_format($total_amount_remaining, 2);
    }

    public function getTotalTicketOpenedAttribute()
    {
        return $this->tickets()->opened()->count();
    }

    public function getIsLawyerableAttribute()
    {
        return !($this->lawyerCase) == false;
    }

    public function getFirstSideAttribute()
    {
        $side = '';
        if (isset($this->apartments[0])) {
            if ($this->apartments[0]->property) {
                if ($this->apartments[0]->property->category) {
                    $side = $this->apartments[0]->property->category->name;
                }
            }
        }
        return $side;
    }

    public function getSecondSideAttribute()
    {
        $side = '';
        if (isset($this->user)) {
            $side = $this->user->name;
        }
        return $side;
    }
}
