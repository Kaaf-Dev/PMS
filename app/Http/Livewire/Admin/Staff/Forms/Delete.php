<?php

namespace App\Http\Livewire\Admin\Staff\Forms;

use App\Models\Admin;
use App\Traits\WithAlert;
use Livewire\Component;

class Delete extends Component
{
    use WithAlert;

    public $Admin;

    public function getListeners()
    {
        return [
            'show-delete-admin-modal' => 'restParams'
        ];
    }

    public function restParams($params)
    {
        $this->resetFields();
        if (isset($params['admin_id'])) {
            $this->Admin = Admin::findOrFail($params['admin_id']);
        } else {
            abort(404);
        }
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.staff.forms.delete');
    }

    public function delete()
    {
        if ($this->Admin->delete()) {
            $this->showSuccessAlert('تمت عملية الحذف بنجاح');
            $this->emit('staff-updated');
            $this->discard();
        } else {
            $this->showErrorAlert('حدث خطأ غير متوقع');
        }
    }

    public function discard()
    {
        $this->emit('hide-delete-admin-modal');
    }
}
