<?php

function getLawyerGlobalModals()
{
    return [
        [
            'modal_id' => 'lawyer_invoice_create_form',
            'livewire_component' => 'lawyer.invoice.form.create-form',
            'emit_show' => 'show-lawyer-invoice-create-form-modal',
            'emit_hide' => 'hide-lawyer-invoice-create-form-modal',
            'details' => [
                'title' => 'فاتورة جديدة',
                'modal_dialog_class' => 'mw-650px',
            ]
        ],
    ];
}
