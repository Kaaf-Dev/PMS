<div>

    <form wire:submit.prevent="save" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">

            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <label class="fs-6 fw-semibold">تاريخ البداية</label>
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <input wire:model.defer="duration.start.year" type="number" class="form-control form-control-solid" placeholder="لا يوجد">
                    @error('duration.start.year')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <input wire:model.defer="duration.start.month" type="number" class="form-control form-control-solid" placeholder="لا يوجد">
                    @error('duration.start.month')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <label class="fs-6 fw-semibold">تاريخ انتهاء العقد</label>
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <input wire:model.defer="duration.end.year" type="number" class="form-control form-control-solid" placeholder="لا يوجد">
                    @error('duration.end.year')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 fv-row fv-plugins-icon-container">
                    <input wire:model.defer="duration.end.month" type="number" class="form-control form-control-solid" placeholder="لا يوجد">
                    @error('duration.end.month')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="fv-plugins-message-container invalid-feedback"></div></div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="text-center">
            <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                عودة
            </button>

            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                <!--begin::Indicator label-->
                <span wire:loading.remove wire:target="save">حفظ</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="save">
                    الرجاء الانتظار
					<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Actions-->
    </form>

</div>
