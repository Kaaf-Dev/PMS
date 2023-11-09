<?php

namespace App\Http\Livewire\Lawyer\Contract\Details;

use App\Models\Contract;
use Livewire\Component;

class Summary extends Component
{

    public $contract_id;

    public $attachments_list = [
        'common' => [],
        'person' => [
            [
                'title' => 'البطاقة الشخصية',
                'attribute' => 'cpr_image_path',
            ],

            [
                'title' => 'سجل IBAN',
                'attribute' => 'iban_image_path',
            ],
        ],
        'person|non_bahrinian' => [
            [
                'title' => 'جواز السفر',
                'attribute' => 'passport_path',
            ],
        ],
        'corporate' => [
            [
                'title' => 'سند التسجيل',
                'attribute' => 'merchant_image_path',
            ],
            [
                'title' => 'السجل التجاري',
                'attribute' => 'corporate_register_path',
            ],
        ],
    ];

    public function mount($contract)
    {
        $this->contract_id = $contract;
    }

    public function render()
    {
        return view('livewire.lawyer.contract.details.summary');
    }

    public function getContractProperty()
    {
        return Contract::with([
            'user',
            'user.nationality',
        ])->findOrFail($this->contract_id);
    }
}
