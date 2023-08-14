<?php

namespace App\Http\Livewire\User\Ticket\Form;

use App\Models\ContractApartment;
use App\Models\Property;
use App\Models\Ticket;
use App\Traits\WithAlert;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateForm extends Component
{

    use WithFileUploads;
    use WithAlert;
    use AuthorizesRequests;

    public $ticket_categories;

    public $properties;

    public $selected_property;
    public $selected_contract_apartment;
    public $subject;
    public $description;

    public $attachments;
    public $attachment;

    public $visit_availability_start_hour;
    public $visit_availability_start_min;

    public $visit_availability_end_hour;
    public $visit_availability_end_min;

    public function rules()
    {
        return [
            'selected_property' => 'required|exists:properties,id',
            'selected_contract_apartment' => 'required|exists:contract_apartment,id',
            'subject' => 'required',
            'description' => 'required|max:5000',
            'attachments.*' => 'required|mimes:png,jpg,jpeg|max:1024',
            'visit_availability_start_hour' => 'nullable|numeric',
            'visit_availability_start_min' => 'nullable|numeric',
            'visit_availability_end_hour' => 'nullable|numeric',
            'visit_availability_end_min' => 'nullable|numeric',
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
            'show-user-ticket-create-modal' => 'resolveParams',
        ];
    }

    public function render()
    {
        return view('livewire.user.ticket.form.create-form');
    }

    public function resolveParams($params = [])
    {
        $this->resetInputs();
        $this->resetErrorBag();
        $this->fetchProperties();

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
        $this->showSuccessAlert('تمت إضافة المرفق بنجاح!');
    }

    public function cancelAttachment($attachment)
    {
        if (isset($this->attachments[$attachment])) {
            unset($this->attachments[$attachment]);
        }
    }

    public function getContracts()
    {
        return Auth::user()->contracts()
            ->with([
                'apartments.property',
            ])->get();
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

    public function fetchProperties()
    {
        $contracts = $this->getContracts();
        $contract_ids = $contracts->pluck('id')->toArray();
        $apartments = DB::table('contract_apartment')
            ->join('apartments', 'contract_apartment.apartment_id', '=', 'apartments.id')
            ->whereIn('contract_id', $contract_ids)
            ->get();
        $property_ids = $apartments->pluck('property_id')->toArray();
        $this->properties = Property::whereIn('id', $property_ids)->get();
    }

    public function getApartmentsProperty()
    {
        $contracts = $this->getContracts();
        $contract_ids = $contracts->pluck('id')->toArray();

        $apartments = DB::table('contract_apartment')
            ->selectRaw('*, contract_apartment.id as contract_apartment_id')
            ->join('apartments', 'contract_apartment.apartment_id', '=', 'apartments.id')
            ->whereIn('contract_id', $contract_ids)
            ->where('property_id', '=', $this->selected_property)
            ->get();

        return $apartments;
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
        $this->authorize('createTicket', $contract_apartment);

        $ticket->contract_id = $contract_apartment->contract_id;
        $ticket->property_id = $validated_data['selected_property'];
        $ticket->apartment_id = $contract_apartment->apartment_id;
        $ticket->subject = $validated_data['subject'];
        $ticket->description = $validated_data['description'];

        $ticket->visit_availability_start = $this->resolveVisitAvailabilityStart();
        $ticket->visit_availability_end = $this->resolveVisitAvailabilityEnd();

        if ($ticket->save()) {
            $attachments = [];
            foreach ($validated_data['attachments'] ?? [] as $attachment) {
                $attachments[] = [
                    'path' =>  $attachment->store(md5($ticket->id), 'ticket_attachments'),
                    'file_name' => $attachment->getClientOriginalName(),
                ];
            }
            $ticket_attachments = $ticket->ticketAttachments()->createMany($attachments);
            $this->showSuccessAlert('تمت إضافة الطلب بنجاح');
            $this->hideMe();
            $this->emit('ticket-added');
            $this->resetInputs();
        } else {
            $this->showErrorAlert('لا يمكن تسجيل الطلب في الوقت الحالي، يرجى المحاولة لاحقًا!');
        }
    }

    public function hideMe()
    {
        $this->emit('hide-user-ticket-create-modal');
    }

    public function resetInputs()
    {
        $this->reset([
            'selected_property',
            'selected_contract_apartment',
            'subject',
            'description',
            'attachment',
            'attachments',
            'visit_availability_start_hour',
            'visit_availability_start_min',
            'visit_availability_end_hour',
            'visit_availability_end_min',
        ]);
    }
}
