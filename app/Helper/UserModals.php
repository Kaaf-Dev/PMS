<?php

function getUserGlobalModals()
{
    return [
        [
            'modal_id' => 'user_ticket_create',
            'livewire_component' => 'user.ticket.form.create-form',
            'emit_show' => 'show-user-ticket-create-modal',
            'emit_hide' => 'hide-user-ticket-create-modal',
            'details' => [
                'title' => 'إضافة طلب صيانة جديد',
                'modal_dialog_class' => 'mw-650px',
            ]
        ],

        [
            'modal_id' => 'user_pay_invoice',
            'livewire_component' => 'user.payment.pay-invoice',
            'emit_show' => 'show-user-pay-invoice-modal',
            'emit_hide' => 'hide-user-pay-invoice-modal',
            'details' => [
                'title' => 'دفع الفواتير',
                'modal_dialog_class' => 'mw-650px',
            ]
        ],
    ];
}
