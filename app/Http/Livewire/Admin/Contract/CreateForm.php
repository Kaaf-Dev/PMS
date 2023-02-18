<?php

namespace App\Http\Livewire\Admin\Contract;

use App\Models\Apartment;
use App\Models\Contract;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Traits\WithAlert;

class CreateForm extends Component
{
    use WithAlert;

    public $contract_id;

    public $step_no;
    public $max_step_no = 4;

    public $search_property;
    public $search_apartment;
    public $search_user;

    public $properties;
    public $apartments;
    public $users;

    public $selected_property;
    public $selected_apartment;
    public $selected_user;

    public $start_at;
    public $end_at;
    public $cost;
    public $notes;


    public function rules()
    {
        $rules = [
            1 => [
                'selected_property' => 'required',
                'selected_apartment' => 'required',
            ],

            2 => [
                'selected_user' => 'required',
            ],

            3 => [
                'start_at' => 'required|date',
                'end_at' => 'required|date',
                'cost' => 'required|numeric',
                'notes' => 'nullable',
            ],

        ];

        if (isset($rules[$this->step_no])) {
            return $rules[$this->step_no];
        }

        return $rules[1];

    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
            'date' => 'التاريخ غير صالح',
            'numeric' => 'القيمة غير صالحة',
        ];
    }

    public function getListeners()
    {
        return [
            'show-contract-new-modal' => 'refreshData',
        ];
    }

    public function render()
    {
        return view('livewire.admin.contract.create-form');
    }

    public function updated($property)
    {
        if ($property == 'search_property') {
            $this->fetchProperties();
        }

        if ($property == 'search_apartment') {
            $this->fetchApartments();
        }

        if ($property == 'search_user') {
            $this->fetchUsers();
        }

    }

    public function refreshData($params)
    {
        $this->setStepNo(1);
        $this->reset([
            'contract_id',
            'selected_property',
            'selected_apartment',
            'selected_user',
            'search_property',
            'search_apartment',
            'search_user',
            'start_at',
            'end_at',
            'cost',
            'notes',
        ]);

        $this->resetErrorBag();
        $this->fetchProperties();
        $this->fetchUsers();

        // get data from listener
        if (isset($params['property'])) {
            $this->selectProperty($params['property']);
        }

        if (isset($params['apartment'])) {
            $this->selectApartment($params['apartment']);
        }

        if (isset($params['user'])) {
            $this->selectUser($params['user']);
        }

    }

    public function setStepNo($step_no = 1)
    {
        $this->step_no = $step_no;
    }

    public function goNextStep()
    {
        $validated_data = $this->validate();

//        dd( Carbon::make($validated_data['start_at']) );

        if ($this->step_no >= $this->max_step_no) {
            $Contract = new Contract();
            $Contract->user_id = $this->selected_user->id;
            $Contract->apartment_id = $this->selected_apartment->id;
            $Contract->cost = $this->cost;
            $Contract->notes = $this->notes;
            $Contract->active = true;
            $Contract->start_at = Carbon::make($this->start_at);
            $Contract->end_at = Carbon::make($this->end_at);

            if ($Contract->save()) { // saved successfully
                $this->contract_id = $Contract->id;

            } else {
                $this->showWarningAlert('عذرًا حدث خطأ ما!');
            }

        } else {
            $this->setStepNo($this->step_no + 1);
        }
    }

    public function goPreviouesStep()
    {
        if ($this->step_no > 1) {
            $this->setStepNo($this->step_no - 1);
        }
    }

    public function closeMe()
    {
        $this->emit('hide-contract-new-modal');
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

    public function clearSearchUser()
    {
        $this->reset('search_user');
        $this->fetchUsers();
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

    public function fetchUsers()
    {
        $search_user = $this->search_user;
        $this->users = User::where(function($query) use ($search_user){
                $query->where('name', 'LIKE', '%'. $search_user .'%')
                    ->orWhere('email', 'LIKE', '%'.$search_user.'%')
                    ->orWhere('cpr', 'LIKE', '%'.$search_user.'%');
        })
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
            if ($apartment->is_available) {
                $this->selected_apartment = $apartment;
                $this->cost = $apartment->cost;
            } else {
                $this->showErrorAlert('هذه الوحدة مؤجرة في الوقت الحالي');
            }
        }
    }

    public function selectUser($user = null)
    {
        $this->reset([
            'search_user',
            'selected_user',
        ]);
        if ($user) {
            $this->selected_user = User::findOrFail($user);
        }
    }

}
