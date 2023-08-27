<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceInvoice extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REJECTED = 3;

    protected $fillable = [
        'id',
        'ticket_id',
        'maintenance_company_id',
        'no',
        'status',
        'maintenance_amount',
        'amount',
        'notes',
    ];

    protected $casts = [
        'maintenance_amount' => 'float',
        'amount' => 'float',
    ];

    protected $no_prefix = 'Inv-';

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            if ($model->no === null) {
                $model->setAttribute('no', $model->nextNo());
            }

            if ($model->status === null) {
                $model->setAttribute('status', MaintenanceInvoice::STATUS_PENDING);
            }

        });
    }

    public function nextNo ()
    {
        $year = date('Y'); // Current year
        $month = date('n'); // Current month

        $max_order = MaintenanceInvoice::withTrashed()->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->max('no');

        $max_order = substr($max_order, -7);
        $max_order = (int) $max_order;
        $next_order = $max_order + 1;


        $no = substr($year, 2, 2)
            .str_pad($month, 2, '0', STR_PAD_LEFT)
            .str_pad($next_order, 7, '0', STR_PAD_LEFT);

        return $this->getNoPrefix() . $no;
    }

    public function getNoPrefix()
    {
        return $this->no_prefix ?? '';
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function attachments()
    {
        return $this->hasMany(MaintenanceInvoiceAttachment::class, 'maintenance_invoice_id', 'id');
    }

    public static function getStatusList()
    {
        return [
            SELF::STATUS_PENDING => 'بانتظار الموافقة',
            SELF::STATUS_APPROVED => 'تمت الموافقة',
            SELF::STATUS_REJECTED => 'مرفوضة',
        ];
    }

    public static function getStatusValues()
    {
        return [
            SELF::STATUS_PENDING,
            SELF::STATUS_APPROVED,
            SELF::STATUS_REJECTED,
        ];
    }

    public function getStatusStringAttribute()
    {
        $status = $this->status ?? 1;

        $status_strings = $this->getStatusList();
        return $status_strings[$status] ?? $status_strings[1];
    }

    public function getStatusClassAttribute()
    {
        $status = $this->status ?? 1;
        $status_classes = [
            SELF::STATUS_PENDING => 'primary',
            SELF::STATUS_APPROVED => 'success',
            SELF::STATUS_REJECTED => 'danger',
        ];
        return $status_classes[$status] ?? $status_classes[SELF::STATUS_PENDING];
    }

    public function getStatusIconAttribute()
    {
        $status = $this->status ?? 1;
        $status_classes = [
            SELF::STATUS_PENDING => 'delivery-time',
            SELF::STATUS_APPROVED => 'file-added',
            SELF::STATUS_REJECTED => 'cross-circle',
        ];
        return $status_classes[$status] ?? $status_classes[SELF::STATUS_PENDING];
    }

}
