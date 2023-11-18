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
                عودة
            </button>

            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span wire:loading.remove wire:target="export">تصدير التقرير</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="export">
                    الرجاء الانتظار
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Actions-->
    </form></div>
