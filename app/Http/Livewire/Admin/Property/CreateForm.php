<?php

namespace App\Http\Livewire\Admin\Property;

use App\Models\Apartment;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Property;
use App\Traits\WithAlert;

class CreateForm extends Component
{
    use WithAlert;

    public $ky_no;
    public $category_id;
    public $name;
    public $area;
    public $market_value;
    public $floors_count;
    public $construction_date;
    public $apartments_house_count;
    public $apartments_market_count;
    public $item_type;

    public $register_number;
    public $register_year;
    public $document_no;
    public $owner_name;
    public $owner_phone;
    public $owner_cpr;

    public function rules()
    {
        return [
            'ky_no' => 'nullable|integer',
            'category_id' => 'required',
            'name' => 'required',
            'item_type' => 'required',
            'area' => 'required|numeric',
            'market_value' => 'required|numeric',
            'floors_count' => 'nullable|integer',
            'construction_date' => 'nullable|integer',
            'apartments_house_count' => 'nullable|integer',
            'apartments_market_count' => 'nullable|integer',
            'register_number' => [Rule::requiredIf($this->item_type == 2), 'nullable'],
            'register_year' => [Rule::requiredIf($this->item_type == 2), 'nullable'],
            'document_no' => [Rule::requiredIf($this->item_type == 2), 'nullable'],
            'owner_name' => ['nullable'],
            'owner_phone' => ['nullable','numeric'],
            'owner_cpr' => ['nullable','numeric'],
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
            'integer' => 'الرقم غير صالح',
            'numeric' => 'القيمة غير صالحة',
        ];
    }

    public function getListeners()
    {
        return [
            'show-property-add-modal' => 'resetFields'
        ];
    }

    public function render()
    {
        return view('livewire.admin.property.create-form');
    }

    public function getCategoriesProperty()
    {
        return Category::all();
    }

    public function resetFields()
    {
        $this->reset([
            'category_id',
            'name',
            'area',
            'market_value',
            'floors_count',
            'construction_date',
            'apartments_house_count',
            'apartments_market_count',
        ]);

        $this->resetErrorBag();
    }

    public function closeModal()
    {
        $this->emit('hide-property-add-modal');
    }

    public function save()
    {
        $validated_data = $this->validate();

        $property = Property::create($validated_data);
        if ($property) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->closeModal();
            $this->emit('property-added');
        } else {
            $this->showWarningAlert('عذرًا حدث خطأ ما');
        }
    }
}
