<?php

namespace App\Http\Livewire\Admin\Property\Apartment;

use App\Exports\ApartmentListReport;
use App\Models\Apartment;
use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ListTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $ready_load = false;
    public $search;
    public $status;
    public $category_id;
    public $type_id;
    public $property_id;


    public function load()
    {
        return $this->ready_load = true;
    }

    public function render()
    {
        $apartments = $this->ready_load ? $this->getApartments()->paginate() : [];
        $properties = Property::all();
        $view_data = [
            'apartments' => $apartments,
            'properties' => $properties,
        ];
        return view('livewire.admin.property.apartment.list-table', $view_data);
    }

    public function getApartments()
    {
        return Apartment::when($this->search, function ($query) {
            $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhereHas('Property', function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            });

        })->when($this->type_id, function ($query) {
            $query->where('type', '=', $this->type_id);
        })->when($this->property_id, function ($query) {
            $query->where('property_id', '=', $this->property_id);
        })->when($this->status, function ($query) {
            if ($this->status == 1) {
                $query->whereHas('activeContracts', function ($query) {
                    return $query;
                });
            } else {
                $query->whereDoesntHave('activeContracts', function ($query) {
                    return $query;
                });
            }
        })->when($this->category_id, function ($query) {
            $query->whereHas('Property', function ($query) {
                $query->where('category_id', $this->category_id);
            });
        });
    }

    public function exportExcel()
    {
        return Excel::download(new ApartmentListReport($this->getApartments()->get()), 'apartments.xlsx');
    }
}
