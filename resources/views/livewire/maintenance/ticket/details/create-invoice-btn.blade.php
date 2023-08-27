<div>
    @if ($this->ticket->maintenance_invoices_count == 0)
        <div class="card card-flush mb-4">
            <a wire:click="createInvoice" class="btn btn-success">
                <i class="ki-solid ki-dollar fs-1">
                </i>
                إضافة فاتورة صيانة
            </a>
        </div>
    @else
    @endif
</div>
