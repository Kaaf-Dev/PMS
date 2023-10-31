<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Details extends Component
{

//    public $user_id;
    public $User;
    public $user_image_path, $cpr_image_path, $iban_image_path, $merchant_image_path;

    public function getListeners()
    {
        return [
            'refresh' => '$refresh',
        ];
    }

    public function rules()
    {
        $rules = [];
        $rules['User.name'] = 'required';
        $rules['User.email'] = 'required|email';
        $rules['User.phone'] = 'required|digits:8';
        $rules['User.whatsapp_phone'] = 'nullable|digits:8';
        $rules['User.user_type'] = 'required|integer';
        $rules['User.gender'] = 'required|integer';
        $rules['User.cpr'] = 'required|digits:9';
        return $rules;
    }

    public function mount($user_id)
    {
        $this->User = User::findOrFail($user_id);
    }

    public function render()
    {
        return view('livewire.admin.users.details')
            ->layout('layouts.admin.app');
    }

//    public function getUserProperty()
//    {
//        $this->User = User::find($this->user_id);
//        if ($this->User) {
//            return $this->User;
//        }
//        abort(404);
//    }

    public function save()
    {
        $this->validate();
        if (isset($this->user_image_path)) {
            $this->User->user_image_path = $this->user_image_path->store($this->User->cpr, 'user_image');
        }
        if (isset($this->cpr_image_path)) {
            $this->User->cpr_image_path = $this->cpr_image_path->store($this->User->cpr, 'user_image');
        }
        if (isset($this->iban_image_path)) {
            $this->User->iban_image_path = $this->iban_image_path->store($this->User->cpr, 'user_image');
        }
        if (isset($this->merchant_image_path)) {
            $this->User->merchant_image_path = $this->merchant_image_path->store($this->User->cpr, 'user_image');
        }
        $this->User->save();
        $this->emit('refresh');
    }
}
