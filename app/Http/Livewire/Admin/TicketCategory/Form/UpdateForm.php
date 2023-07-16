<?php

namespace App\Http\Livewire\Admin\TicketCategory\Form;

use App\Models\TicketCategory;
use App\Traits\WithAlert;
use Livewire\Component;

class UpdateForm extends Component
{
    use WithAlert;

    public $ticket_category;

    public function rules()
    {
        return [
            'ticket_category.title' => 'required',
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
        ];
    }

    public function getListeners()
    {
        return [
            'show-ticket-category-update-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.ticket-category.form.update-form');
    }

    public function resolveParams($params)
    {
        if (isset($params['ticket_category'])) {
            $this->ticket_category = TicketCategory::findOrFail($params['ticket_category']);
        }
    }

    public function submit()
    {
        $validated_data = $this->validate();
        if ($this->ticket_category->save()) {
            $this->emit('ticket-category-updated');
            $this->showSuccessAlert('تمت العملية بنجاح!');
            $this->closeMe();
        } else {
            $this->showWarningAlert('يرجى التحقق من البيانات وإعادة المحاولة لاحقًا');
        }
    }

    public function discard()
    {
        $this->resetErrorBag();
        $this->ticket_category->refresh();
    }

    public function closeMe()
    {
        $this->discard();
        $this->emit('hide-ticket-category-update-modal');
    }

}
