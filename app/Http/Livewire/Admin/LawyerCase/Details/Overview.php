<?php

namespace App\Http\Livewire\Admin\LawyerCase\Details;

use App\Models\Court;
use App\Models\LawyerCase;
use App\Models\lawyerCaseStatus;
use App\Traits\WithAlert;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Overview extends Component
{

    use AuthorizesRequests;
    use WithAlert;

    public $lawyer_case;

    public function rules()
    {
        return [
            'lawyer_case.first_side' => 'nullable',
            'lawyer_case.second_side' => 'nullable',
            'lawyer_case.court_id' => 'nullable',
            'lawyer_case.lawyer_case' => 'nullable',
            'lawyer_case.required_case' => 'nullable',
            'lawyer_case.status_id' => 'nullable',
            'lawyer_case.amount' => 'nullable',
            'lawyer_case.judgment_amount' => 'nullable',
            'lawyer_case.decision' => 'nullable',
            'lawyer_case.collected_amount' => 'nullable',
            'lawyer_case.case_no' => 'nullable',
        ];
    }

    public function getListeners()
    {
        return [
            'lawyer_case_select_court_date' => 'selectCourtDate',
        ];
    }

    public function mount($lawyer_case)
    {
        $lawyer_case = LawyerCase::findOrFail($lawyer_case);
        if ($this->authorize('view', $lawyer_case)) {
            $this->lawyer_case = $lawyer_case;
        }
    }

    public function render()
    {
        return view('livewire.admin.lawyer-case.details.overview');
    }

    public function getCourtsProperty()
    {
        return Court::all();
    }

    public function getStatusesProperty()
    {
        return lawyerCaseStatus::all();
    }

    public function save()
    {
        $this->validate();
        if ($this->lawyer_case->save()) {
            $this->showSuccessAlert('تمت العملية بنجاح');
        } else {
            $this->showWarningAlert('يرجى المحاولة مرة أخرى!');
        }

    }
}
