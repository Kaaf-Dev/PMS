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

    public function updated($property, $value)
    {
        if ($property == 'search') {
            $this->resetPage();
        }

    }

    public function render()
    {
        $users = ($this->ready_to_load) ? $this->loadUsers() : false;
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

        $users = User::where('name', 'like', '%'. $this->search .'%')
            ->orWhere('username', 'like', '%'. $this->search .'%')
            ->orWhere('email', 'like', '%'. $this->search .'%')
        ;
        return $users->paginate();
    }
}
