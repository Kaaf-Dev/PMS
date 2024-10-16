<div>
    <!--begin::Row-->
    <div wire:init="load" class="row g-6 g-xl-9">
        <!--begin::Card-->
        <div class="card">
            <!--begin::Card body-->
            <div class="card-body">

                <!--begin::Layout-->
                <div class="d-flex flex-column flex-xl-row p-7">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0">
                        <!--begin::Tickets-->
                        <div class="mb-0">
                            <!--begin::Search form-->
                            <div class="row">
                                <div class="col-md-4">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative">
                                        <i class="ki-outline ki-magnifier fs-1 text-primary position-absolute top-50 translate-middle ms-9"></i>
                                        <input wire:model.debounce.500ms="search" type="text" class="form-control form-control-lg form-control-solid ps-14" placeholder="البحث في طلبات الصيانة" />
                                    </div>
                                    <!--end::Input wrapper-->
                                </div>
                                <div class="col-md-4">
                                    <select wire:model.debounce.500ms="contract_id" class="form-select form-select-lg form-select-solid">
                                        <option value="">اختيار العقد</option>
                                        @foreach($this->contracts ?? [] as $contract)
                                            <option value="{{ $contract->id }}">(#{{ $contract->id }}): {{ $contract->start_at_human }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <select wire:model.debounce.500ms="status" class="form-select form-select-lg form-select-solid">
                                        <option value="">الحالة</option>
                                        @foreach($this->status_list ?? [] as $key => $status)
                                            <option value="{{ $key }}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <!--end::Search form-->

                            <div wire:loading class="flex-column flex-center my-5">
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                الرجاء الانتظار...
                            </div>

                            <!--begin::Heading-->
                            <h1 class="text-dark mt-15 mb-10">طلبات الصيانة</h1>
                            <!--end::Heading-->
                            <!--begin::Tickets List-->
                            <div class="mb-10">

                                @if ($tickets)
                                    @forelse($tickets ?? [] as $ticket)
                                        <!--begin::Ticket-->
                                        <div class="d-flex mb-10">
                                            <!--begin::Symbol-->
                                            <i class="ki-outline ki-{{ $ticket->status_icon }} fs-2x me-5 ms-n1 mt-2 text-{{ $ticket->status_class }}"></i>
                                            <!--end::Symbol-->
                                            <!--begin::Section-->
                                            <a href="{{ route('user.tickets.details', ['ticket_id' => $ticket->id]) }}" class="text-dark text-hover-primary fs-4 me-3 fw-semibold">

                                                <div class="d-flex flex-column">
                                                    <!--begin::Content-->
                                                    <div class="d-flex align-items-center mb-2">
                                                        <span class="badge badge-primary badge-outline my-1 me-2">الرقم المرجعي: {{ $ticket->no ?? '-' }}</span>
                                                        <span class="badge badge-{{ $ticket->status_class }} my-1">{{ $ticket->status_string }}</span>
                                                    </div>

                                                    <div class="d-flex align-items-center mb-2">
                                                        <!--begin::Title-->
                                                            {{ $ticket->subject }}

                                                        <!--end::Title-->
                                                        <!--begin::Label-->
                                                        <span class="badge badge-light my-1">{{ optional($ticket->ticketCategory)->title }}</span>
                                                        <!--end::Label-->
                                                    </div>

                                                    <!--end::Content-->
                                                    <!--begin::Text-->
                                                    <span class="text-muted fw-semibold fs-6">
                                                        {{ $ticket->truncated_description }}
                                                    </span>
                                                    <!--end::Text-->
                                                </div>
                                                <!--end::Section-->
                                            </a>
                                        </div>
                                        <!--end::Ticket-->
                                    @empty
                                        <div class="">
                                            <div class="">
                                                <img src="{{ asset('user-assets/media/illustrations/sigma-1/5.png') }}"
                                                     class="mw-350px">
                                                <div class="fs-3 fw-bolder text-dark mb-4">لا يوجد طلبات صيانة بعد.</div>
                                                <div class="fs-6"></div>
                                            </div>
                                        </div>
                                    @endforelse
                                @endif
                            </div>
                            <!--end::Tickets List-->
                            <!--begin::Pagination-->
                            @if($tickets)
                                {{ $tickets->links() }}
                            @endif
                            <!--end::Pagination-->
                        </div>
                        <!--end::Tickets-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Layout-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Row-->
</div>
