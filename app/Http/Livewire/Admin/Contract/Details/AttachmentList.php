<?php

namespace App\Http\Livewire\Admin\Contract\Details;

use App\Models\Contract;
use App\Models\ContractAttachment;
use Livewire\Component;

class AttachmentList extends Component
{
    public $contract;

    public function getListeners()
    {
        return [
            'refreshContractFileTable' => '$refresh',
        ];
    }

    public function mount(Contract $contract_id)
    {
        $this->contract = $contract_id;
    }

    public function render()
    {
        return view('livewire.admin.contract.details.attachment-list');
    }

    public function showAddContractFileModal()
    {
        $this->emit('show-add-contract-file-modal', $this->contract->id);
    }

    public function deleteFile($file_id)
    {
        $this->emit('show-delete-contract-file-modal', $file_id);
    }


}
