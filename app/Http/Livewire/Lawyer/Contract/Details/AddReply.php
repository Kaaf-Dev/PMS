<?php

namespace App\Http\Livewire\Lawyer\Contract\Details;

use App\Models\Contract;
use App\Traits\WithAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddReply extends Component
{

    use AuthorizesRequests;
    use WithAlert;

    public $contract_id;
    public $reply;

    public function rules()
    {
        return [
            'reply' => 'required|string|max:2000',
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
        ];
    }

    public function mount($contract)
    {
        $this->contract_id = $contract;
    }

    public function render()
    {
        return view('livewire.lawyer.contract.details.add-reply');
    }

    public function getContractProperty()
    {
        return Contract::findOrFail($this->contract_id);
    }

    public function sendReply()
    {
        $validated_data = $this->validate();
        $this->authorize('reply', $this->contract);

        $reply = $this->contract->contractReplies()->create([
            'lawyer_id' => Auth::guard('lawyer')->user()->id,
            'content' => $validated_data['reply'],
        ]);

        if ($reply) {
            $this->contract->touch();
            $this->resetInputs();
            $this->emit('reply-added');
        } else {
            $this->showErrorAlert('لا يمكن إضافة الرد في الوقت الحالي');
        }
    }

    public function resetInputs()
    {
        $this->reset([
            'reply',
        ]);
    }


}
