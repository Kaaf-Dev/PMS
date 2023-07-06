<div>
    <!--begin::Card-->
    <div class="card mb-15">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row p-7">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0">
                    <!--begin::Ticket view-->
                    <div class="mb-0">
                        <!--begin::Heading-->
                        <div class="d-flex align-items-center mb-12">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-{{ $this->ticket->status_icon }} fs-4qx text-{{ $this->ticket->status_class }} ms-n2 me-3"></i>
                            <!--end::Icon-->
                            <!--begin::Content-->
                            <div class="d-flex flex-column">
                                <!--begin::Title-->
                                <h1 class="text-gray-800 fw-semibold">{{ $this->ticket->subject }}</h1>
                                <!--end::Title-->
                                <!--begin::Info-->
                                <div class="">
                                    <!--begin::Label-->
                                    <span class="fw-semibold text-muted me-6">
                                        <span class="badge badge-{{ $this->ticket->status_class }}">{{ $this->ticket->status_string }}</span>
                                    </span>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <span class="fw-semibold text-muted me-6">
                                        العقد:
                                        <a href="#" class="text-muted text-hover-primary">#{{ $this->ticket->contract->id }}</a>
                                    </span>
                                    <!--end::Label-->
                                    <!--begin::Label-->
                                    <span class="fw-semibold text-muted">
                                        آخر تحديث:
                                        <span class="fw-bold text-gray-600 me-1">{{ $this->ticket->updated_at_human }}</span>({{ $this->ticket->updated_at->format('Y.m.d H:i a') }})
                                    </span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Details-->
                        <div class="mb-0">
                            <!--begin::Description-->
                            <div class="fs-5 fw-normal text-gray-800">
                                <!--begin::Text-->
                                <div class="mb-5 fs-5">
                                    {{ $this->ticket->description }}
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Details-->
                    </div>
                    <!--end::Ticket view-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
