<?php

namespace App\Http\Livewire\Admin\Staff;

use App\Models\Admin;
use App\Traits\WithLazyLoad;
use Livewire\Component;

class ListTable extends Component
{
    use WithLazyLoad;

    public function getListeners()
    {
        return [
            'staff-updated' => '$refresh'
        ];
    }

    public function render()
    {
        $admins = $this->ready_to_load ? $this->loadAdmins() : [];
        $view_data = [
            'admins' => $admins
        ];
        return view('livewire.admin.staff.list-table', $view_data);
    }

    public function loadAdmins()
    {
        return Admin::paginate();
    }

    public function showAddAdmin()
    {
        $this->emit('show-add-admin-modal');
    }

    public function showDeleteAdmin($admin_id)
    {
        $this->emit('show-delete-admin-modal',[
            'admin_id' => $admin_id
        ]);
    }

    public function showUpdateAdmin($admin_id)
    {
        $this->emit('show-update-admin-modal',[
            'admin_id' => $admin_id
        ]);
    }
}
