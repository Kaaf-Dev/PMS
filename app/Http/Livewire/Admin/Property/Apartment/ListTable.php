<?php

namespace App\Http\Livewire\Admin\Property\Apartment;

use App\Models\Apartment;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $ready_load = false;
    public $search;
    public $status;


    public function load()
    {
        return $this->ready_load = true;
    }

    public function render()
    {
        $apartments = $this->ready_load ? $this->getApartments()->paginate() : [];
        $view_data = [
            'apartments' => $apartments,
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

        })->when($this->status, function ($query) {
            if ($this->status == 1) {
                $query->whereHas('activeContracts', function ($query) {
                    return $query;
                });
            }else{
                $query->whereDoesntHave('activeContracts', function ($query) {
                    return $query;
                });
            }
        });
    }
}
