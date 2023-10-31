<?php

namespace App\Http\Livewire\Admin\Property\Details\Files\Form;

use App\Models\PropertyFile;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class FileDelete extends Component
{
    use WithAlert;

    public $propertyFile;


    public function getListeners()
    {
        return [
            'show-delete-property-file-modal' => 'deletePropertyFile',
        ];
    }


    public function deletePropertyFile(PropertyFile $propertyFile)
    {
        $this->propertyFile = $propertyFile;
    }

    public function render()
    {
        return view('livewire.admin.property.details.files.form.file-delete');
    }

    public function delete()
    {
        if ($this->propertyFile) {
            Storage::disk('property_file')->delete($this->propertyFile->file_path);
            PropertyFile::destroy($this->propertyFile->id);
            $this->emit('hide-delete-property-file-modal');
            $this->emit('refreshPropertyFileTable');
            $this->showSuccessAlert('تم حذف بنجاح');
            $this->reset();

        } else {
            abort(404);
        }
    }

    public function discard()
    {
        $this->emit('hide-delete-property-file-modal');
        $this->reset();
    }
}
