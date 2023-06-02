<div>
    <!--begin::Modal body-->
    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">

        <div class="stepper stepper-links d-flex flex-column" id="kt_create_account_stepper" data-kt-stepper="true">
            <!--begin::Nav-->
            <div class="stepper-nav py-5">
                <!--begin::Step 1-->
                <div class="stepper-item @if($step == 1) current @endif">
                    <h3 class="stepper-title">
                        فئة المستأجر
                    </h3>
                </div>
                <!--end::Step 1-->

                <!--begin::Step 2-->
                <div class="stepper-item @if($step == 2) current @endif">
                    <h3 class="stepper-title">
                        بيانات الحساب
                    </h3>
                </div>
                <!--end::Step 2-->

                <!--begin::Step 3-->
                <div class="stepper-item @if($step == 3) current @endif">
                    <h3 class="stepper-title">
                        الانتهاء
                    </h3>
                </div>
                <!--end::Step 3-->

            </div>
            <!--end::Nav-->

            <!--begin::Form-->
            <div class="mx-auto mw-600px w-100 py-10 fv-plugins-bootstrap5 fv-plugins-framework">

                @if($step == 1)
                <!--begin::Step 1-->
                <div class="current" data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-10 pb-lg-15">
                            <!--begin::Title-->
                            <h2 class="fw-bold d-flex align-items-center text-dark">
                                تحديد فئة المستأجر
                            </h2>
                            <!--end::Title-->

                            <!--begin::Notice-->
                            <div class="text-muted fw-semibold fs-6">
                                الرجاء تحديد فئة المستأجر من ضمن الخيارات التالية
                            </div>
                            <!--end::Notice-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Input group-->
                        <div class="fv-row fv-plugins-icon-container">
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <!--begin::Option-->
                                    <input wire:model.defer="user_type" type="radio" class="btn-check" name="user_type" value="1" id="user_type_person">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10" for="user_type_person">
                                        <i class="fas fa-id-card fs-3x me-5"></i>
                                        <!--begin::Info-->
                                        <span class="d-block fw-semibold text-start">
                                            <span class="text-dark fw-bold d-block fs-4 mb-2">
                                                أفراد
                                            </span>
                                            <span class="text-muted fw-semibold fs-6">التسجيل ضمن فئة الأفراد الشخصية</span>
                                        </span>
                                        <!--end::Info-->
                                    </label>
                                    <!--end::Option-->
                                    @error('user_type')
                                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-lg-6">
                                    <!--begin::Option-->
                                    <input wire:model.defer="user_type" type="radio" class="btn-check" name="user_type" value="2" id="user_type_corporate">
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary p-7 d-flex align-items-center mb-10" for="user_type_corporate">
                                        <i class="fas fa-briefcase fs-3x me-5"></i>
                                        <!--begin::Info-->
                                        <span class="d-block fw-semibold text-start">
                                            <span class="text-dark fw-bold d-block fs-4 mb-2">
                                                شركة
                                            </span>
                                            <span class="text-muted fw-semibold fs-6">تسجيل شركة تجارية ذات طابع تجاري.</span>
                                        </span>
                                        <!--end::Info-->
                                    </label>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 1-->
                @endif

                @if($step == 2)
                    <!--begin::Step 2-->
                    <div class="current" data-kt-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="d-block fw-semibold fs-6 mb-5">
                                    @if($user_type == 1)
                                        الصورة الشخصية
                                    @else
                                        شعار المؤسسة
                                    @endif
                                </label>
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
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-semibold fs-6 mb-2">
                                    @if($user_type == 1)
                                        الاسم
                                    @else
                                        اسم المؤسسة
                                    @endif
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input wire:model.defer="user_name" type="text" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="الأسم الكامل"/>
                                <!--end::Input-->
                                @error('user_name')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <!--end::Input group-->

                            @if($user_type == 2)
                                <!--end::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">رقم السجل</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input wire:model.defer="corporate_id"
                                           class="form-control form-control-solid mb-3 mb-lg-0"
                                           placeholder="رقم السجل"/>
                                    <!--end::Input-->
                                    @error('corporate_id')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <!--end::Input group-->
                                <div class="separator my-10"></div>

                                <h2 class="fw-semibold d-flex align-items-center text-dark fs-4 mt-4 mb-4">
                                    بيانات التواصل مع المسؤول
                                </h2>

                                <!--end::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">اسم الشخص المسؤول</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input wire:model.defer="contact_name"
                                           class="form-control form-control-solid mb-3 mb-lg-0"/>
                                    <!--end::Input-->
                                    @error('contact_name')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <!--end::Input group-->
                            @endif

                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fw-semibold fs-6 mb-2">البريد الإلكتروني</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="email" wire:model.defer="user_email"
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
                                <input wire:model.defer="user_cpr"
                                       class="form-control form-control-solid mb-3 mb-lg-0" placeholder="الرقم الشخصي"/>
                                <!--end::Input-->
                                @error('user_cpr')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <!--end::Input group-->

                            @if($user_type == 1)
                                <!--end::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">الجنسية</label>
                                    <!--end::Label-->
                                    <!--begin::Input -->
                                    <select wire:model.defer="user_nationality_id" class="form-control form-control-solid form-select form-control-solid">
                                        <option value="">اختيار</option>
                                        @foreach($this->nationalities as $nationality)
                                            <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('user_nationality_id')
                                        <div class="alert alert-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    <!--end::Input -->
                                </div>
                                <!--end::Input group-->
                            @endif

                            @if($user_type == 2)
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">رقم هاتف التواصل</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input wire:model.defer="contact_phone"
                                           class="form-control form-control-solid mb-3 mb-lg-0"/>
                                    <!--end::Input-->
                                    @error('contact_phone')
                                    <div class="alert alert-danger">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                                <!--end::Input group-->
                            @endif

                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 2-->
                @endif

                @if($step == 3)
                <!--begin::Step 3-->
                <div class="current" data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Heading-->
                        <div class="pb-8 pb-lg-10">
                            <!--begin::Title-->
                            <h2 class="fw-bold text-dark">تم تسجيل الحساب بنجاح!</h2>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Body-->
                        <div class="mb-0">
                            <div class="text-center px-4 py-5">
                                <img src="/admin-assets/media/illustrations/unitedpalms-1/7.png" alt="" class="mw-100 mh-300px">
                            </div>
                        </div>
                        <!--end::Body-->

                        <!--begin::Heading-->
                        <div class="pb-8 pb-lg-10 text-center">
                            <button wire:click="newUser" class="btn btn-primary er fs-6 px-8 py-4">
                                <i class="fas fa-user-plus"></i>
                                تسجيل مستأجر جديد
                            </button>

                            <button wire:click="assignContract" class="btn btn-primary er fs-6 px-8 py-4">
                                <i class="fas fa-signature"></i>
                                تسجيل عقد إيجار
                            </button>
                        </div>
                        <!--end::Heading-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 3-->
                @endif

                <div class="text-center pt-15">
                    <button type="reset"
                            @if($step > 1 and $step < $max_step)
                                wire:click="prevStep"
                            @else
                                wire:click="closeModal"
                            @endif
                        class="btn btn-light me-3" data-kt-users-modal-action="cancel">
                        عودة
                    </button>

                    @if($step < $max_step)
                        <button wire:click="next" class="btn btn-primary">
                        <span wire:loading.remove wire:target="next" class="indicator-label">
                            التالي
                        </span>
                        <span wire:loading wire:target="next" class="indicator-progress">
                            الرجاء الانتظار...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                        </button>
                    @endif
                </div>
            </div>
            <!--end::Form-->
        </div>

    </div>
    <!--end::Modal body-->
</div>
