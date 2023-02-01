<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    const TYPE_HOUSE = 1;
    const TYPE_STORE = 2;

    protected $fillable = [
        'property_id',
        'type',
        'name',
        'cost',
        'area',
        'rooms_count',
        'bathrooms_count',
    ];

    public function Property()
    {
        return $this->belongsTo(Property::class);
    }

    public function getIsAvailableAttribute()
    {
        return true;
    }

    public function getTypeStringAttribute()
    {
        $strings = [
            self::TYPE_HOUSE => 'شقة سكنية',
            self::TYPE_STORE => 'محل تجاري',
        ];
        return $strings[$this->type ?? self::TYPE_HOUSE];
    }

    public function getIsTypeHouseAttribute()
    {
        return $this->type == self::TYPE_HOUSE;
    }

    public function getIsTypeStoreAttribute()
    {
        return $this->type == self::TYPE_STORE;
    }
}
