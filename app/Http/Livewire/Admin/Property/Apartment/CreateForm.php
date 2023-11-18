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
    public $with_building_guard;
    public $with_electricity;
    public $with_balcony;
    public $with_elevator;
    public $with_pool;
    public $parking;
    public $furniture;
    public $floors;

    public $type_house = Apartment::TYPE_HOUSE;
    public $type_store = Apartment::TYPE_STORE;
    public $type_earth = Apartment::TYPE_EARTH;

    public function rules()
    {
        return [
            'property_id' => 'required|exists:properties,id',
            'type' => [
                'required',
                Rule::in([
                    Apartment::TYPE_HOUSE,
                    Apartment::TYPE_STORE,
                    Apartment::TYPE_EARTH,
                ])
            ],
            'name' => 'required',
            'cost' => 'required|numeric',
            'area' => 'required|numeric',
            'rooms_count' => Rule::requiredIf($this->type == $this->type_house),
            'bathrooms_count' => Rule::requiredIf($this->type == $this->type_house),
            'with_building_guard' => [
                'boolean',
                'nullable',
                Rule::requiredIf($this->type == $this->type_house),
            ],
            'with_electricity' => [
                'boolean',
                'nullable',
                Rule::requiredIf($this->type == $this->type_house),
            ],
            'with_balcony' => [
                'boolean',
                'nullable',
                Rule::requiredIf($this->type == $this->type_house),
            ],
            'with_elevator' => [
                'boolean',
                'nullable',
                Rule::requiredIf($this->type == $this->type_house),
            ],
            'with_pool' => [
                'boolean',
                'nullable',
                Rule::requiredIf($this->type == $this->type_house),
            ],
            'parking' => Rule::requiredIf($this->type == $this->type_house),
            'furniture' => [
                'integer',
                'nullable',
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

        if (isset($params['name']) ) {
            $this->name = $params['name'];
        }

        if (isset($params['area']) ) {
            $this->area = $params['area'];
        }

        if (isset($params['type']) ) {
            $this->type = $params['type'];
        }

        if (isset($params['cost']) ) {
            $this->cost = $params['cost'];
        }

        if (isset($params['rooms_count']) ) {
            $this->rooms_count = $params['rooms_count'];
        }

        if (isset($params['bathrooms_count']) ) {
            $this->bathrooms_count = $params['bathrooms_count'];
        }

        if (isset($params['with_building_guard']) ) {
            $this->with_building_guard = $params['with_building_guard'];
        }

        if (isset($params['with_electricity']) ) {
            $this->with_electricity = $params['with_electricity'];
        }

        if (isset($params['with_balcony']) ) {
            $this->with_balcony = $params['with_balcony'];
        }

        if (isset($params['with_elevator']) ) {
            $this->with_elevator = $params['with_elevator'];
        }

        if (isset($params['with_pool']) ) {
            $this->with_pool = $params['with_pool'];
        }

        if (isset($params['parking']) ) {
            $this->parking = $params['parking'];
        }

        if (isset($params['furniture']) ) {
            $this->furniture = $params['furniture'];
        }

        if (isset($params['floors']) ) {
            $this->floors = $params['floors'];
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
