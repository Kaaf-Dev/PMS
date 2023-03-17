<?php

namespace App\Http\Livewire\Admin\Contract\Forms;

use App\Models\Apartment;
use App\Models\Contract;
use App\Models\Property;
use App\Traits\WithAlert;
use Livewire\Component;

class ManageApartment extends Component
{
    use WithAlert;

    public $contract;

    public $search_property;
    public $search_apartment;

    public $selected_apartment;
    public $selected_property;

    public $properties;
    public $apartments;

    public function rules()
    {
        return [
            'selected_apartment' => 'required',
        ];

    }

    public function getListeners()
    {
        return [
            'show-contract-manage-apartment-modal' => 'selectContract',
        ];
    }

    public function render()
    {
        return view('livewire.admin.contract.forms.manage-apartment');
    }

    public function updated($property)
    {
        if ($property == 'search_property') {
            $this->fetchProperties();
        }

        if ($property == 'search_apartment') {
            $this->fetchApartments();
        }
    }

    public function fetchProperties()
    {
        $this->properties = Property::where([
            ['name', 'like', '%'. $this->search_property .'%'],
        ])
            ->limit(15)
            ->get();
    }

    public function fetchApartments()
    {
        $this->apartments = Apartment::where([
            ['property_id', '=', $this->selected_property->id],
            ['name', 'like', '%'. $this->search_apartment .'%'],
        ])
            ->limit(15)
            ->get();
    }

    public function selectProperty($property = null)
    {
        $this->reset([
            'apartments',
            'search_property',
            'search_apartment',
            'selected_property',
            'selected_apartment',
        ]);
        if ($property) {
            $this->selected_property = Property::findOrfail($property);
            $this->fetchApartments();
        }
    }

    public function selectApartment($apartment = null)
    {
        $this->reset([
            'search_apartment',
            'selected_apartment',
        ]);
        if ($apartment) {
            $apartment = Apartment::findOrFail($apartment);
            if ($apartment->is_available or $this->contract->apartment_id == $apartment->id) {
                $this->selected_apartment = $apartment;
            } else {
                $this->showErrorAlert('هذه الوحدة مؤجرة في الوقت الحالي');
            }
        }
    }

    public function clearSearchProperty()
    {
        $this->reset('search_property');
        $this->fetchProperties();
    }

    public function clearSearchApartment()
    {
        $this->reset('search_apartment');
        $this->fetchApartments();
    }

    public function selectContract($params = [])
    {
        $this->resetFields();
        $contract_id = $params['contract_id'] ?? 0;
        $this->contract = Contract::findOrFail($contract_id);
        $this->selectProperty($this->contract->Apartment->Property->id);
        $this->selectApartment($this->contract->Apartment->id);
        $this->fetchApartments();
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset([
            'contract',
            'selected_apartment',
            'selected_property',
        ]);
    }

    public function closeModal()
    {
        $this->emit('hide-contract-manage-apartment-modal');
    }

    public function save()
    {
        $validated_data = $this->validate();
        $this->contract->apartment_id = $this->selected_apartment->id;
        if ($this->contract->save()) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->emit('contract-updated-apartment');
            $this->closeModal();
        } else {
            $this->showWarningAlert('يرجى المحاولة لاحقًا!');
        }
    }
}
