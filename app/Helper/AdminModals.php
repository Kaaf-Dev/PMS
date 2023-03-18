<?php

function getAdminGlobalModals()
{

    // [element_id] must be unique
    // [livewire_component] must be existed

    return [
        [
            'modal_id' => 'property_add_modal',
            'livewire_component' => 'admin.property.create-form',
            'emit_show' => 'show-property-add-modal',
            'emit_hide' => 'hide-property-add-modal',
            'details' => [
                'title' => '',
                'modal_dialog_class' => 'mw-650px',
            ]
        ],

        [
            'modal_id' => 'contract_new_modal',
            'livewire_component' => 'admin.contract.create-form',
            'emit_show' => 'show-contract-new-modal',
            'emit_hide' => 'hide-contract-new-modal',
            'details' => [
                'title' => 'تسجيل عقد تأجير',
                'modal_dialog_class' => 'modal-dialog-centered mw-900px',
            ]
        ],

        [
            'modal_id' => 'contract_update_notes_modal',
            'livewire_component' => 'admin.contract.forms.notes',
            'emit_show' => 'show-contract-update-notes-modal',
            'emit_hide' => 'hide-contract-update-notes-modal',
            'details' => [
                'title' => 'الملاحظات',
                'modal_dialog_class' => 'mw-650px',
            ]
        ],

        [
            'modal_id' => 'contract_update_rental_cost_modal',
            'livewire_component' => 'admin.contract.forms.rental-cost',
            'emit_show' => 'show-contract-update-rental-cost-modal',
            'emit_hide' => 'hide-contract-update-rental-cost-modal',
            'details' => [
                'title' => 'قيمة الإيجار',
                'modal_dialog_class' => 'mw-650px',
            ]
        ],

        [
            'modal_id' => 'contract_manage_user_modal',
            'livewire_component' => 'admin.contract.forms.manage-user',
            'emit_show' => 'show-contract-manage-user-modal',
            'emit_hide' => 'hide-contract-manage-user-modal',
            'details' => [
                'title' => 'إدارة المستأجر',
                'modal_dialog_class' => 'mw-650px',
            ]
        ],

        [
            'modal_id' => 'contract_manage_apartment_modal',
            'livewire_component' => 'admin.contract.forms.manage-apartment',
            'emit_show' => 'show-contract-manage-apartment-modal',
            'emit_hide' => 'hide-contract-manage-apartment-modal',
            'details' => [
                'title' => 'إدارة العقار',
                'modal_dialog_class' => 'mw-650px',
            ]
        ]
    ];
}
