<?php

function getAdminGlobalModals()
{

    // [element_id] must be unique
    // [livewire_component] must be existed

    return [
        [
            'modal_id' => 'contract_new',
            'modal_name' => 'تسجيل عقد تأجير',
            'livewire_component' => 'admin.contract.create-form',
        ], [
            'modal_id' => 'contract_update_notes',
            'modal_name' => 'الملاحظات',
            'livewire_component' => 'admin.contract.forms.notes',
        ]
    ];
}
