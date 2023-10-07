<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'with_building_guard',
        'with_electricity',
        'with_balcony',
        'with_elevator',
        'with_pool',
        'parking',
        'furniture',
        'floors',
    ];

    public function Property()
    {
        return $this->belongsTo(Property::class);
    }

    public function contracts()
    {
        return $this->belongsToMany(Contract::class, 'contract_apartment');
    }


    public function activeContracts()
    {
        return $this->belongsToMany(Contract::class, 'contract_apartment')->active();
    }

    public function getCurrentContractAttribute()
    {
        return $this->activeContracts()->first();
    }

    public function scopeAvailable($query)
    {
        $query->whereDoesntHave('contracts', function ($query) {
            $query->active();
        });
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

    public function getIsRentedAttribute()
    {
        return $this->activeContracts()->exists();
    }

    public function getIsAvailableAttribute()
    {
        return $this->activeContracts()->doesntExist();
    }

    public function getCurrentRentedCostAttribute()
    {
        $cost = 0;
        if ($this->activeContracts) {
            $cost = DB::table('contract_apartment')
                ->select('cost')
                ->where('contract_id', '=', $this->currentContract->id)
                ->where('apartment_id', '=', $this->id)
                ->first();
        }
        return $cost->cost;
    }

    public function getIconSvgAttribute()
    {
        $icon_svg = '';
        if ($this->getIsTypeHouseAttribute()) {
            $icon_svg = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor"/><path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor"/><path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor"/></svg>';

        } elseif($this->getIsTypeStoreAttribute()) {
            $icon_svg = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z" fill="currentColor"/><path opacity="0.3" d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z" fill="currentColor"/><path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z" fill="currentColor"/><path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z" fill="currentColor"/><path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor"/><path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor"/><path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor"/><path d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z" fill="currentColor"/></svg>';
        }

        return $icon_svg;
    }

    public function getContractActiveStatusAttribute()
    {
        $status = 0;
        $contract = $this->activeContracts->last();
        if ($contract) {
            $status = $contract->activeStatus;
        }
        return $status;
    }

    public function getContractActiveStatusStringAttribute()
    {
        $strings = [
            0 => 'متاح للتأجير',
            1 => 'مؤجر',
            2 => 'العقد منتهي',
        ];
        return $strings[$this->getContractActiveStatusAttribute() ?? 0];
    }

    public function getContractActiveStatusClassAttribute()
    {
        $strings = [
            0 => 'success',
            1 => 'danger',
            2 => 'warning',
        ];
        return $strings[$this->getContractActiveStatusAttribute() ?? 0];
    }
}
