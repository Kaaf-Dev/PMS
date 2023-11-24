<?php

namespace App\Http\Livewire\Admin\Users;

use App\Exports\LateRentReport;
use App\Exports\UserReport;
use App\Models\User;
use App\Traits\WithAlert;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ListTable extends Component
{
    use WithPagination;
    use WithAlert;

    protected $paginationTheme = 'bootstrap';

    public $ready_to_load = false;
    public $search;
    public $users_id = [];

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

    public function exportExcel()
    {
        return Excel::download(new UserReport(), 'users.xlsx');

    }

    public function showAddUser()
    {
        $this->emit('show-user-add-modal');
    }

    public function sendEmail()
    {
        if ($this->users_id) {
            $users = User::whereIn('id', $this->users_id)->get();
            if ($users) {
                foreach ($users as $user) {
                    $password = Hash::make($user->cpr);
                    if ($user->update(['password' => $password])) {
                        dispatch(new \App\Jobs\UserLoginEmail($user));

                    }
                }
                $this->showSuccessAlert('تم العملية بنجاح ');
            }
        }

    }
}
