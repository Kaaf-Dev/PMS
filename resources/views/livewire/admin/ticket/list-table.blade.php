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
                        <th wire:click="orderBy('contract_id')" class="min-w-auto">
                            طلب الصيانة
                            @if($order_by == 'contract_id')
                                @if($order_as == 'desc')
                                    <i class="ki-outline ki-arrow-down"></i>
                                @else
                                    <i class="ki-outline ki-arrow-up"></i>
                                @endif
                            @endif
                        </th>
                        <th class="min-w-250px">
                            الموضوع
                        </th>

                        <th class="min-w-150px">
                            العقار
                        </th>

                        <th class="min-w-150px">
                            رقم الهاتف
                        </th>

                        <th wire:click="orderBy('maintenance_company_id')" class="min-w-auto">
                            شركة الصيانة
                            @if($order_by == 'maintenance_company_id')
                                @if($order_as == 'desc')
                                    <i class="ki-outline ki-arrow-down"></i>
                                @else
                                    <i class="ki-outline ki-arrow-up"></i>
                                @endif
                            @endif
                        </th>
                        <th class="min-w-150px">
                            الفئة
                        </th>
                        <th wire:click="orderBy('updated_at')" class="min-w-150px">
                            آخر إجراء
                            @if($order_by == 'updated_at')
                                @if($order_as == 'desc')
                                    <i class="ki-outline ki-arrow-down"></i>
                                @else
                                    <i class="ki-outline ki-arrow-up"></i>
                                @endif
                            @endif
                        </th>
                        <th wire:click="orderBy('visit_at')" class="min-w-150px">
                            موعد الزيارة
                            @if($order_by == 'visit_at')
                                @if($order_as == 'desc')
                                    <i class="ki-outline ki-arrow-down"></i>
                                @else
                                    <i class="ki-outline ki-arrow-up"></i>
                                @endif
                            @endif
                        </th>
                        <th wire:click="orderBy('status')" class="min-w-90px">
                            الحالة
                            @if($order_by == 'status')
                                @if($order_as == 'desc')
                                    <i class="ki-outline ki-arrow-down"></i>
                                @else
                                    <i class="ki-outline ki-arrow-up"></i>
                                @endif
                            @endif
                        </th>
                        <th class="min-w-50px text-end">
                            عرض
                        </th>
                    </tr>
                    </thead>
                    <tbody class="fs-6">
                    @forelse($tickets ?? [] as $ticket)
                        <tr>
                            <td>
                                <!--begin::User-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Wrapper-->
                                    <div class="me-5 position-relative">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-35px symbol-circle">
                                            <i class="ki-outline ki-{{ $ticket->status_icon }} fs-2x me-5 mt-2 text-{{ $ticket->status_class }}"></i>
                                        </div>
                                        <!--end::Avatar-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="{{ route('admin.tickets.details', ['ticket_id' => $ticket->id]) }}" class="mb-1 text-gray-800 text-hover-primary">
                                            {{ $ticket->no }}
                                        </a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </td>

                            <td>
                                <!--begin::Subject-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="{{ route('admin.tickets.details', ['ticket_id' => $ticket->id]) }}" class="mb-1 text-gray-800 text-hover-primary">
                                            {{ $ticket->subject }}</a>
                                            <a class="fw-semibold fs-6 text-gray-400" href="{{ route('admin.users.details', ['user_id' => $ticket->contract->user->id]) }}">
                                                {{ $ticket->contract->user->name }}
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
                                        <a href="{{ route('admin.tickets.details', ['ticket_id' => $ticket->id]) }}" class="mb-1 text-gray-800 text-hover-primary">
                                            {{ optional($ticket->property)->name }}</a>
                                            <a class="fw-semibold fs-6 text-gray-400" href="{{ route('admin.users.details', ['user_id' => $ticket->contract->user->id]) }}">
                                                {{ optional($ticket->apartment)->name }}
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
                                        <a href="tel:{{$ticket->contract->user->phone_human}}" class="mb-1 text-gray-800 text-hover-primary">
                                            {{ $ticket->contract->user->phone_human }}</a>
                                    </div>
                                    <!--end::Subject-->
                                </div>
                                <!--end::User-->
                            </td>

                            <td>
                                <!--begin::Maintenance Company-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="{{ route('admin.tickets.details', ['ticket_id' => $ticket->id]) }}" class="mb-1 text-gray-800 text-hover-primary">
                                            {{ ($ticket->maintenanceCompany) ? $ticket->maintenanceCompany->name : '-'  }}
                                        </a>
                                    </div>
                                    <!--end::Maintenance Company-->
                                </div>
                                <!--end::User-->
                            </td>
                            <td>
                                {{ optional($ticket->ticketCategory)->title }}
                            </td>
                            <td>
                                {{ $ticket->updated_at_date_human }}
                            </td>
                            <td>
                                {{ $ticket->visit_in_date_human }}
                            </td>
                            <td>
                                <span class="badge badge-light-{{ $ticket->status_class }} fw-bold px-4 py-3">{{ $ticket->status_string }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.tickets.details', ['ticket_id' => $ticket->id]) }}" class="btn btn-light btn-sm">عرض</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">

                                <div class="d-flex flex-column flex-center">
                                    <img src="{{ asset('admin-assets/media/illustrations/sigma-1/5.png') }}"
                                         class="mw-350px">
                                    <div class="fs-3 fw-bolder text-dark mb-4">لا يوجد طلبات صيانة</div>
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

            @if($tickets)
                {{ $tickets->links() }}
            @endif

        </div>
        <!--end::Card body-->
    </div>
</div>
