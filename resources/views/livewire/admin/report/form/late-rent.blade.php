<div>
    <form wire:submit.prevent="export" class="form fv-plugins-bootstrap5 fv-plugins-framework">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span>الفئة</span>
            </label>
            <!--end::Label-->

            <select wire:model.defer="selected_category" class="form-select">
                <option value="">الكل</option>
                @foreach($categories ?? [] as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span>الحالة</span>
            </label>
            <!--end::Label-->

            <select wire:model.defer="lawyer_cases" class="form-select">
                <option value="">الكل</option>
               <option value="1">غير محول الى المحامي</option>
               <option value="2">محول الى المحامي</option>
            </select>

        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span>عدد أشهر المتأخرات</span>
            </label>
            <!--end::Label-->

            <input wire:model.defer="month_count" class="form-control" type="number">

        </div>
        <!--end::Input group-->


        <!--begin::Actions-->
        <div class="text-center">
            <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                <i class="bi bi-arrow-down"></i> عودة
            </button>

            <!-- Excel Download Button -->
            <button type="button" id="kt_modal_export_excel" class="btn btn-success" wire:click="exportExcel">
                <!--begin::Indicator label-->
                <span wire:loading.remove wire:target="exportExcel">
                    <i class="bi bi-file-earmark-spreadsheet"></i> تصدير إلى Excel
                </span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="exportExcel">
                    <i class="bi bi-hourglass-split"></i> الرجاء الانتظار
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>

            <!-- PDF Download Button -->
            <button type="button" id="kt_modal_export_pdf" class="btn btn-warning" wire:click="exportPDF">
                <!--begin::Indicator label-->
                <span wire:loading.remove wire:target="exportPDF">
                    <i class="bi bi-file-earmark-pdf"></i> تصدير إلى PDF
                </span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="exportPDF">
                    <i class="bi bi-hourglass-split"></i> الرجاء الانتظار
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Actions-->
    </form></div>
