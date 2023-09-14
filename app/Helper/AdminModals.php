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
            'modal_id' => 'property_apartment_add_modal',
            'livewire_component' => 'admin.property.apartment.create-form',
            'emit_show' => 'show-apartment-add-modal',
            'emit_hide' => 'hide-apartment-add-modal',
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
                'modal_dialog_class' => 'modal-fullscreen',
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
            'modal_id' => 'contract_update_duration_modal',
            'livewire_component' => 'admin.contract.forms.update-duration',
            'emit_show' => 'show-contract-update-duration-modal',
            'emit_hide' => 'hide-contract-update-duration-modal',
            'details' => [
                'title' => 'تحديد مدة العقد',
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
                'modal_dialog_class' => 'modal-fullscreen',
            ]
        ],

        [
            'modal_id' => 'contract_cancel_modal',
            'livewire_component' => 'admin.contract.forms.cancel-contract',
            'emit_show' => 'show-contract-cancel-modal',
            'emit_hide' => 'hide-contract-cancel-modal',
            'details' => [
                'title' => 'إيقاف العقد',
                'modal_dialog_class' => 'mw-650px',
            ]
        ],

        [
            'modal_id' => 'invoice_create_modal',
            'livewire_component' => 'admin.invoice.forms.create',
            'emit_show' => 'show-invoice-create-modal',
            'emit_hide' => 'hide-invoice-create-modal',
            'details' => [
                'title' => 'تسجيل فاتورة جديدة',
                'modal_dialog_class' => 'mw-900px',
            ]
        ],

        [
            'modal_id' => 'kt_modal_add_user',
            'livewire_component' => 'admin.users.add-user-modal',
            'emit_show' => 'show-user-add-modal',
            'emit_hide' => 'hide-user-add-modal',
            'details' => [
                'title' => 'تسجيل مستأجر جديد',
                'modal_dialog_class' => 'modal-dialog-centered mw-1000px',
            ]
        ],

        [
            'modal_id' => 'kt_modal_create_maintenance_company',
            'livewire_component' => 'admin.maintenance-company.form.create-new',
            'emit_show' => 'show-maintenance-company-create-modal',
            'emit_hide' => 'hide-maintenance-company-create-modal',
            'details' => [
                'title' => 'تسجيل شركة صيانة جديدة',
                'modal_dialog_class' => '',
            ]
        ],

        [
            'modal_id' => 'kt_modal_update_maintenance_company',
            'livewire_component' => 'admin.maintenance-company.form.update-form',
            'emit_show' => 'show-maintenance-company-update-modal',
            'emit_hide' => 'hide-maintenance-company-update-modal',
            'details' => [
                'title' => 'إدارة شركة الصيانة',
                'modal_dialog_class' => '',
            ]
        ],

        [
            'modal_id' => 'kt_modal_add_ticket_category',
            'livewire_component' => 'admin.ticket-category.form.create-new',
            'emit_show' => 'show-ticket-category-create-modal',
            'emit_hide' => 'hide-ticket-category-create-modal',
            'details' => [
                'title' => 'إضافة فئة جديدة',
                'modal_dialog_class' => '',
            ]
        ],

        [
            'modal_id' => 'kt_modal_update_ticket_category',
            'livewire_component' => 'admin.ticket-category.form.update-form',
            'emit_show' => 'show-ticket-category-update-modal',
            'emit_hide' => 'hide-ticket-category-update-modal',
            'details' => [
                'title' => 'تعديل الفئة',
                'modal_dialog_class' => '',
            ]
        ],

        [
            'modal_id' => 'kt_modal_delete_ticket_category',
            'livewire_component' => 'admin.ticket-category.form.delete-verify',
            'emit_show' => 'show-ticket-category-delete-modal',
            'emit_hide' => 'hide-ticket-category-delete-modal',
            'details' => [
                'title' => 'تأكيد عملية الحذف',
                'modal_dialog_class' => '',
            ]
        ],

        [
            'modal_id' => 'kt_modal_contract_assign_lawyer',
            'livewire_component' => 'admin.contract.forms.assign-lawyer',
            'emit_show' => 'show-contract-assign-lawyer-modal',
            'emit_hide' => 'hide-contract-assign-lawyer-modal',
            'details' => [
                'title' => 'تحويل العقد إلى المحامي',
                'modal_dialog_class' => '',
            ]
        ],

        [
            'modal_id' => 'kt_modal_contract_unassign_lawyer',
            'livewire_component' => 'admin.contract.forms.unassign-lawyer',
            'emit_show' => 'show-contract-unassign-lawyer-modal',
            'emit_hide' => 'hide-contract-unassign-lawyer-modal',
            'details' => [
                'title' => 'إلغاء توكيل المحامي',
                'modal_dialog_class' => '',
            ]
        ],

        [
            'modal_id' => 'kt_modal_create_lawyer',
            'livewire_component' => 'admin.lawyer.form.create-new',
            'emit_show' => 'show-lawyer-create-modal',
            'emit_hide' => 'hide-lawyer-create-modal',
            'details' => [
                'title' => 'تسجيل جهة قانونية جديدة',
                'modal_dialog_class' => '',
            ]
        ],

        [
            'modal_id' => 'kt_modal_update_lawyer',
            'livewire_component' => 'admin.lawyer.form.update-form',
            'emit_show' => 'show-lawyer-update-modal',
            'emit_hide' => 'hide-lawyer-update-modal',
            'details' => [
                'title' => 'إدارة الجهة القانونية',
                'modal_dialog_class' => '',
            ]
        ],

        [
            'modal_id' => 'kt_modal_create_ticket',
            'livewire_component' => 'admin.ticket.forms.create-new',
            'emit_show' => 'show-ticket-create-modal',
            'emit_hide' => 'hide-ticket-create-modal',
            'details' => [
                'title' => 'إنشاء تذكرة جديدة',
                'modal_dialog_class' => 'mw-650px',
            ]
        ],

        [
            'modal_id' => 'kt_modal_maintenance_invoice_manage',
            'livewire_component' => 'admin.maintenance-invoice.form.manage',
            'emit_show' => 'show-maintenance-invoice-manage-modal',
            'emit_hide' => 'hide-maintenance-invoice-manage-modal',
            'details' => [
                'title' => 'إدارة فواتير الصيانة',
                'modal_dialog_class' => 'mw-650px',
            ]
        ],

        [
            'modal_id' => 'kt_modal_receipt_create_form',
            'livewire_component' => 'admin.receipt.form.create-form',
            'emit_show' => 'show-admin-receipt-create-modal',
            'emit_hide' => 'hide-admin-receipt-create-modal',
            'details' => [
                'title' => 'دفع فواتير',
                'modal_dialog_class' => 'modal-fullscreen',
            ]
        ],

    ];
}
