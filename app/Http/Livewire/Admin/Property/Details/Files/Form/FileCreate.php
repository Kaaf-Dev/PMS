<?php

namespace App\Http\Livewire\Admin\Property\Details\Files\Form;

use App\Models\PropertyFile;
use App\Traits\WithAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileCreate extends Component
{
    use WithFileUploads;
    use WithAlert;

    public $files;
    public $property_id;

    public function getListeners()
    {
        return [
            'show-add-property-file-modal' => 'showPropertyFile',
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

    public function showPropertyFile($property_id)
    {
        $this->property_id = $property_id;
    }

    public function render()
    {
        return view('livewire.admin.property.details.files.form.file-create');
    }

    public function save()
    {
        $this->validate();
        foreach ($this->files as $file) {
            $property_file = new PropertyFile();
            $property_file->file_name = $file->getClientOriginalName();
            $property_file->property_id = $this->property_id;
            $property_file->file_path = $file->store($this->property_id, 'property_file');
            $property_file->save();
        }
        $this->reset();
        $this->emit('hide-add-property-file-modal');
        $this->showSuccessAlert('تم الحفظ بنجاح');
        $this->emit('refreshPropertyFileTable');
    }


    public function discard()
    {
        $this->emit('hide-add-property-file-modal');
        $this->reset();
    }
}
