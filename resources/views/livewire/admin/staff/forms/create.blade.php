<div>
    <!--begin::Form-->
    <form wire:submit.prevent="save" class="form">
        @csrf
        <!--begin::Scroll-->
        <div class="scroll-y me-n7 pe-7" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
             data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header"
             data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold mb-2">الاسم</label>
                <!--end::Label-->

                <!--begin::Input-->
                <input type="text" wire:model.defer="name" class="form-control form-control-solid" required/>
                <!--end::Input-->
                @error('name')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold mb-2">البريد الإلكتروني</label>
                <!--end::Label-->

                <!--begin::Input-->
                <input type="email" wire:model.defer="username" class="form-control form-control-solid" required/>
                <!--end::Input-->
                @error('username')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <!--end::Input group-->

            <!--begin::Input wrapper-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="required fs-6 fw-semibold mb-2">كلمة المرور</label>
                <!--end::Label-->

                <!--begin::Title-->
                <div class="d-flex">
                    <input wire:model.defer="password" type="text" class="form-control form-control-solid me-3 flex-grow-1"/>

                    <button wire:click="updatePassword" type="button" class="btn btn-light fw-bold flex-shrink-0">
                        تحديث
                    </button>
                </div>
                <!--end::Title-->
                @error('password')
                <div class="text-danger">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <!--end::Input wrapper-->


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
                <span wire:loading.remove>حفظ</span>
                <span wire:loading>الرجاء الإنتظار</span>
                <!--begin::Indicator progress-->
                <span wire:loading>
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
