<div>

    <form wire:submit.prevent="save" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                <span class="required">قيمة الإيجار</span>
            </label>
            <!--end::Label-->

            <!--begin::Input-->
            <div class="input-group mb-5">
                <input wire:model.defer="contract.cost" type="text" class="form-control">
                <span class="input-group-text" id="basic-addon2">د.ب. / شهري</span>
            </div>
            <!--end::Input-->
            @error('contract.cost')
            <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
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
