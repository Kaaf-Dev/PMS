<?php

namespace App\Http\Livewire\Admin\Contract\Details;

use App\Models\Contract;
use Livewire\Component;

class Overview extends Component
{

    public $contract_id;

    public $show_user;
    public $show_contract_link;
    public $show_notes;
    public $show_edit_notes;

    public $presets = [
        'contract_page' => [
            'show_user' => false,
            'show_contract_link' => false,
            'show_notes' => true,
            'show_edit_notes' => true,
        ],
        'invoice_page' => [
            'show_user' => true,
            'show_contract_link' => true,
            'show_notes' => true,
            'show_edit_notes' => false,
        ],
    ];

    public function getListeners()
    {
        return [
            'contract-updated-notes' => '$refresh',
        ];
    }

    public function mount($contract_id, $show_user = true, $show_contract_link = true, $show_notes = true, $preset = null)
    {
        $this->contract_id = $contract_id;

        if ($preset) {
            $this->setPreset($preset);
        } else {
            $this->show_notes = $show_notes;
            $this->show_contract_link = $show_contract_link;
            $this->show_user = $show_user;
        }

    }

    public function render()
    {
        return view('livewire.admin.contract.details.overview');
    }

    public function setPreset($preset)
    {
        if ($preset and isset($this->presets[$preset])) {
            $this->fill($this->presets[$preset]);
        }
    }

    public function getContractProperty()
    {
        return Contract::findOrFail($this->contract_id);
    }

    public function editNotes()
    {
        $this->emit('show-contract-update-notes-modal', [
            'contract_id' => $this->contract_id,
        ]);
    }
}
