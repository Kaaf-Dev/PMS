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

    public $selected_property;
    public $selected_apartments;
    public $unselected_apartments;
    public $selected_apartment;

    public $properties;
    public $apartments;

    public function rules()
    {
        return [
            'selected_apartments' => 'array',
            'selected_apartments' => 'required|array',
            'selected_apartments.*' => 'array',
            'selected_apartments.*.id' => 'exists:apartments,id',
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
        ]);
        if ($property) {
            $this->selected_property = Property::findOrfail($property);
            $this->fetchApartments();
        }
    }

    public function selectApartment($apartment = null, $show_error_msg = true)
    {
        if ($apartment) {
            $apartment = Apartment::with('Property')
                ->findOrFail($apartment)->append('icon_svg');
            if ($apartment->is_available or $this->contract->apartments()->where('apartment_id', $apartment->id)->exists()) {
                $this->selected_apartments[$apartment->id] = $apartment->toArray();
                if (isset($this->unselected_apartments[$apartment->id])) {
                    unset($this->unselected_apartments[$apartment->id]);
                }
            } else {
                if ($show_error_msg) {
                    $this->showErrorAlert('هذه الوحدة مؤجرة في الوقت الحالي');
                }
            }
        }
    }

    public function selectAllApartments()
    {
        if (isset($this->apartments)) {
            foreach ($this->apartments as $apartment) {
                $this->selectApartment($apartment->id, false);
            }
        } else {
            $this->showWarningAlert('لا يوجد بيانات حاليًا');
        }
    }

    public function unselectApartment($apartment)
    {
        if (isset($this->selected_apartments[$apartment])) {
            $this->unselected_apartments[$apartment] = $this->selected_apartments[$apartment];
            unset($this->selected_apartments[$apartment]);
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
        $apartment_ids = $this->contract->apartments()->pluck('apartments.id');
        foreach ($apartment_ids as $apartment_id) {
            $this->selectApartment($apartment_id);
        }
        $this->fetchProperties();
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset([
            'contract',
            'selected_apartment',
            'selected_apartments',
            'unselected_apartments',
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
        $apartment_ids = array_keys($validated_data['selected_apartments']);
        if ($this->contract->apartments()->sync($apartment_ids)) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->emit('contract-updated-apartment');
            $this->closeModal();
        } else {
            $this->showWarningAlert('يرجى المحاولة لاحقًا!');
        }
    }
}
