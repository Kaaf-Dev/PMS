<div>
    <div class="card card-flush mb-4">
        <!--begin::Card body-->
        <div class="card-body">
            <div class="">
                <h2 class="mb-4">الفواتير</h2>
                <!--begin::Details-->
                <div class="mb-0">
                    <!--begin::Description-->
                    <div class="fs-5 fw-normal text-gray-800">
                        @foreach($this->ticket->maintenanceInvoices ?? [] as $invoice)
                            <div class="separator my-4"></div>
                            <!--begin::Item-->
                            <div class="d-flex align-items-sm-center mb-7">
                                <!--begin::Content-->
                                <div class="d-flex flex-row-fluid align-items-center flex-wrap my-lg-0 me-2">
                                    <!--begin::Title-->
                                    <div class="flex-grow-1 my-lg-0 my-2 me-2">
                                        <span wire:click="showInvoice('{{ $invoice->id }}')" target="_blank" class="text-gray-900 fw-bold text-hover-primary fs-6">
                                            {{ $invoice->maintenance_amount_human }}
                                        </span>
                                        <span class="text-{{ $invoice->status_class }} d-block"> ({{ $invoice->status_string }}) </span>
                                        <span class="text-muted fw-semibold d-block pt-1">{{ $invoice->no }}</span>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Section-->
                                    <div class="d-flex align-items-center">
                                        <a wire:click="showInvoice('{{ $invoice->id }}')" target="_blank" class="btn btn-icon btn-light btn-sm border-0">
                                                    <span>
                                                        <i class="ki-outline ki-eye fs-2 text-primary"></i>
                                                    </span>
                                        </a>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Item-->
                        @endforeach

                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Details-->

                <!--end::Card body-->
                @if ($this->ticket->invoicable)
                    <a wire:click="createInvoice" class="btn btn-success w-100">
                        <i class="ki-solid ki-dollar fs-1">
                        </i>
                        إضافة فاتورة صيانة
                    </a>
                @else
                    <div class="alert alert-info border border-info border-dashed my-4">
                        لا يمكن إضافة فواتير!
                    </div>
                @endif

            </div>
        </div>
    </div>


</div>
