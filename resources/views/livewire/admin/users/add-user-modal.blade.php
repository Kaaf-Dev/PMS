<div>
    <!--begin::Modal body-->
    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
        <!--begin::Form-->
        <!--begin::Scroll-->
        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_user_scroll"
             data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
             data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_user_header"
             data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px">
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="d-block fw-semibold fs-6 mb-5">الصورة الشخصية</label>
                <!--end::Label-->
                <!--begin::Image input-->
                <div class="image-input image-input-outline image-input-placeholder"
                     data-kt-image-input="true">
                    <!--begin::Preview existing avatar-->
                    <div wire:ignore class="image-input-wrapper w-125px h-125px"
                         style="background-image: url('{{\Illuminate\Support\Facades\URL::asset('admin-assets/media/svg/files/blank-image.svg')}}');"></div>
                    <!--end::Preview existing avatar-->
                    <!--begin::Label-->
                    <label
                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                        <i class="bi bi-pencil-fill fs-7"></i>
                        <!--begin::Inputs-->
                        <input type="file" wire:model="user_image" name="avatar" accept=".png, .jpg, .jpeg"/>
                        <input type="hidden" name="avatar_remove"/>
                        <!--end::Inputs-->
                    </label>
                    <!--end::Label-->
                    <!--begin::Cancel-->
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                    <!--end::Cancel-->
                    <!--begin::Remove-->
                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                    <!--end::Remove-->
                </div>
                <!--end::Image input-->
                <!--begin::Hint-->
                <div class="form-text">الامتدادات المسموح بها: png, jpg, jpeg.</div>
                @error('user_image')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
                <!--end::Hint-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-7">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6 mb-5">نوع المستأجر</label>
                <!--end::Label-->
                <!--begin::Roles-->
                <!--begin::Input row-->
                <div class="d-flex fv-row">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" wire:model="user_type" type="radio" value="1"
                               checked='checked'/>
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_role_option_0">
                            <div class="fw-bold text-gray-800">أفراد</div>
                            <div class="text-gray-600">تسجيل الأفراد.</div>

                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Radio-->

                </div>
                <!--end::Input row-->
                <div class='separator separator-dashed my-5'></div>
                <!--begin::Input row-->
                <div class="d-flex fv-row">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" wire:model="user_type" type="radio" value="2"/>
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_role_option_1">
                            <div class="fw-bold text-gray-800">شركات</div>
                            <div class="text-gray-600">تسجيل شركة تجارية ذات طابع تجاري.</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Radio-->
                </div>
                <!--end::Input row-->
                <div class='separator separator-dashed my-5'></div>

                @error('user_type')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
                <!--end::Roles-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6 mb-2">الأسم الكامل</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" wire:model="user_name"
                       class="form-control form-control-solid mb-3 mb-lg-0" placeholder="الأسم الكامل"/>
                <!--end::Input-->
                @error('user_name')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6 mb-2">البريد الإلكتروني</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="email" wire:model="user_email"
                       class="form-control form-control-solid mb-3 mb-lg-0"
                       placeholder="البريد الإلكتروني"/>
                <!--end::Input-->
                @error('user_email')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6 mb-2">الرقم الشخصي</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="email" wire:model="user_cpr"
                       class="form-control form-control-solid mb-3 mb-lg-0" placeholder="الرقم الشخصي"/>
                <!--end::Input-->
                @error('user_cpr')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror
            </div>
            <!--end::Input group-->

        </div>
        <!--end::Scroll-->
        <!--begin::Actions-->
        <div class="text-center pt-15">
            <button type="reset" wire:click="closeModal" class="btn btn-light me-3" data-kt-users-modal-action="cancel">عودة
            </button>
            <button wire:click="save" type="submit" class="btn btn-primary">
                <span class="indicator-label">حفظ</span>
                <span class="indicator-progress">الرجاء الإنتظار...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
        <!--end::Actions-->

        <!--end::Form-->
    </div>
    <!--end::Modal body-->
</div>
