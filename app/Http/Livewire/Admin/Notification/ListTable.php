<?php

namespace App\Http\Livewire\Admin\Notification;

use Livewire\Component;

class ListTable extends Component
{
    public $ready_to_load = false;

    public function load()
    {
        $this->ready_to_load = true; // Set it to true when called
    }


    public function render()
    {
        $notifications = $this->ready_to_load ? $this->getNotificationList() : [];
        $view_data = [
            'notifications' => $notifications
        ];
        return view('livewire.admin.notification.list-table', $view_data);
    }

    public function getNotificationList()
    {
        return auth('admin')->user()->unreadNotifications;
    }
}
