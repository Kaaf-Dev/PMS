<div>
    <form wire:submit.prevent="save" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">

            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-6">
                    <label class="fs-6 fw-semibold mb-2">رسوم المحكمة</label>
                    <input wire:model.defer="court_fees" type="number" step="0.01"" class="form-control form-control">
                    @error('court_fees')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-6">
                    <label class="fs-6 fw-semibold mb-2">رسوم المنفذ الخاص</label>
                    <input wire:model.defer="executor_fees" type="number" step="0.01"" class="form-control form-control">
                    @error('executor_fees')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-6">
                    <label class="fs-6 fw-semibold mb-2">أتعاب المحامي</label>
                    <input wire:model.defer="attorneys_fees" type="number" step="0.01"" class="form-control form-control">
                    @error('attorneys_fees')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-6">
                    <label class="fs-6 fw-semibold mb-2">أخرى</label>
                    <input wire:model.defer="other" type="number" step="0.01" class="form-control form-control">
                    @error('other')
                    <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
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
