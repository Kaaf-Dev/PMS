<div wire:init="load">
    <!--begin::Lists Widget 19-->
    <div class="card card-flush h-xl-100">
        <!--begin::Heading-->
        <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-200px" style="background-image:url('{{ asset('admin-assets/media/patterns/pattern-2.jpg') }}" data-bs-theme="light">
            <!--begin::Title-->
            <h3 class="card-title align-items-start flex-column text-white pt-10">
                <span class="fw-bold fs-2x">طلبات الصيانة</span>
            </h3>
            <!--end::Title-->
        </div>
        <!--end::Heading-->
        <!--begin::Body-->
        <div class="card-body mt-n20">
            <!--begin::Stats-->
            <div class="mt-n20 position-relative">
                <!--begin::Row-->
                <div class="row g-3 g-lg-6">
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Items-->
                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5 mb-8">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-check-circle fs-1 text-primary">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Stats-->
                            <div class="m-0">
                                <!--begin::Number-->
                                <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                    <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-5 d-block"></span></span>
                                    <span wire:loading.remove wire:target="load">{{ $this->tickets_finished_count }} <span class="fs-2">({{ $this->tickets_finished_percent }}%)</span></span>
                                </span>
                                <!--end::Number-->
                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-6">طلبات الصيانة المنجزة</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Items-->
                        <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-30px me-5 mb-8">
                                    <span class="symbol-label">
                                        <i class="ki-duotone ki-loading fs-1 text-primary">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Stats-->
                            <div class="m-0">
                                <!--begin::Number-->
                                <span class="text-gray-700 fw-bolder d-block fs-2qx lh-1 ls-n1 mb-1">
                                    <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-5 d-block"></span></span>
                                    <span wire:loading.remove wire:target="load">{{ $this->tickets_open_count }} <span class="fs-2">({{ $this->tickets_open_count }}%)</span></span>
                                </span>
                                <!--end::Number-->
                                <!--begin::Desc-->
                                <span class="text-gray-500 fw-semibold fs-6">طلبات الصيانة غير المنجزة</span>
                                <!--end::Desc-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Stats-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Lists Widget 19-->
</div>
