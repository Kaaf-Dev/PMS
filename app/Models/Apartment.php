<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'name',
    ];

    public function Property()
    {
        $this->belongsTo(Property::class);
    }
}
