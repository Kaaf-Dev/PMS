<div wire:init="load">

    <div class="card card-flush border-0 h-lg-100" data-bs-theme="light" style="background: linear-gradient(112.14deg, #481F66 0%, #63317D 100%)">
        <!--begin::Header-->
        <div class="card-header pt-2">
            <!--begin::Title-->
            <h3 class="card-title">
                <span class="text-white fs-3 fw-bold me-2">إجمالي عدد الوحدات</span>
            </h3>
            <!--end::Title-->

            <div class="card-toolbar">
                <a href="{{ route('admin.property') }}" class="btn bg-white bg-opacity-10 btn-color-white btn-active-secondary">
                    <i class="ki-outline ki-gear"></i>
                    إدارة العقارات
                </a>
            </div>
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body d-flex justify-content-between flex-column pt-1 px-0 pb-0">
            <!--begin::Wrapper-->
            <div class="d-flex flex-wrap px-9 mb-5">
                <!--begin::Stat-->
                <div class="rounded min-w-125px py-3 px-4 my-1 me-6" style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <div class="text-white fs-2 fw-bold counted">
                            <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                            <span wire:loading.remove wire:target="load">{{ $this->stores_count }}</span>
                        </div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 text-white opacity-50">المحلات التجارية</div>
                    <!--end::Label-->
                </div>
                <!--end::Stat-->

                <!--begin::Stat-->
                <div class="rounded min-w-125px py-3 px-4 my-1" style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                    <!--begin::Number-->
                    <div class="d-flex align-items-center">
                        <div class="text-white fs-2 fw-bold counted">
                            <span wire:loading wire:target="load"><span class="text-white spinner-border spinner-border-sm fs-4 d-block"></span></span>
                            <span wire:loading.remove wire:target="load">{{ $this->apartments_count }}</span>
                        </div>
                    </div>
                    <!--end::Number-->

                    <!--begin::Label-->
                    <div class="fw-semibold fs-6 text-white opacity-50">الشقق السكنية</div>
                    <!--end::Label-->
                </div>
                <!--end::Stat-->
            </div>

            <!--end::Wrapper-->
        </div>
        <!--end::Body-->
    </div>
</div>
