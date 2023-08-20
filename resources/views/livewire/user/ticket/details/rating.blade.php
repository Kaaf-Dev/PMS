<div>

    <div class="alert bg-light-info border border-info border-dashed d-flex flex-column flex-sm-row p-5 mb-10">
        <!--begin::Icon-->
        <i class="ki-duotone ki-like-2 fs-2hx text-info me-4 mb-5 mb-sm-0">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <!--begin::Title-->
            <h4 class="mb-4">كيف ترى جودة خدمات الصيانة؟</h4>
            <!--end::Title-->

            <!--begin::Content-->
            <span class="mb-8">
                يهمنا مدى رضاك عن الخدمة
            </span>

            <span>

                                        @if($show_verification_code)
                    <div class="badge badge-info fs-2x font-monospace">
                                                {{ $this->ticket->verification_code ?? '- ' }}
                                            </div>
                @else
                    <button wire:click="showVerificationCode" type="button" class="btn btn-sm btn-primary">
                                                    <div wire:loading.remove wire:target="showVerificationCode">

                                                        عرض رمز التأكيد

                                                    </div>
                        <!--begin::Indicator progress-->
                                                    <span wire:loading wire:target="showVerificationCode">
                                                        <span class="spinner-border spinner-border-sm align-middle"></span>
                                                    </span>
                        <!--end::Indicator progress-->

                                            </button>
                @endif
                                    </span>
            <!--end::Content-->

        </div>
        <!--end::Wrapper-->

    </div>

    <!--begin::Rating-->
    <div class="rating">
        <div class="rating-label checked">
            <i class="ki-duotone ki-star fs-1"></i>
        </div>
        <div class="rating-label checked">
            <i class="ki-duotone ki-star fs-1"></i>
        </div>
        <div class="rating-label checked">
            <i class="ki-duotone ki-star fs-1"></i>
        </div>
        <div class="rating-label checked">
            <i class="ki-duotone ki-star fs-1"></i>
        </div>
        <div class="rating-label checked">
            <i class="ki-duotone ki-star fs-1"></i>
        </div>
    </div>
    <!--end::Rating-->

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
