<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'floors_count',
        'area',
        'construction_date',
    ];

    protected $dates = [
        'construction_date',
    ];

    public function apartments()
    {
        return $this->hasMany(Apartment::class, 'property_id', 'id');
    }
}
