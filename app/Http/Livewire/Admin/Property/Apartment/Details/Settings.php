<?php

namespace App\Http\Livewire\Admin\Property\Apartment\Details;

use App\Models\Apartment;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Traits\WithAlert;

class Settings extends Component
{
    use WithAlert;

    public $apartment;

    public function rules()
    {
        return [
            'apartment.type' => [
                'required',
                Rule::in([
                    Apartment::TYPE_HOUSE,
                    Apartment::TYPE_STORE,
                ])
            ],
            'apartment.name' => 'required',
            'apartment.cost' => 'required|numeric',
            'apartment.area' => 'required|numeric',
            'apartment.rooms_count' => Rule::requiredIf($this->apartment->is_type_house),
            'apartment.bathrooms_count' => Rule::requiredIf($this->apartment->is_type_house),
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
            'numeric' => 'يرجى ادخال أرقام فقط',
            'integer' => 'يرجى ادخال أرقام فقط',
            'apartment.type.in' => 'قيمة غير صالحة',
        ];
    }

    public function getListeners()
    {
        return [
            'apartment-updated' => '$refresh',
        ];
    }

    public function mount($apartment_id)
    {
        $this->apartment = Apartment::whereId($apartment_id)
            ->firstOr(function () {
                abort(404);
            });
    }

    public function render()
    {
        $view_data = [
            'type_house' => Apartment::TYPE_HOUSE,
            'type_store' => Apartment::TYPE_STORE,
        ];
        return view('livewire.admin.property.apartment.details.settings', $view_data);
    }

    public function save()
    {
        $validated_data = $this->validate();
        if ($this->apartment->save()) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->emit('apartment-updated');
        }
    }

    public function discard()
    {
        $this->apartment->refresh();
    }
}
