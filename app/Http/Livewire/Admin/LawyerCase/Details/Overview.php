<?php

namespace App\Http\Livewire\Admin\LawyerCase\Details;

use App\Models\LawyerCase;
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
            'lawyer_case.subject' => 'nullable',
            'lawyer_case.needed_action' => 'nullable',
            'lawyer_case.amount' => 'nullable',
            'lawyer_case.action' => 'nullable',
            'lawyer_case.court_date' => 'nullable',
            'lawyer_case.decision' => 'nullable',
            'lawyer_case.decision_details' => 'nullable',
            'lawyer_case.collected_amount' => 'nullable',
            'lawyer_case.attorneys_fees' => 'nullable',
            'lawyer_case.court_fees' => 'nullable',
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

    public function selectCourtDate($court_date)
    {
        $this->lawyer_case->court_date = Carbon::parse($court_date);
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
