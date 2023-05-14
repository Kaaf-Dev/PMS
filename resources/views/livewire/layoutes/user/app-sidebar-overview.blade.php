<div wire:init="fetch">
    <!--begin::Stats-->
    <div class="d-flex mb-8 mb-lg-10">

        <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6">
            <!--begin::Date-->
            <span class="fs-6 text-gray-500 fw-bold">العقود</span>
            <!--end::Date-->
            <!--begin::Label-->
            <div class="fs-2 fw-bold">{{ $contracts_no }}</div>
            <!--end::Label-->
        </div>

        <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4">
            <!--begin::Date-->
            <span class="fs-6 text-gray-500 fw-bold">الفواتير</span>
            <!--end::Date-->
            <!--begin::Label-->
            <div class="fs-2 fw-bold text-danger">{{ $invoices_total }}</div>
            <!--end::Label-->
        </div>

    </div>
    <!--end::Stats-->
</div>
