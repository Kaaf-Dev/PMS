<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ListTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $ready_to_load = false;
    public $search;

    public function rules()
    {
        return [

        ];
    }

    public function getListeners()
    {
        return [
            'user-added' => '$refresh',
        ];
    }

    public function updated($property)
    {
        if ($property == 'search') {
            $this->resetPage();
        }

    }

    public function render()
    {
        $users = ($this->ready_to_load) ? $this->loadUsers() : [];
        $view_data = [
            'users' => $users,
        ];
        return view('livewire.admin.users.list-table', $view_data);
    }

    public function load()
    {
        $this->ready_to_load = true;
    }

    public function loadUsers()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orWhere('cpr', 'like', '%' . $this->search . '%')
            ->orWhere('contact_phone', 'like', '%' . $this->search . '%')
            ->orWhere('whatsapp_phone', 'like', '%' . $this->search . '%');
        return $users->paginate();
    }

    public function showAddUser()
    {
        $this->emit('show-user-add-modal');
    }
}
