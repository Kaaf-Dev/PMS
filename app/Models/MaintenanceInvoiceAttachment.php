<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceInvoiceAttachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'maintenance_invoice_id',
        'path',
        'file_name',
    ];

    public function MaintenanceInvoice()
    {
        return $this->belongsTo(MaintenanceInvoice::class, 'maintenance_invoice_id', 'id');
    }
}
