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
    public $selected_apartments;
    public $selected_user;

    public $start_at_year;
    public $start_at_month;
    public $end_at_year;
    public $end_at_month;

    public $cost;
    public $notes;

    public $property_category;

    public function rules()
    {
        $rules = [
            1 => [
                'selected_property' => 'required',
                'selected_apartments' => 'required|array',
                'selected_apartments.*' => 'array',
                'selected_apartments.*.id' => 'exists:apartments,id',
                'selected_apartments.*.contract_cost' => 'required|numeric',
            ],

            2 => [
                'selected_user' => 'required',
            ],

            3 => [
                'start_at_year' => 'required|integer',
                'start_at_month' => 'required|integer',
                'end_at_year' => 'required|integer',
                'end_at_month' => 'required|integer',
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

    public function updated($property, $value)
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

    public function refreshData($params = [])
    {
        $this->setStepNo(1);
        $this->reset([
            'contract_id',
            'selected_property',
            'selected_apartments',
            'selected_user',
            'search_property',
            'search_apartment',
            'search_user',
            'start_at_year',
            'start_at_month',
            'end_at_year',
            'end_at_month',
            'cost',
            'notes',
            'property_category'
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

        if ($this->step_no == 2) {
            $cost = 0;
            foreach ($this->selected_apartments ?? [] as $selected_apartment) {
                $cost += $selected_apartment['contract_cost'];
            }
            $this->cost = $cost;
        }

        if ($this->step_no >= $this->max_step_no) {
            $Contract = new Contract();
            $Contract->user_id = $this->selected_user->id;
            $Contract->notes = $this->notes;
            $Contract->active = true;
            $start_at = Carbon::create(
                $this->start_at_year,
                $this->start_at_month,
                1)
                ->startOfMonth()
                ->format('Y-m-d');
            $end_at = Carbon::create(
                $this->end_at_year,
                $this->end_at_month,
                1)
                ->startOfMonth()
                ->format('Y-m-d');
            $Contract->start_at = $start_at;
            $Contract->end_at = $end_at;

            if ($Contract->save()) { // saved successfully
                $apartment_ids = $this->getApartmentsIds();
                $Contract->apartments()->attach($apartment_ids);
                $this->contract_id = $Contract->id;
                $this->emit('contract_added');
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
        ]);
        if ($property) {

            $property = Property::findOrfail($property);

            if ($this->property_category and $property->category_id) {
                if ($this->property_category != $property->category_id) {
                    $this->showWarningAlert('لا يمكن إضافة وحدات من فئة عقار مختلف');
                    return;
                }
            }

            $this->selected_property = $property;
            $this->fetchApartments();
        }
    }

    public function selectApartment($apartment = null, $show_error_msg = true)
    {
        if ($apartment) {
            $apartment = Apartment::with('Property')
                ->findOrFail($apartment)->append('icon_svg');
            if ($apartment->is_available) {
                $this->selected_apartments[$apartment->id] = $apartment->toArray();
                $this->selected_apartments[$apartment->id]['contract_cost'] = $apartment->cost;
                if (is_null($this->property_category)) {
                    if ($apartment->property->category_id) {
                        $this->property_category = $apartment->property->category_id;
                    }
                }
            } else {
                if ($show_error_msg) {
                    $this->showErrorAlert('هذه الوحدة مؤجرة في الوقت الحالي');
                }
            }
        }
    }

    public function unselectApartment($apartment)
    {
        if (isset($this->selected_apartments[$apartment])) {
            unset($this->selected_apartments[$apartment]);
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

    public function getApartmentsIds()
    {
        $apartments = $this->selected_apartments;
        $apartments_ids = [];
        foreach ( $apartments as $apartment_id => $apartment ) {
            $apartments_ids[$apartment_id] = [
                'cost' => $apartment['contract_cost'],
            ];
        }
        return $apartments_ids;
    }

}
