<?php

namespace App\Http\Livewire\Admin\TicketCategory\Form;

use App\Models\TicketCategory;
use App\Traits\WithAlert;
use Livewire\Component;

class DeleteVerify extends Component
{

    use WithAlert;

    public $ticket_category;

    public function getListeners()
    {
        return [
            'show-ticket-category-delete-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.ticket-category.form.delete-verify');
    }

    public function resolveParams($params)
    {
        if (isset($params['ticket_category'])) {
            $this->ticket_category = TicketCategory::findOrFail($params['ticket_category']);
        }
    }

    public function submit()
    {
        if ($this->ticket_category->delete()) {
            $this->emit('ticket-category-deleted');
            $this->showSuccessAlert('تمت العملية بنجاح!');
            $this->closeMe();
        } else {
            $this->showWarningAlert('يرجى التحقق من البيانات وإعادة المحاولة لاحقًا');
        }
    }

    public function closeMe()
    {
        $this->emit('hide-ticket-category-delete-modal');
    }

}
