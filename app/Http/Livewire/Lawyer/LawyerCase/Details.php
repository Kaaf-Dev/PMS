<?php

namespace App\Http\Livewire\Lawyer\LawyerCase;

use App\Models\LawyerCase;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Details extends Component
{

    use AuthorizesRequests;

    public $lawyer_case_id;

    public function mount($lawyer_case_id)
    {
        $this->lawyer_case_id = $lawyer_case_id;
    }

    public function render()
    {
        return view('livewire.lawyer.lawyer-case.details')
            ->layout('layouts.lawyer.app');
    }

    public function getLawyerCaseProperty()
    {
        $lawyer_case = LawyerCase::with([
            'contract',
            'contract.user',
            'contract.apartments',
        ])->findOrFail($this->lawyer_case_id);

        if ( $this->authorize('view', $lawyer_case) ) {
            return $lawyer_case;
        }
    }
}
