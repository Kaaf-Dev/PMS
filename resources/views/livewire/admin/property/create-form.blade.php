<div>
    <form wire:submit.prevent="save" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
        <!--begin::Heading-->
        <div class="mb-13 text-center">
            <!--begin::Title-->
            <h1 class="mb-3">تسجيل عقار جديد</h1>
            <!--end::Title-->
            <!--begin::Description-->
            <div class="text-muted fw-semibold fs-5">
                من هنا يمكنك تسجيل بيانات العقار الجديد
            </div>
            <!--end::Description-->
        </div>
        <!--end::Heading-->

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">اسم العقار</span>
            </label>
            <!--end::Label-->

            <input wire:model.defer="name" type="text" class="form-control form-control-solid" placeholder="اسم العقار">
            @error('name')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
                <label class="required fs-6 fw-semibold mb-2">مساحة العقار</label>
                <input wire:model.defer="area" type="number" step="0.01" class="form-control form-control-solid" placeholder="المساحة">
                @error('area')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="fv-plugins-message-container invalid-feedback"></div></div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
                <label class="required fs-6 fw-semibold mb-2">عدد الطوابق</label>
                <input wire:model.defer="floors_count" type="number" class="form-control form-control-solid" placeholder="عدد الطوابق">
                @error('floors_count')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="fv-plugins-message-container invalid-feedback"></div></div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
                <label class="fs-6 fw-semibold mb-2">عدد المنازل</label>
                <input wire:model.defer="apartments_house_count" type="number" class="form-control form-control-solid" placeholder="لا يوجد">
                @error('apartments_house_count')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="fv-plugins-message-container invalid-feedback"></div></div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
                <label class="fs-6 fw-semibold mb-2">عدد المحلات</label>
                <input wire:model.defer="apartments_market_count" type="number" class="form-control form-control-solid" placeholder="لا يوجد">
                @error('apartments_market_count')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="fv-plugins-message-container invalid-feedback"></div></div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row g-9 mb-8">
            <!--begin::Col-->
            <div class="col-md-6 fv-row fv-plugins-icon-container">
                <label class="required fs-6 fw-semibold mb-2">سنة التأسيس</label>
                <input wire:model.defer="construction_date" type="number" class="form-control form-control-solid" placeholder="سنة التأسيس">
                @error('construction_date')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="fv-plugins-message-container invalid-feedback"></div></div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="text-center">
            <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                عودة
            </button>

            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span wire:loading.remove>إنشاء</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span wire:loading>
                    الرجاء الانتظار
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Actions-->
    </form>
</div>
