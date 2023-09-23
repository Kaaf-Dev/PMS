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

                        @if($this->ticket->hasVisitAvailabilityTime())
                            <!--begin::Details-->
                            <div class="mt-8">

                                <!--begin::Alert-->
                                <div class="alert alert-primary d-flex align-items-center p-5">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-calendar-2 fs-2hx text-primary me-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                    <!--end::Icon-->

                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Title-->
                                        <h4 class="mb-1 text-dark">ملاحظات</h4>
                                        <!--end::Title-->

                                        <!--begin::Content-->
                                        <span>
                                            الوقت المتاح للزيارة
                                            <b>
                                                {{ $this->ticket->visit_availability_at_string }}
                                            </b>
                                            .
                                        </span>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Alert-->

                            </div>
                            <!--end::Details-->
                        @endif

                        <!--begin::Details-->
                        <div class="mb-0">
                            <!--begin::Description-->
                            <div class="fs-5 fw-normal text-gray-800">
                                @foreach($this->ticket->ticketAttachments ?? [] as $attachment)
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-sm-center mb-7">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-60px me-4">
                                            <span class="symbol-label bg-light-primary">
                                                <i class="ki-solid ki-file fs-2x text-primary"></i>
                                            </span>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Content-->
                                        <div class="d-flex flex-row-fluid align-items-center flex-wrap my-lg-0 me-2">
                                            <!--begin::Title-->
                                            <div class="flex-grow-1 my-lg-0 my-2 me-2">
                                                <a href="{{ $attachment->url }}" target="_blank" class="text-gray-800 fw-bold text-hover-primary fs-6">مرفق</a>
                                                <span class="text-muted fw-semibold d-block pt-1">{{ $attachment->file_name }}</span>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Section-->
                                            <div class="d-flex align-items-center">
                                                <a href="{{ $attachment->url }}" target="_blank" class="btn btn-icon btn-light btn-sm border-0">
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

                        @if($this->ticket->visit_at)
                            <!--begin::Details-->
                            <div class="mb-0">

                                <div class="alert bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row p-5 mb-10">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <!--end::Icon-->

                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <!--begin::Title-->
                                        <h5 class="mb-1">تحديد موعد الزيارة</h5>
                                        <!--end::Title-->

                                        <!--begin::Content-->
                                        <span class="">
                                            تم تحديد موعد الزيارة بتاريخ:
                                            <br>
                                            <strong>
                                                {{ $this->ticket->visit_in_date_human }} ({{ $this->ticket->visit_in_human }})
                                            </strong>
                                        </span>
                                    </div>
                                    <!--end::Wrapper-->

                                </div>
                            </div>
                            <!--end::Details-->
                        @endif

                        @if($this->ticket->visited_at)
                            <!--begin::Details-->
                            <div class="mb-0">

                                <div class="alert bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row p-5 mb-10">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <!--end::Icon-->

                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <!--begin::Title-->
                                        <h5 class="mb-1">تمت الزيارة</h5>
                                        <!--end::Title-->

                                        <!--begin::Content-->
                                        <span class="">
                                            تمت الزيارة بتاريخ:
                                            <br>
                                            <strong>
                                                {{ $this->ticket->visited_at_date_human }} ({{ $this->ticket->visited_at_human }})
                                            </strong>
                                        </span>
                                    </div>
                                    <!--end::Wrapper-->

                                </div>
                            </div>
                            <!--end::Details-->
                        @endif

                        @if($this->ticket->is_show_verification_code_to_user)
                            <!--begin::Details-->
                            <div class="mb-0">

                                <div class="alert bg-light-primary border border-primary border-dashed d-flex flex-column flex-sm-row p-5 mb-10">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <!--end::Icon-->

                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                        <!--begin::Title-->
                                        <h5 class="mb-1">اعتماد أعمال الصيانة</h5>
                                        <!--end::Title-->

                                        <!--begin::Content-->
                                        <span class="mb-8">
                                        تم إرسال طلب اعتماد أعمال الصيانة من قِبل مندوب شركة الصيانة
                                        في حال انتهاء المندوب من الأعمال المطلوبة يرجى تزويده برمز التأكيد لإنهاء هذا الطلب
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
                            </div>
                            <!--end::Details-->
                        @endif
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
