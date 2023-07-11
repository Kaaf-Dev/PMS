<?php

function getMaintenanceGlobalModals()
{
    return [
        [
            'modal_id' => 'maintenance_ticket_finish',
            'livewire_component' => 'maintenance.ticket.details.finish-ticket',
            'emit_show' => 'show-maintenance-ticket-finish-modal',
            'emit_hide' => 'hide-maintenance-ticket-finish-modal',
            'details' => [
                'title' => 'طلب اعتماد الصيانة',
                'modal_dialog_class' => 'mw-650px',
            ]
        ],
    ];
}
