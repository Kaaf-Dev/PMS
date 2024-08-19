<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Role;
use App\Traits\WithLazyLoad;
use Livewire\Component;

class ListTable extends Component
{
    use WithLazyLoad;

    public function getListeners()
    {
        return [
            'role-list-updated' => '$refresh',
        ];
    }

    public function render()
    {
        $roles = $this->ready_to_load ? $this->getRoleList() : [];
        $view_data = [
            'roles' => $roles
        ];
        return view('livewire.admin.role.list-table', $view_data);
    }

    public function getRoleList()
    {
        return Role::with(['permissions'])
            ->withCount('admins')
            ->get();
    }

    public function showCreateRole()
    {
        $this->emit('show-admin-create-role-modal');
    }

    public function showAdminUpdateRole($role_id)
    {
        $this->emit('show-admin-update-role-modal', [
            'role_id' => $role_id
        ]);
    }
}
