<div wire:init="fetch">
    <div class="row g-5 g-xl-10 mb-5 mb-xl-0">
        <!--begin::Col-->
        <div class="col-md-4 mb-xl-10">
            <!--begin::Statistics Widget-->
            <a class="card bg-body hoverable card-xl-stretch mb-xl-8 bg-info">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                    <div class="symbol symbol-45px me-5">
                            <span class="symbol-label bg-light-info">
                                <i class="ki-outline ki-add-files fs-2x text-info"></i>
                            </span>
                    </div>
                    <!--end::Svg Icon-->
                    <div class="fw-bolder fs-2x text-white mb-2 mt-5">{{ $tickets_new_count }}</div>
                    <i wire:loading wire:target="fetch" class="fa fa-spin fa-spinner fs-2 text-white"></i>
                    <div class="fw-semibold text-white">طلبات الصيانة المفتوحة</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 mb-xl-10">
            <!--begin::Statistics Widget-->
            <a class="card bg-body hoverable card-xl-stretch mb-xl-8 bg-primary">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                    <div class="symbol symbol-45px me-5">
                            <span class="symbol-label bg-light-info">
                                <i class="ki-outline ki-delivery-time fs-2x text-primary"></i>
                            </span>
                    </div>
                    <!--end::Svg Icon-->
                    <div class="fw-bolder fs-2x text-white mb-2 mt-5">{{ $tickets_under_processing_count }}</div>
                    <i wire:loading wire:target="fetch" class="fa fa-spin fa-spinner fs-2 text-white"></i>
                    <div class="fw-semibold text-white">طلبات الصيانة قيد الإنجاز</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4 mb-xl-10">
            <!--begin::Statistics Widget-->
            <a class="card bg-body hoverable card-xl-stretch mb-xl-8 bg-success">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                    <div class="symbol symbol-45px me-5">
                            <span class="symbol-label bg-light-info">
                                <i class="ki-outline ki-file-added fs-2x text-success"></i>
                            </span>
                    </div>
                    <!--end::Svg Icon-->
                    <div class="fw-bolder fs-2x text-white mb-2 mt-5">{{ $tickets_completed_count }}</div>
                    <i wire:loading wire:target="fetch" class="fa fa-spin fa-spinner fs-2 text-white"></i>
                    <div class="fw-semibold text-white">طلبات الصيانة المكتملة</div>
                </div>
                <!--end::Body-->
            </a>
            <!--end::Statistics Widget-->
        </div>
        <!--end::Col-->
    </div>
</div>
