<div>
    <!--begin::Form-->
    <form wire:submit.prevent="submit" class="form">


        <!--begin::Scroll-->
        <div class="scroll-y me-n7 pe-7" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold mb-2">الفئة</label>
                <!--end::Label-->

                <!--begin::Input-->
                <input wire:model.defer="title" class="form-control form-control-solid"/>
                <!--end::Input-->
                @error('title')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <!--end::Input group-->

        </div>
        <!--end::Scroll-->

        <!--begin::Modal footer-->
        <div class="modal-footer flex-center">
            <!--begin::Button-->
            <button wire:click="discard" type="button" class="btn btn-light me-3">

                <span wire:loading.remove wire:target="discard">تجاهل</span>
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="discard">
                    <span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
                <!--end::Indicator progress-->

            </button>
            <!--end::Button-->

            <!--begin::Button-->
            <button type="submit" class="btn btn-primary">
                <span wire:loading.remove wire:target="submit">إضافة</span>
                <!--begin::Indicator progress-->
                <span wire:loading wire:target="submit">
                    <span class="spinner-border spinner-border-sm align-middle"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
            <!--end::Button-->
        </div>
        <!--end::Modal footer-->
    </form>
    <!--end::Form-->

</div>
