<?php

namespace App\Http\Livewire\Admin\Contract\Forms;

use App\Models\Contract;
use App\Traits\WithAlert;
use Carbon\Carbon;
use Livewire\Component;

class UpdateDuration extends Component
{
    use WithAlert;

    public $contract;
    public $duration;

    public function rules()
    {
        return [
            'duration.start.year' => 'required|numeric|min:1900',
            'duration.start.month' => 'required|numeric|between:1,12',
            'duration.end.year' => 'required|numeric|gte:duration.start.year',
            'duration.end.month' => 'required|numeric|between:1,12',
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
            'numeric' => 'قيمة غير صالحة',
            'gte' => 'الفترة غير صالحة',
            'between' => 'القيمة غير صحيحة',
        ];
    }

    public function getListeners()
    {
        return [
            'show-contract-update-duration-modal' => 'selectContract',
        ];
    }

    public function render()
    {
        return view('livewire.admin.contract.forms.update-duration');
    }

    public function selectContract($params = [])
    {
        $this->resetFields();
        $contract_id = $params['contract_id'] ?? 0;
        $this->contract = Contract::findOrFail($contract_id);
        $this->duration['start']['year'] = optional($this->contract)->start_at->format('Y');
        $this->duration['start']['month'] = optional($this->contract)->start_at->format('m');
        $this->duration['end']['year'] = optional($this->contract)->end_at->format('Y');
        $this->duration['end']['month'] = optional($this->contract)->end_at->format('m');
    }

    public function resetFields()
    {
        $this->resetErrorBag();
        $this->reset([
            'contract',
            'duration',
        ]);
    }

    public function closeModal()
    {
        $this->emit('hide-contract-update-duration-modal');
    }

    public function save()
    {
        $validated_data = $this->validate();
        $duration = $validated_data['duration'];

        $start_at = Carbon::create($duration['start']['year'], $duration['start']['month'], 1)
            ->startOfMonth()
            ->format('Y-m-d');

        $end_at = Carbon::create($duration['end']['year'], $duration['end']['month'], 1)
            ->endOfMonth()
            ->format('Y-m-d');

        $this->contract->start_at = $start_at;
        $this->contract->end_at = $end_at;

        if ($this->contract->save()) {
            $this->showSuccessAlert('تمت العملية بنجاح');
            $this->emit('contract-updated-duration');
            $this->closeModal();
        } else {
            $this->showWarningAlert('يرجى المحاولة لاحقًا!');
        }

    }
}
