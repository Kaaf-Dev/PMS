<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'is_rent',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'type', 'id');
    }
}
