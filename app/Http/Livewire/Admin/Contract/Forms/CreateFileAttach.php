<?php

namespace App\Http\Livewire\Admin\Contract\Forms;

use App\Models\ContractAttachment;
use App\Traits\WithAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateFileAttach extends Component
{
    use WithAlert;
    use WithFileUploads;

    public $files;
    public $contract_id;


    public function getListeners()
    {
        return [
            'show-add-contract-file-modal' => 'showContractFile',
        ];
    }

    public function rules()
    {
        return [
            'files.*' => 'required|mimes:pdf,png,jpeg,xlsx,jpg|max:5000',
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل اجباري',
            'mimes' => 'يجب أن يكون إمتداد:pdf,png,jpeg,xlsx,jpg ',
            'max' => 'يجب ان لا يتجاوز حجم المرفق 5Mb'

        ];
    }

    public function showContractFile($contract_id)
    {
        $this->contract_id = $contract_id;
    }

    public function render()
    {
        return view('livewire.admin.contract.forms.create-file-attach');
    }

    public function save()
    {
        $this->validate();
        foreach ($this->files as $file) {
            $contract_file = new ContractAttachment();
            $contract_file->file_name = $file->getClientOriginalName();
            $contract_file->contract_id = $this->contract_id;
            $contract_file->file_path = $file->store($this->contract_id, 'contract_file');
            $contract_file->save();
        }
        $this->reset();
        $this->emit('hide-add-contract-file-modal');
        $this->showSuccessAlert('تم الحفظ بنجاح');
        $this->emit('refreshContractFileTable');
    }


    public function discard()
    {
        $this->emit('hide-add-contract-file-modal');
        $this->reset();
    }
}
