<div>
    <div class="card card-flush">
        <!--begin::Card body-->
        <div class="card-body pt-0">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                    <thead class="fs-7 text-gray-400 text-uppercase">
                    <tr>
                        <th class="min-w-auto">
                            الفاتورة
                        </th>
                        <th class="min-w-auto">
                            تكلفة الصيانة
                        </th>
                        <th class="min-w-auto">
                            القيمة المعتمدة
                        </th>
                        <th class="min-w-125px">
                            شركة الصيانة
                        </th>
                        <th class="min-w-125px">
                            تذكرة الصيانة
                        </th>

                        <th class="min-w-150px">
                            العقار
                        </th>

                        <th class="min-w-150px">
                            التاريخ
                        </th>

                        <th class="min-w-150px">
                            أخر إجراء
                        </th>

                        <th class="min-w-90px">
                            الحالة
                        </th>
                        <th class="min-w-50px text-end">
                            إدارة
                        </th>
                    </tr>
                    </thead>
                    <tbody class="fs-6">
                    @forelse($maintenance_invoices ?? [] as $maintenance_invoice)
                        <tr>
                            <td>
                                <!--begin::User-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Wrapper-->
                                    <div class="me-5 position-relative">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            <i class="ki-outline ki-{{ $maintenance_invoice->status_icon }} fs-2x me-5 mt-2 text-{{ $maintenance_invoice->status_class }}"></i>
                                        </div>
                                        <!--end::Avatar-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column justify-content-center">
                                        <a wire:click="showMaintenanceInvoice('{{ $maintenance_invoice->id }}')" class="mb-1 text-gray-800 text-hover-primary">
                                            {{ $maintenance_invoice->no }}
                                        </a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </td>

                            <td>
                                {{ $maintenance_invoice->maintenance_amount_human }}
                            </td>

                            <td>
                                {{ $maintenance_invoice->amount_human }}
                            </td>

                            <td>
                                <!--begin::Maintenance Company-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column justify-content-center">
                                        {{ ($maintenance_invoice->maintenanceCompany) ? $maintenance_invoice->maintenanceCompany->name : '-'  }}
                                    </div>
                                    <!--end::Maintenance Company-->
                                </div>
                                <!--end::User-->
                            </td>

                            <td>
                                <!--begin::Subject-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="{{ route('admin.tickets.details', ['ticket_id' => $maintenance_invoice->ticket_id])}}" class="mb-1 text-gray-800 text-hover-primary">
                                            {{ $maintenance_invoice->ticket->no }}
                                        </a>
                                    </div>
                                    <!--end::Subject-->
                                </div>
                                <!--end::User-->
                            </td>

                            <td>
                                <!--begin::Subject-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="{{ route('admin.property.details', ['property_id' => $maintenance_invoice->ticket->property_id]) }}" class="mb-1 text-gray-800 text-hover-primary">
                                            {{ $maintenance_invoice->ticket->property->name }}
                                        </a>
                                        <a href="{{ route('admin.property.apartment.details', ['property_id' => $maintenance_invoice->ticket->property_id, 'apartment_id' => $maintenance_invoice->ticket->apartment_id]) }}" class="mb-1 text-gray-800 text-hover-primary">
                                            {{ $maintenance_invoice->ticket->apartment->name }}
                                        </a>
                                    </div>
                                    <!--end::Subject-->
                                </div>
                            </td>

                            <td>
                                {{ $maintenance_invoice->created_at_date_human }}
                            </td>

                            <td>
                                {{ $maintenance_invoice->updated_at_date_human }}
                            </td>

                            <td>
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <div class="badge badge-{{ $maintenance_invoice->status_class }}">{{ $maintenance_invoice->status_string }}</div>
                                </label>
                            </td>

                            <td class="text-end">
                                <a wire:click="showMaintenanceInvoice('{{ $maintenance_invoice->id }}')" class="btn btn-light btn-sm">إدارة</a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">

                                <div class="d-flex flex-column flex-center">
                                    <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}"
                                         class="mw-350px">
                                    <div class="fs-3 fw-bolder text-dark mb-4">لا يوجد فواتير</div>
                                    <div class="fs-6"></div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->

            @if($maintenance_invoices)
                {{ $maintenance_invoices->links() }}
            @endif

        </div>
        <!--end::Card body-->
    </div>
</div>
