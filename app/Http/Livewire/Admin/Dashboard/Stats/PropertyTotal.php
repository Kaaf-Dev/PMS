<?php

namespace App\Http\Livewire\Admin\Dashboard\Stats;

use App\Models\Apartment;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PropertyTotal extends Component
{

    public $ready_to_load = false;
    public $total = 0;
    public $stores_count = 0;
    public $apartments_count = 0;

    public $type;

    public function getListeners()
    {
        return [
            'changeDashboardType',
        ];
    }

    public function changeDashboardType($type)
    {
        $this->type = $type;
    }

    public function render()
    {
        if ($this->ready_to_load) {
            $this->fetchData();
        }
        return view('livewire.admin.dashboard.stats.property-total');
    }

    public function load()
    {
        $this->ready_to_load = true;
    }

    public function fetchData()
    {
//        $apartments = Apartment::select('type', DB::raw('COUNT(*) as count'))
//            ->groupBy('type')
//            ->get();
        $apartments = DB::table('properties')->select('apartments.type', DB::raw('COUNT(*) as count'))
            ->when($this->type, function ($query) {
                $query->where('properties.category_id', '=', $this->type);
            })
            ->join('apartments', 'properties.id', '=', 'apartments.property_id')
            ->groupBy('apartments.type')
            ->get();

        foreach ($apartments as $apartment) {
            if (Apartment::TYPE_HOUSE == $apartment->type) {
                $this->apartments_count = $apartment->count;
            }

            if (Apartment::TYPE_STORE == $apartment->type) {
                $this->stores_count = $apartment->count;
            }
        }
        $this->total = $this->apartments_count + $this->stores_count;
    }
}
