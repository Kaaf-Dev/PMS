<?php

namespace App\Http\Livewire\Layoutes\Admin;

use App\Traits\WithLazyLoad;
use Livewire\Component;

class AppHeader extends Component
{
    use WithLazyLoad;

    public function render()
    {
        $notifications = $this->ready_to_load ? $this->getNotificationList() : [];
        $view_data = [
            'notifications' => $notifications
        ];
        return view('livewire.layoutes.admin.app-header', $view_data);
    }


    public function getNotificationList()
    {
        return auth('admin')->user()->unreadNotifications;
    }
}
