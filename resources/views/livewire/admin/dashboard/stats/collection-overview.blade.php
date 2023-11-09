<div wire:init="load">
    <div>
        <div class="card theme-dark-bg-body" style="background-color: #E82E56">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column mb-7">
                    <!--begin::Title-->
                    <a href="#" class="text-white fw-bold fs-3">التحصيل</a>
                    <!--end::Title-->
                </div>
                <!--end::Wrapper-->

                <!--begin::Row-->
                <div class="row g-0">
                    <!--begin::Col-->
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-9 me-2">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-40px me-3">
                                <div class="symbol-label bg-light">
                                    <i class="ki-duotone ki-abstract-42 fs-1 text-dark"><span class="path1"></span><span class="path2"></span></i>                        </div>
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Title-->
                            <div>
                                <div class="fs-5 text-white fw-bold lh-1">
                                    <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                                    <span wire:loading.remove wire:target="load">{{ $this->invoices_amount }}</span>
                                </div>
                                <div class="fs-7 text-gray-100 fw-bold">مجموع الإيجارات</div>
                            </div>
                            <!--end::Title-->
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-9 ms-2">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-40px me-3">
                                <div class="symbol-label bg-light">
                                    <i class="ki-duotone ki-abstract-45 fs-1 text-dark"><span class="path1"></span><span class="path2"></span></i>                        </div>
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Title-->
                            <div>
                                <div class="fs-5 text-white fw-bold lh-1">
                                    <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                                    <span wire:loading.remove wire:target="load">{{ $this->collected_amount }}</span>
                                </div>
                                <div class="fs-7 text-gray-100 fw-bold">مجموع المحصل</div>
                            </div>
                            <!--end::Title-->
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-6">
                        <div class="d-flex align-items-center me-2">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-40px me-3">
                                <div class="symbol-label bg-light">
                                    <i class="ki-duotone ki-abstract-21 fs-1 text-dark"><span class="path1"></span><span class="path2"></span></i>                        </div>
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Title-->
                            <div>
                                <div class="fs-5 text-white fw-bold lh-1">
                                    <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                                    <span wire:loading.remove wire:target="load">{{ $this->discount_amount }}</span>
                                </div>
                                <div class="fs-7 text-gray-100 fw-bold">مجموع الخصومات</div>
                            </div>
                            <!--end::Title-->
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-6">
                        <div class="d-flex align-items-center ms-2">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-40px me-3">
                                <div class="symbol-label bg-light">
                                    <i class="ki-duotone ki-abstract-44 fs-1 text-dark"><span class="path1"></span><span class="path2"></span></i>                        </div>
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Title-->
                            <div>
                                <div class="fs-5 text-white fw-bold lh-1">
                                    <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                                    <span wire:loading.remove wire:target="load">{{ $this->coming_amount }}</span>
                                </div>
                                <div class="fs-7 text-gray-100 fw-bold">غير محصل للآن</div>
                            </div>
                            <!--end::Title-->
                        </div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
        </div>
    </div>
</div>
