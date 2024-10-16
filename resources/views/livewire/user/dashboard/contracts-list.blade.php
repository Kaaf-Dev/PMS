<div wire:init="fetch" class="col-md-4 mb-5">
    <!--begin::Col-->

        <!--begin::Statistics Widget-->
        <a class="card bg-body hoverable card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body">
                <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                <div class="symbol symbol-45px me-5">
                    <span class="symbol-label bg-light-info">
                        <i class="ki-outline ki-wallet fs-2x text-gray-800"></i>
                    </span>
                </div>
                <!--end::Svg Icon-->
                <div class="fw-bolder fs-2x text-dark mb-2 mt-5">{{ $invoices_amount }}</div>
                <i wire:loading wire:target="fetch" class="fa fa-spin fa-spinner fs-2"></i>
                <div class="fw-semibold text-gray-500">قيمة الفواتير المستحقة</div>
            </div>
            <!--end::Body-->
        </a>
        <!--end::Statistics Widget-->

</div>
