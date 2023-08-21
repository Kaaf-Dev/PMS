<?php

namespace App\Http\Livewire\User\Ticket\Details;

use App\Models\Ticket;
use App\Traits\WithAlert;
use Livewire\Component;

class Rating extends Component
{

    use WithAlert;

    public $ticket_id;
    public $rate_stars;
    public $rate_notes;

    public function rules()
    {
        return [
            'rate_stars' => 'required|integer',
            'rate_notes' => 'nullable',
        ];
    }

    public function mount($ticket)
    {
        $this->ticket_id = $ticket;
    }

    public function render()
    {
        return view('livewire.user.ticket.details.rating');
    }

    public function getTicketProperty()
    {
        return Ticket::findOrFail($this->ticket_id);
    }

    public function rate($rate)
    {
        if (1 <= $rate and $rate <= 5) {
            $this->rate_stars = $rate;
        }
    }

    public function submit()
    {
        $validated_data = $this->validate();
        $this->ticket->rate_stars = $validated_data['rate_stars'];
        $this->ticket->rate_notes = $validated_data['rate_notes'] ?? '';

        if ($this->ticket->save()) {
            $this->emit('ticket-rated');
            $this->showSuccessAlert('تم إرسال التقييم، شكرًا لك!');
        } else {
            $this->showErrorAlert('عذرًا حدثت مشكلة أثناء التقييم، برجى المحاولة لاحقًا!');
        }

    }
}
