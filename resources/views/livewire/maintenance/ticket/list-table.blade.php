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
                        <th wire:click="orderBy('contract_id')" class="min-w-250px">
                            الطلب
                            @if($order_by == 'contract_id')
                                @if($order_as == 'desc')
                                    <i class="ki-outline ki-arrow-down"></i>
                                @else
                                    <i class="ki-outline ki-arrow-up"></i>
                                @endif
                            @endif
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
                        <th wire:click="orderBy('priority')" class="min-w-90px">
                            الأولوية
                            @if($order_by == 'status')
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
                                        <a href="{{ route('maintenance.tickets.details', ['ticket_id' => $ticket->id]) }}" class="mb-1 text-gray-800 text-hover-primary">{{ $ticket->contract->user->name }}</a>
                                        <div class="fw-semibold fs-6 text-gray-400">{{ optional($ticket->ticketCategory)->title }}</div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </td>
                            <td>
                                {{ $ticket->updated_at_human }}
                                <div class="fw-semibold fs-6 text-gray-400">{{ $ticket->updated_at_date_human }}</div>
                            </td>
                            <td>
                                {{ $ticket->visit_in_human }}
                                <div class="fw-semibold fs-6 text-gray-400">{{ $ticket->visit_in_date_human }}</div>
                            </td>
                            <td>
                                <span class="badge badge-light-{{ $ticket->priority_class }} fw-bold px-4 py-3">{{ $ticket->priority_string }}</span>
                            </td>
                            <td>
                                <span class="badge badge-light-{{ $ticket->status_class }} fw-bold px-4 py-3">{{ $ticket->status_string }}</span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('maintenance.tickets.details', ['ticket_id' => $ticket->id]) }}" class="btn btn-light btn-sm">عرض</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">

                                <div class="d-flex flex-column flex-center">
                                    <img src="{{ asset('user-assets/media/illustrations/sigma-1/5.png') }}"
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
