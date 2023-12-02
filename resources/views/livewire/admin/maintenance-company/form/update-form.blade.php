<div>

    @if($maintenance_company)
        <!--begin::Form-->
        <form wire:submit.prevent="submit" class="form">


            <!--begin::Scroll-->
            <div class="scroll-y me-n7 pe-7" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-semibold mb-2">اسم الشركة</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input wire:model.defer="maintenance_company.name" class="form-control form-control-solid"/>
                    <!--end::Input-->
                    @error('maintenance_company.name')
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
                    <input wire:model.defer="maintenance_company.email" class="form-control form-control-solid"/>
                    <!--end::Input-->
                    @error('maintenance_company.email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-semibold mb-2">اسم مسؤول التواصل</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input wire:model.defer="maintenance_company.contact_name" class="form-control form-control-solid"/>
                    <!--end::Input-->
                    @error('maintenance_company.contact_name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-semibold mb-2">رقم الهاتف</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input wire:model.defer="maintenance_company.contact_phone" class="form-control form-control-solid"/>
                    <!--end::Input-->
                    @error('maintenance_company.contact_phone')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-semibold mb-2">العنوان</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input wire:model.defer="maintenance_company.contact_address" class="form-control form-control-solid"/>
                    <!--end::Input-->
                    @error('maintenance_company.contact_address')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <!--end::Input group-->

                <div class="separator separator-dashed my-8"></div>

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="fs-6 fw-semibold mb-2">اسم المستخدم (غير قابل للتعديل)</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input readonly class="form-control form-control-solid" value="{{ $maintenance_company->username }}"/>
                    <!--end::Input-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="required fs-6 fw-semibold mb-2">كلمة المرور الجدبدة</label>
                    <!--end::Label-->

                    <!--begin::Input-->
                    <input wire:model.defer="new_password" class="form-control form-control-solid"/>
                    <!--end::Input-->
                    @error('new_password')
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

                    <span wire:loading.remove wire:target="discard">إعادة</span>
                    <!--begin::Indicator progress-->
                    <span wire:loading wire:target="discard">
                <span class="spinner-border spinner-border-sm align-middle"></span>
            </span>
                    <!--end::Indicator progress-->

                </button>
                <!--end::Button-->

                <!--begin::Button-->
                <button type="submit" class="btn btn-primary">
                    <span wire:loading.remove wire:target="submit">حفظ</span>
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
    @endif

</div>
