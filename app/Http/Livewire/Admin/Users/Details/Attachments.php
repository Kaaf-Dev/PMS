<?php

namespace App\Http\Livewire\Admin\Users\Details;

use App\Traits\WithAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Attachments extends Component
{
    use WithFileUploads;
    use WithAlert;

    public $User;
    public $cpr_image_path;
    public $iban_image_path;
    public $merchant_image_path;
    public $passport_path;
    public $corporate_register_path;


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
                'title' => 'البطاقة الشخصية',
                'attribute' => 'cpr_image_path',
            ],
            [
                'title' => 'السجل التجاري',
                'attribute' => 'corporate_register_path',
            ],
        ],
    ];

    public function getListeners()
    {
        return [
            'userUpdated' => '$refresh',
        ];
    }

    public function getMessages()
    {
        return [
            'required' => 'هذا الحقل إجباري',
            'mimes' => 'امتداد الملف غير صالح',
        ];
    }

    public function mount($user)
    {
        $this->fill([
            'User' => $user,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.users.details.attachments');
    }

    public function save($attachment)
    {

        $validated_data = $this->validate([
            $attachment => [
                'required',
                'mimes:pdf,jpg,png,jpeg',
            ],
        ]);

        $this->User->{$attachment} = $this->{$attachment}->store($this->User->id, 'user_image');
        $this->User->save();
        $this->showSuccessAlert('تمت العملية بنجاح');
    }
}
