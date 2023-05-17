<?php

namespace App\Http\Livewire\Admin\Property\Apartment;

use App\Models\Apartment;
use App\Traits\WithAlert;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CreateForm extends Component
{
    use WithAlert;

    public $property_id;

    public $name;
    public $area;
    public $type;
    public $cost;
    public $rooms_count;
    public $bathrooms_count;
    public $with_electricity;
    public $with_balcony;
    public $with_elevator;
    public $with_pool;
    public $parking;
    public $furniture;

    public $floors;

    public $type_house = Apartment::TYPE_HOUSE;
    public $type_store = Apartment::TYPE_STORE;

    public function rules()
    {
        return [
            'property_id' => 'required|exists:properties,id',
            'type' => [
                'required',
                Rule::in([
                    Apartment::TYPE_HOUSE,
                    Apartment::TYPE_STORE,
                ])
            ],
            'name' => 'required',
            'cost' => 'required|numeric',
            'area' => 'required|numeric',
            'rooms_count' => Rule::requiredIf($this->type == $this->type_house),
            'bathrooms_count' => Rule::requiredIf($this->type == $this->type_house),
            'with_electricity' => [
                'boolean',
                Rule::requiredIf($this->type == $this->type_house),
            ],
            'with_balcony' => [
                'boolean',
                Rule::requiredIf($this->type == $this->type_house),
            ],
            'with_elevator' => [
                'boolean',
                Rule::requiredIf($this->type == $this->type_house),
            ],
            'with_pool' => [
                'boolean',
                Rule::requiredIf($this->type == $this->type_house),
            ],
            'parking' => Rule::requiredIf($this->type == $this->type_house),
            'furniture' => [
                'boolean',
                Rule::requiredIf($this->type == $this->type_house),
            ],
            'floors' => Rule::requiredIf($this->type == $this->type_store),
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
            'integer' => 'الرقم غير صالح',
            'numeric' => 'القيمة غير صالحة',
            'type.in' => 'قيمة غير صالحة',
            'boolean' => 'حقل اجباري',
        ];
    }

    public function getListeners()
    {
        return [
            'show-apartment-add-modal' => 'selectProperty'
        ];
    }

    public function render()
    {
        return view('livewire.admin.property.apartment.create-form');
    }

    public function selectProperty($params)
    {
        $this->resetFields();
        if (isset($params['property_id']) ) {
            $this->property_id = $params['property_id'];
        }
    }

    public function resetFields()
    {
        $this->reset([
            'property_id',
            'name',
            'area',
            'type',
            'cost',
            'rooms_count',
            'bathrooms_count',
            'with_electricity',
            'with_balcony',
            'with_elevator',
            'with_pool',
            'parking',
            'furniture',
            'floors',
        ]);

        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->emit('hide-apartment-add-modal');
    }

    public function save()
    {
        $validated_data = $this->validate();
        $apartment = Apartment::create($validated_data);

        if ($apartment) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->closeModal();
            $this->emit('apartment-added');
        } else {
            $this->showWarningAlert('عذرًا حدث خطأ ما');
        }
    }

}
