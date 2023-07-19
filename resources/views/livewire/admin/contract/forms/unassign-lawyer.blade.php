<div>
    @if($this->contract)

        <!--begin::Input group-->
        <div class="fv-row mb-8">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-5 fw-semibold">
                <span class="">هل أنت متأكد من عملية إلغاء التوكيل؟</span>
            </label>
        </div>
        <!--end::Input group-->
    @endif

    <form wire:submit.prevent="unassign" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">

        <!--begin::Actions-->
        <div class="text-center">
            <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                عودة
            </button>

            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-warning">
                <!--begin::Indicator label-->
                <span wire:loading.remove wire:target="save">تأكيد</span>
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
