<?php

namespace App\Http\Livewire\Lawyer\LawyerCase;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $filters;

    public function getListeners()
    {
        return [
            'lawyer-cases-filter' => 'updateFilters',
        ];
    }


    public function render()
    {
        $lawyer_cases = $this->fetchLawyerCases();
        $view_data = [
            'lawyer_cases' => $lawyer_cases,
        ];
        return view('livewire.lawyer.lawyer-case.list-table', $view_data);
    }

    public function fetchLawyerCases()
    {
        $this->resetPage();
        $auth = Auth::guard('lawyer')->user();
        $lawyer_cases = $auth->cases();

        if (isset($this->filters['search'])) {
            $lawyer_cases = $lawyer_cases->search($this->filters['search']);
        }

        return $lawyer_cases->with([
            'contract',
            'contract.user',
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(15, ['*'], 'casePage');

    }

    public function updateFilters($filters)
    {
        $this->filters = $filters;
    }
}
