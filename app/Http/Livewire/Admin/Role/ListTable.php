<?php

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;

class ListTable extends Component
{
    public function render()
    {
        return view('livewire.admin.role.list-table');
    }

    public function showCreateRole()
    {
        $this->emit('show-admin-create-role-modal');
    }
}
