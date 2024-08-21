<?php

namespace App\Http\Livewire\Admin\Contract;

use App\Models\Contract;
use Livewire\Component;

class Details extends Component
{

    public $contract_id;

    public function mount($contract_id, $notification_id = null)
    {
        $this->contract_id = $contract_id;

        //********** MarkReadNotifications ************
        if ($notification_id) {
            $notification = auth('admin')->user()->notifications()->where('id', $notification_id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }
    }

    public function getListeners()
    {
        return [
            'contract-lawyer-assigned' => '$refresh',
            'contract-lawyer-unassigned' => '$refresh',
        ];
    }

    public function render()
    {
        return view('livewire.admin.contract.details')
            ->layout('layouts.admin.app');
    }

    public function getContractProperty()
    {
        return Contract::with([
            'apartments',
        ])
            ->withCount('contractReplies')
            ->findOrFail($this->contract_id);
    }
}
