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

    public function apartments()
    {
        return $this->hasMany(Apartment::class, 'property_id', 'id');
    }

    public function getRentedApartmentsCountAttribute()
    {
        // todo: calculate rented apartments from contracts
        $rented_apartments_count = 0;
      //  $rented_apartments_count = (int) ($this->apartments->count() * ($this->id % 100) / 100);
        $rented_apartments_count = $this->apartments()
            ->withCount('activeContracts')
            ->get()
            ->filter(function ($apartment) {
                return $apartment->active_contracts_count > 0;
            })->count();
        return $rented_apartments_count;
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
}
