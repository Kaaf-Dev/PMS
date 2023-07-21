<?php

namespace App\Http\Livewire\Lawyer\Contract\Details;

use App\Models\ContractReplies;
use App\Models\ContractReply;
use Livewire\Component;

class Replies extends Component
{
    public $ready_to_load = false;
    public $contract_id;


    public function getListeners()
    {
        return [
            'reply-added' => '$refresh',
        ];
    }

    public function mount($contract)
    {
        $this->contract_id = $contract;
    }

    public function render()
    {
        $replies = ($this->ready_to_load)
            ? ContractReply::with([
                'admin',
                'lawyer',
            ])
                ->where('contract_id', '=', $this->contract_id)
                ->orderBy('updated_at')
                ->get()
            : [];

        $view_data = [
            'replies' => $replies,
        ];
        return view('livewire.lawyer.contract.details.replies', $view_data);
    }

    public function load()
    {
        $this->ready_to_load = true;
    }
}
