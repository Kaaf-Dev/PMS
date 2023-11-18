<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'ky_no',
        'item_type',
        'category_id',
        'name',
        'floors_count',
        'area',
        'market_value',
        'construction_date',
        'owner_cpr',
        'owner_phone',
        'owner_name',
        'document_no',
        'register_year',
        'register_number',
    ];
    const TYPE_PROPERTY =1 ;
    const TYPE_EARTH = 2;

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function apartments()
    {
        return $this->hasMany(Apartment::class, 'property_id', 'id');
    }

    public function files()
    {
        return $this->hasMany(PropertyFile::class, 'property_id');
    }

    public function getCategoryNameAttribute()
    {
        return optional($this->Category)->name ?? '';
    }
    public function getIsTypePropertyAttribute()
    {
        return $this->item_type == self::TYPE_PROPERTY;
    }

    public function getIsTypeEarthAttribute()
    {
        return $this->item_type == self::TYPE_EARTH;
    }


    public function getRentedApartmentsCountAttribute()
    {
        $rented_apartments_count = 0;
        return $this->apartments()
            ->withCount('activeContracts')
            ->get()
            ->filter(function ($apartment) {
                return $apartment->active_contracts_count > 0;
            })->count();
    }

    public function getAvailableApartmentsCountAttribute()
    {
        return $this->apartments->count() - $this->getRentedApartmentsCountAttribute();
    }

    public function getRentedApartmentsAvgAttribute()
    {
        $rental_apartments_avg = 0;
        if ($this->apartments->count() > 0) {
            $rental_apartments_avg = ($this->getRentedApartmentsCountAttribute() / $this->apartments->count()) * 100;
        }
        return round($rental_apartments_avg, 2);
    }

    public function getPropertyItemTypeAttribute()
    {
        $type = 'غير محدد';
        $types = [
            1 => 'عقار',
            2 => 'أرض',
        ];
        if (isset($types[$this->item_type])) {
            $type = $types[$this->item_type];
        }
        return $type;
    }
}
