<div>
    @if($this->contract)
        <form wire:submit.prevent="save" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">

            <div class="mb-13 text-center">
                <!--begin::Title-->
                <h2 class="mb-3">
                    هل أنت متأكد من إيقاف العقد؟
                </h2>
                <!--end::Title-->
            </div>

            <!--begin::Actions-->
            <div class="text-center">
                <button wire:click="closeModal" type="button" class="btn btn-light me-3">
                    عودة
                </button>

                <button type="submit" id="kt_modal_new_target_submit" class="btn btn-danger">
                    <!--begin::Indicator label-->
                    <span wire:loading.remove wire:target="save">تأكيد العملية</span>
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
    @endif
</div>
