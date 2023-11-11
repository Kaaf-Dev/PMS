<?php

namespace App\Http\Livewire\Admin\Contract\Forms;

use App\Models\ContractAttachment;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteFileAttac extends Component
{
    use WithAlert;

    public $contractFile;


    public function getListeners()
    {
        return [
            'show-delete-contract-file-modal' => 'deleteContractFile',
        ];
    }

    public function deleteContractFile(ContractAttachment $contractFile)
    {
        $this->contractFile = $contractFile;
    }

    public function render()
    {
        return view('livewire.admin.contract.forms.delete-file-attac');
    }

    public function delete()
    {
        if ($this->contractFile) {
            Storage::disk('contract_file')->delete($this->contractFile->file_path);
            ContractAttachment::destroy($this->contractFile->id);
            $this->emit('hide-delete-contract-file-modal');
            $this->emit('refreshContractFileTable');
            $this->showSuccessAlert('تم حذف بنجاح');
            $this->reset();

        } else {
            abort(404);
        }
    }

    public function discard()
    {
        $this->emit('hide-delete-contract-file-modal');
        $this->reset();
    }
}
