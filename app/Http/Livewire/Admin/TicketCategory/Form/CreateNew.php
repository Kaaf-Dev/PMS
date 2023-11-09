<?php

namespace App\Http\Livewire\Admin\TicketCategory\Form;

use App\Models\TicketCategory;
use App\Traits\WithAlert;
use Livewire\Component;

class CreateNew extends Component
{

    use WithAlert;

    public $title;

    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
        ];
    }

    public function render()
    {
        return view('livewire.admin.ticket-category.form.create-new');
    }

    public function submit()
    {
        $validated_data = $this->validate();
        $ticket_category = new TicketCategory($validated_data);
        if ($ticket_category->save()) {
            $this->emit('ticket-category-added');
            $this->showSuccessAlert('تمت العملية بنجاح!');
            $this->closeMe();
        } else {
            $this->showWarningAlert('يرجى التحقق من البيانات وإعادة المحاولة لاحقًا');
        }
    }

    public function discard()
    {
        $this->resetErrorBag();
        $this->reset([
            'title',
        ]);
    }

    public function closeMe()
    {
        $this->discard();
        $this->emit('hide-ticket-category-create-modal');
    }

}
