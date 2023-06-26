<?php

namespace App\Http\Livewire\User\Contract\Details;

use App\Models\Contract;
use Livewire\Component;

class Overview extends Component
{
    public $contract_id;

    public $show_apartments = false;

    public function mount($contract)
    {
        $this->contract_id = $contract;
    }


    public function render()
    {
        return view('livewire.user.contract.details.overview');
    }

    public function getContractProperty()
    {
        return Contract::with([
            'user',
            'apartments',
        ])->findOrFail($this->contract_id);
    }
}
