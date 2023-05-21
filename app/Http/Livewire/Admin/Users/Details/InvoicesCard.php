<?php

namespace App\Http\Livewire\Admin\Users\Details;

use App\Models\User;
use Livewire\Component;

class InvoicesCard extends Component
{
    public $User;

    public function mount($user_id = null)
    {
        $this->User = User::findOrFail($user_id);
    }

    public function render()
    {
        return view('livewire.admin.users.details.invoices-card');
    }

    public function getInvoicesProperty()
    {
        $invoices = $this->User->invoices()
            ->orderBy('date', 'desc')
            ->get();

        return $invoices->groupBy(function ($item, $key) { // arrange by year
            return $item->date->format('Y');
        });
    }
}
