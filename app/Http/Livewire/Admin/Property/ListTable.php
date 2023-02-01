<?php

namespace App\Http\Livewire\Admin\Property;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $ready_to_load = false;
    public $search;

    public function rules()
    {
        return [

        ];
    }

    public function updated($property, $value)
    {
        if ($property == 'search') {
            $this->resetPage();
        }

    }

    public function render()
    {
        $properties = ($this->ready_to_load) ? $this->loadProperties() : [];
        $view_data = [
            'properties' => $properties,
        ];
        return view('livewire.admin.property.list-table', $view_data);
    }

    public function load()
    {
        $this->ready_to_load = true;
    }

    public function loadProperties()
    {
        $properties = Property::where('name', 'like', '%'. $this->search .'%');
        return $properties
            ->withCount('apartments')
            ->paginate();
    }
}
