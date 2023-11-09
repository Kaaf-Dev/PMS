<?php

namespace App\Http\Livewire\Maintenance\Invoice\Form;

use App\Models\MaintenanceInvoice;
use App\Models\Ticket;
use App\Traits\WithAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateForm extends Component
{

    use AuthorizesRequests;
    use WithFileUploads;
    use WithAlert;

    public $selected_ticket_id;

    public $maintenance_amount;
    public $notes;

    public $attachments;
    public $attachment;

    public function rules()
    {
        return [
            'selected_ticket_id' => 'required|exists:tickets,id',
            'maintenance_amount' => 'required|numeric',
            'notes' => 'nullable|string|max:2000',
            'attachments.*' => 'nullable|mimes:png,jpg,jpeg|max:1024',
        ];
    }


    public function getListeners()
    {
        return [
            'show-maintenance-invoice-create-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.maintenance.invoice.form.create-form');
    }

    public function updatedAttachment()
    {
        $this->validate([
            'attachment' => 'required|mimes:png,jpg,jpeg|max:10240', // 1MB Max
        ]);
        $this->attachments[md5(time())] = $this->attachment;
        $this->reset([
            'attachment',
        ]);
    }

    public function cancelAttachment($attachment)
    {
        if (isset($this->attachments[$attachment])) {
            unset($this->attachments[$attachment]);
        }
    }

    public function resolveParams($params = [])
    {
        if (isset($params['ticket_id'])) {
            $this->selected_ticket_id = $params['ticket_id'];
        }
    }

    public function getTicketProperty()
    {
        return Ticket::find($this->selected_ticket_id);
    }

    public function submit()
    {
        $validated_data = $this->validate();
        $this->authorize('createInvoice', $this->ticket);

        $invoice = new MaintenanceInvoice();
        $invoice->ticket_id = $validated_data['selected_ticket_id'];
        $invoice->maintenance_company_id = Auth::user()->id;
        $invoice->maintenance_amount = $validated_data['maintenance_amount'];
        $invoice->notes = $validated_data['notes'];
        if ($invoice->save()) {
            $attachments = [];
            foreach ($validated_data['attachments'] ?? [] as $attachment) {
                $attachments[] = [
                    'path' =>  $attachment->store('maintenanceInvoice-' . md5($invoice->id), 'ticket_attachments'),
                    'file_name' => $attachment->getClientOriginalName(),
                ];
            }

            $invoice->attachments()->createMany($attachments);
            $this->closeMe();
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->emit('invoice-added');

        } else {
            $this->showWarningAlert('يرجى المحاولة مرة أخرى!');
        }

    }

    public function closeMe()
    {
        $this->resetInputs();
        $this->emit('hide-maintenance-invoice-create-modal');
    }

    public function resetInputs()
    {
        $this->reset([
            'selected_ticket_id',
            'maintenance_amount',
            'notes',
            'attachments',
            'attachment',
        ]);
    }
}
