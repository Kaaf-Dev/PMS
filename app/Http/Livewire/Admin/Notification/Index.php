<?php

namespace App\Http\Livewire\Admin\Notification;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.notification.index')->layout('layouts.admin.app');
    }
}
