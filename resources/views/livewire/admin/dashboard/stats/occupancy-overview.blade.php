<div wire:init="load">
    <div class="card theme-dark-bg-body" style="background-color: #00BF8D">
        <!--begin::Body-->
        <div class="card-body d-flex flex-column">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column mb-7">
                <!--begin::Title-->
                <lable class="text-white fw-bold fs-3">الإشغال</lable>
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
                            <div class="fs-3 text-white fw-bold lh-1">
                                <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                                <span wire:loading.remove wire:target="load">{{ $this->rented_count }} ({{ $this->rented_percent }}%)</span>
                            </div>
                            <div class="fs-7 text-gray-100 fw-bold">عدد المؤجر</div>
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
                            <div class="fs-3 text-white fw-bold lh-1">
                                <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                                <span wire:loading.remove wire:target="load">{{ $this->available_count }} ({{ $this->available_percent }}%)</span>
                            </div>
                            <div class="fs-7 text-gray-100 fw-bold">عدد غير المؤجر</div>
                        </div>
                        <!--end::Title-->
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-6">
                    <div class="d-flex align-items-center mb-9 me-2">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40px me-3">
                            <div class="symbol-label bg-light">
                                <i class="ki-duotone ki-abstract-21 fs-1 text-dark"><span class="path1"></span><span class="path2"></span></i>                        </div>
                        </div>
                        <!--end::Symbol-->

                        <!--begin::Title-->
                        <div>
                            <div class="fs-3 text-white fw-bold lh-1">
                                <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                                <span wire:loading.remove wire:target="load">{{ $this->apartment_rented_count }} ({{ $this->apartment_rented_percent }}%)</span>
                            </div>
                            <div class="fs-7 text-gray-100 fw-bold">عدد الشقق المؤجرة</div>
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
                                <i class="ki-duotone ki-abstract-44 fs-1 text-dark"><span class="path1"></span><span class="path2"></span></i>                        </div>
                        </div>
                        <!--end::Symbol-->

                        <!--begin::Title-->
                        <div>
                            <div class="fs-3 text-white fw-bold lh-1">
                                <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                                <span wire:loading.remove wire:target="load">{{ $this->apartment_available_count }} ({{ $this->apartment_available_percent }}%)</span>
                            </div>
                            <div class="fs-7 text-gray-100 fw-bold">عدد الشقق غير المؤجرة</div>
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
                            <div class="fs-3 text-white fw-bold lh-1">
                                <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                                <span wire:loading.remove wire:target="load">{{ $this->store_rented_count }} ({{ $this->store_rented_percent }}%)</span>
                            </div>
                            <div class="fs-7 text-gray-100 fw-bold">عدد المحلات المؤجرة</div>
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
                            <div class="fs-3 text-white fw-bold lh-1">
                                <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                                <span wire:loading.remove wire:target="load">{{ $this->store_available_count }} ({{ $this->store_available_percent }}%)</span>
                            </div>
                            <div class="fs-7 text-gray-100 fw-bold">عدد المحلات غير المؤجرة</div>
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
