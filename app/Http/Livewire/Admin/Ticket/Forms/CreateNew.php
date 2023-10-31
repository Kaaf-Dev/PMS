<?php

namespace App\Http\Livewire\Admin\Ticket\Forms;

use App\Models\ContractApartment;
use App\Models\Property;
use App\Models\Ticket;
use App\Models\User;
use App\Traits\WithAlert;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateNew extends Component
{
    use WithFileUploads;
    use WithAlert;
    use AuthorizesRequests;

    public $ticket_categories;

    public $properties;

    public $selected_user_id;
    public $selected_property;
    public $selected_contract_apartment;
    public $subject;
    public $description;

    public $attachments;
    public $attachment;

    public $visit_availability_at;

    public function rules()
    {
        return [
            'selected_user_id' => 'required|exists:users,id',
            'selected_property' => 'required|exists:properties,id',
            'selected_contract_apartment' => 'required|exists:contract_apartment,id',
            'subject' => 'required',
            'description' => 'required|max:5000',
            'attachments.*' => 'required|mimes:png,jpg,jpeg|max:1024',
            'visit_availability_at' => [
                'required',
                Rule::in(Ticket::getVisitAvailabilityAtValues()),
            ]
        ];
    }

    public function getMessages()
    {
        return [
            'exists' => 'لا يوجد بيانات للحقل المحدد',
            'required' => 'هذا الحقل إجباري',
            'description.max' => 'لا يمكن تجاوز :max حرف',
            'attachment.max' => 'لا يمكن تجاوز :max MB',
            'mimes' => 'الصورة غير صالحة',
        ];
    }

    public function getListeners()
    {
        return [
            'show-ticket-create-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.admin.ticket.forms.create-new');
    }

    public function updated($property)
    {
        if ($property == 'selected_user_id') {
            $this->fetchProperties();
        }
    }

    public function resolveParams($params = [])
    {
        $this->resetInputs();
        $this->resetErrorBag();
    }

    public function getUsersProperty()
    {
        return User::all();
    }

    public function getUserProperty()
    {
        return User::find($this->selected_user_id);
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

    public function getContracts()
    {
        $user = $this->user;
        $contracts = [];
        if ($this->user) {
            $contracts = $user->contracts()
                ->with([
                    'apartments.property',
                ])->get();
        }
        return $contracts;
    }

    public function fetchProperties()
    {
        $contracts = $this->getContracts();
        if ($contracts) {
            $contract_ids = $contracts->pluck('id')->toArray();
            $apartments = DB::table('contract_apartment')
                ->join('apartments', 'contract_apartment.apartment_id', '=', 'apartments.id')
                ->whereIn('contract_id', $contract_ids)
                ->get();
            $property_ids = $apartments->pluck('property_id')->toArray();
            $this->properties = Property::whereIn('id', $property_ids)->get();
        } else {
            return [];
        }
    }

    public function getApartmentsProperty()
    {
        $contracts = $this->getContracts();
        if ($contracts) {
            $contract_ids = $contracts->pluck('id')->toArray();
            $apartments = DB::table('contract_apartment')
                ->selectRaw('*, contract_apartment.id as contract_apartment_id')
                ->join('apartments', 'contract_apartment.apartment_id', '=', 'apartments.id')
                ->whereIn('contract_id', $contract_ids)
                ->where('property_id', '=', $this->selected_property)
                ->get();

            return $apartments;
        } else {
            return [];
        }
    }

    public function getVisitAvailabilityAtListProperty()
    {
        return Ticket::getVisitAvailabilityAtList();
    }

    public function getHoursProperty()
    {
        $hoursArray = [];
        for ($hour = 0; $hour < 24; $hour++) {
            $hoursArray[] = str_pad($hour, 2, '0', STR_PAD_LEFT);
        }
        return $hoursArray;
    }

    public function getMinutesProperty()
    {
        $minutesArray = [];
        for ($minute = 0; $minute <= 55; $minute += 5) {
            $minutesArray[] = str_pad($minute, 2, '0', STR_PAD_LEFT);
        }
        return $minutesArray;
    }

    public function resolveVisitAvailabilityStart()
    {
        $date = null;
        if ($this->visit_availability_start_hour and $this->visit_availability_start_min) {
            $date = Carbon::createFromTime($this->visit_availability_start_hour, $this->visit_availability_start_min);
        }
        return $date;
    }

    public function resolveVisitAvailabilityEnd()
    {
        $date = null;
        if ($this->visit_availability_end_hour and $this->visit_availability_end_min) {
            $date = Carbon::createFromTime($this->visit_availability_end_hour, $this->visit_availability_end_min);
        }
        return $date;
    }

    public function submit()
    {
        $validated_data = $this->validate();
        $ticket = new Ticket();

        $contract_apartment = ContractApartment::find($this->selected_contract_apartment);

        $ticket->contract_id = $contract_apartment->contract_id;
        $ticket->property_id = $validated_data['selected_property'];
        $ticket->apartment_id = $contract_apartment->apartment_id;
        $ticket->subject = $validated_data['subject'];
        $ticket->description = $validated_data['description'];

        $ticket->visit_availability_at = $validated_data['visit_availability_at'];

        if ($ticket->save()) {
            $attachments = [];
            foreach ($validated_data['attachments'] ?? [] as $attachment) {
                $attachments[] = [
                    'path' =>  $attachment->store(md5($ticket->id), 'ticket_attachments'),
                    'file_name' => $attachment->getClientOriginalName(),
                ];
            }
            $ticket_attachments = $ticket->ticketAttachments()->createMany($attachments);
            return $this->redirect(route('admin.tickets.details', ['ticket_id' => $ticket->id]));
        } else {
            $this->showErrorAlert('لا يمكن تسجيل الطلب في الوقت الحالي، يرجى المحاولة لاحقًا!');
        }
    }

    public function hideMe()
    {
        $this->emit('hide-ticket-create-modal');
    }

    public function resetInputs()
    {
        $this->reset([
            'selected_user_id',
            'selected_property',
            'selected_contract_apartment',
            'subject',
            'description',
            'attachment',
            'attachments',
            'visit_availability_at',
        ]);
    }

}
