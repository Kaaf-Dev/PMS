<?php

namespace App\Http\Livewire\Admin\Property\Details;

use App\Models\Category;
use App\Models\Property;
use Livewire\Component;
use App\Traits\WithAlert;

class Settings extends Component
{
    use WithAlert;

    public $property;

    public function rules()
    {
        return [
            'property.ky_no' => 'nullable|integer',
            'property.category_id' => 'required',
            'property.name' => 'required',
            'property.area' => 'required|numeric',
            'property.market_value' => 'required|numeric',
            'property.floors_count' => 'required|numeric',
            'property.construction_date' => 'required',
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
            'numeric' => 'يرجى ادخال أرقام فقط',
            'integer' => 'يرجى ادخال أرقام فقط',
        ];
    }

    public function getListeners()
    {
        return [
            'property-updated' => '$refresh',
        ];
    }

    public function mount($property_id)
    {
        $this->property = Property::whereId($property_id)
            ->with('apartments')
            ->withCount([
                'apartments',
            ])
            ->firstOr(function () {
                abort(404);
            });
    }

    public function render()
    {
        return view('livewire.admin.property.details.settings');
    }

    public function getCategoriesProperty()
    {
        return Category::all();
    }

    public function save()
    {
        $validated_data = $this->validate();
        if ($this->property->save()) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->emit('property-updated');
        }
    }

    public function discard()
    {
        $this->property->refresh();
    }
}
