<div wire:init="load">
    <div class="card card-flush" style="background: linear-gradient(112.14deg, #481F66 0%, #63317D 100%)">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row align-items-center">
                <!--begin::Col-->
                <div class="col-sm-7 pe-0 mb-5 mb-sm-0">
                    <!--begin::Wrapper-->
                    <div class="d-flex justify-content-between h-100 flex-column pt-xl-5 pb-xl-2 ps-xl-7">
                        <!--begin::Container-->
                        <div class="mb-7">
                            <!--begin::Title-->
                            <div class="mb-6">
                                <h3 class="fs-2x fw-semibold text-white">إجمالي عدد الوحدات</h3>
                                <span class="fw-semibold text-white opacity-75"></span>
                            </div>
                            <!--end::Title-->

                            <!--begin::Items-->
                            <div class="d-flex align-items-center flex-wrap d-grid gap-2 ">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center me-5 me-xl-13">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-35px symbol-circle me-3">
                                    <span class="symbol-label" style="background: rgba(255, 255, 255, 0.15);">
                                        <i class="ki-duotone ki-cheque fs-3 text-white">
                                             <span class="path1"></span>
                                             <span class="path2"></span>
                                             <span class="path3"></span>
                                             <span class="path4"></span>
                                             <span class="path5"></span>
                                             <span class="path6"></span>
                                             <span class="path7"></span>
                                        </i>
                                    </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <span class="text-white text-opacity-75 fs-6">المحلات التجارية</span>
                                        <span class="fw-bold text-white fs-4 d-block">
                                            <span wire:loading wire:target="load">
                                                <span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span>
                                            </span>
                                            <span wire:loading.remove wire:target="load">
                                                {{ $this->stores_count }}
                                            </span>
                                        </span>

                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-35px symbol-circle me-3">
                                    <span class="symbol-label" style="background: rgba(255, 255, 255, 0.15);">
                                        <i class="ki-duotone ki-abstract-26 fs-3 text-white">
                                             <span class="path1"></span>
                                             <span class="path2"></span>
                                             <span class="path3"></span>
                                             <span class="path4"></span>
                                             <span class="path5"></span>
                                             <span class="path6"></span>
                                             <span class="path7"></span>
                                        </i>
                                    </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Info-->
                                    <div class="m-0">
                                        <span class="text-white text-opacity-75 fs-6">الشقق السكنية</span>
                                        <span class="fw-bold text-white fs-4 d-block">
                                            <span wire:loading wire:target="load">
                                                <span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span>
                                            </span>
                                            <span wire:loading.remove wire:target="load">
                                                {{ $this->apartments_count }}
                                            </span>
                                        </span>

                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Container-->

                        <!--begin::Action-->
                        <div class="m-0">
                            <a href="{{ route('admin.property') }}" class="btn btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold">
                                إدارة العقارات
                            </a>
                        </div>
                        <!--begin::Action-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--begin::Col-->

                <!--begin::Col-->
                <div class="col-sm-5">
                    <!--begin::Illustration-->
                    <img src="{{ asset('admin-assets/media/illustrations/unitedpalms-1/19-dark.png') }}" class="h-175px h-lg-225px" alt="">
                    <!--end::Illustration-->
                </div>
                <!--begin::Col-->
            </div>
            <!--begin::Row-->
        </div>
        <!--end::Body-->
    </div>
</div>
