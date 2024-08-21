<?php

namespace App\Http\Livewire\Lawyer\LawyerCase\Details;

use App\Events\LawyerChangeCaseDetails;
use App\Events\LawyerCreateInvoice;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use App\Models\Court;
use App\Models\LawyerCase;
use App\Models\lawyerCaseStatus;
use App\Traits\WithAlert;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use function Symfony\Component\Translation\t;

class Overview extends Component
{

    use AuthorizesRequests;
    use WithAlert;

    public $lawyer_case;

    public function rules()
    {
        return [
            'lawyer_case.court_id' => 'nullable',
            'lawyer_case.status_id' => 'nullable',
            'lawyer_case.decision' => 'nullable',
            'lawyer_case.collected_amount' => 'nullable',
            'lawyer_case.judgment_amount' => 'nullable',
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
        return view('livewire.lawyer.lawyer-case.details.overview');
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
        if ($this->lawyer_case->isDirty()) {
            if ($this->lawyer_case->save()) {
                event(new LawyerChangeCaseDetails($this->lawyer_case));
                $this->showSuccessAlert('تمت العملية بنجاح');
            } else {
                $this->showWarningAlert('يرجى المحاولة مرة أخرى!');
            }
        }
    }
}
