<?php

namespace App\Http\Livewire\Lawyer\Contract\Details;

use App\Models\Contract;
use Livewire\Component;

class FileAttachment extends Component
{
    public $contract;

    public function mount(Contract $contract)
    {
        $this->contract = $contract;
    }

    public function render()
    {
        return view('livewire.lawyer.contract.details.file-attachment');
    }
}
