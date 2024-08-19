<?php

namespace App\Http\Livewire\Admin\Role;

use App\Models\Role;
use Livewire\Component;

class Details extends Component
{
    public $Role;

    public function getListeners()
    {
        return [
            'admin-role-updated' => '$refresh'
        ];
    }

    public function mount($role_id)
    {
        $this->Role = Role::with('permissions', 'admins')
            ->withCount('admins')
            ->findOrFail($role_id);
    }

    public function render()
    {
        return view('livewire.admin.role.details')->layout('layouts.admin.app');
    }

    public function showAdminUpdateRole($role_id)
    {
        $this->emit('show-admin-update-role-modal', [
            'role_id' => $role_id
        ]);
    }

    public function showAdminAddUserRole($role_id)
    {
        $this->emit('show-add-user-role-modal', [
            'role_id' => $role_id
        ]);
    }
}
