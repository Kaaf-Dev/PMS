<div>
    <!--begin::Card-->
    <div class="card pt-4 mb-6 mb-xl-9">
        <!--begin::Card header-->
        <div class="card-header border-0">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>الملف الشخصي</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <!--begin::Card body-->
        <div class="card-body border-top p-9">
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Col-->
                <!--begin::Input group-->
                <div class="fv-row mb-7">
                    <!--begin::Label-->
                    <label class="d-block fw-semibold fs-6 mb-5">
                        @if($User->is_person == 1)
                            الصورة الشخصية
                        @else
                            شعار المؤسسة
                        @endif
                    </label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <style>.image-input-placeholder {
                            background-image: url('{{ asset('admin-assets/media/svg/files/blank-image.svg') }}');
                        }

                        [data-theme="dark"] .image-input-placeholder {
                            background-image: url('{{ asset('admin-assets/media/svg/files/blank-image-dark.svg') }}');
                        }</style>
                    <!--end::Image placeholder-->
                    <!--begin::Image input-->
                    <div class="image-input image-input-outline image-input-placeholder"
                         data-kt-image-input="true">
                        <!--begin::Preview existing avatar-->
                        <div wire:ignore class="image-input-wrapper w-125px h-125px"
                             style="background-image: url({{ $this->User->profile_photo_url }});"></div>
                        <!--end::Preview existing avatar-->
                        <!--begin::Label-->
                        <label
                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                            title="Change avatar">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <!--begin::Inputs-->
                            <input wire:model="user_image_path"
                                   type="file"
                                   name="avatar"
                                   accept=".png, .jpg, .jpeg"/>
                            <input type="hidden" name="avatar_remove"/>
                            <!--end::Inputs-->
                        </label>
                        <!--end::Label-->
                        <!--begin::Cancel-->
                        <span
                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                            title="Cancel avatar">
                                                            <i class="bi bi-x fs-2"></i>
                                                        </span>
                        <!--end::Cancel-->
                        <!--begin::Remove-->
                        <span
                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                            title="Remove avatar">
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
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                    فئة المستأجر
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <!--begin::Options-->
                    <div class="d-flex align-items-center mt-3">
                        <!--begin::Option-->
                        <label for="user_type_person" class="form-check form-check-custom form-check-inline form-check-solid me-5">
                            <input class="form-check-input" wire:model="User.user_type"
                                   type="radio" value="1"/>
                            <span class="fw-semibold ps-2 fs-6">أفراد</span>
                        </label>
                        <!--end::Option-->
                        <!--begin::Option-->
                        <label
                            class="form-check form-check-custom form-check-inline form-check-solid">
                            <input class="form-check-input" wire:model="User.user_type"
                                   type="radio" value="2"/>
                            <span class="fw-semibold ps-2 fs-6">شركات</span>
                        </label>
                        @error('User.user_type')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                        <!--end::Option-->
                    </div>
                    <!--end::Options-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6 ">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                    @if($User->is_person == 1)
                        الاسم
                    @else
                        اسم المؤسسة
                    @endif
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <!--begin::Row-->
                    <div class="row">
                        <!--begin::Col-->
                        <div class="col-lg-12 fv-row">
                            <input type="text" wire:model="User.name"
                                   class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                   placeholder="الأسم الكامل"/>
                            @error('User.name')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            @if($this->User->is_corporate)
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                        رقم السجل
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input wire:model="User.corporate_id"
                               class="form-control form-control-lg form-control-solid" />
                        @error('User.corporate_id')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                        اسم الشخص المسؤول
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input wire:model="User.contact_name"
                               class="form-control form-control-lg form-control-solid" />
                        @error('User.contact_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

            @endif


            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label required fw-semibold fs-6">البريد
                    الإلكتروني</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="email" wire:model="User.email"
                           class="form-control form-control-lg form-control-solid"
                           placeholder="البريد الإلكتروني"/>
                    @error('User.email')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                    <span class="required">الرقم الشخصي</span>
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="number" wire:model="User.cpr"
                           class="form-control form-control-lg form-control-solid"
                           placeholder="الرقم الشخصي"/>
                    @error('User.cpr')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            @if($this->User->is_person)
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                        <span class="required">الجنسية</span>
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <!--begin::Input -->
                        <select wire:model.defer="User.nationality_id" class="form-control form-control-solid form-select form-control-solid">
                            <option value="">اختيار</option>
                            @foreach($this->nationalities as $nationality)
                                <option value="{{ $nationality->id }}">{{ $nationality->name }}</option>
                            @endforeach
                        </select>
                        @error('User.nationality_id')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                        <!--end::Input -->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                        <span class="required">رقم الهاتف</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                           title="رقم الهاتف يجب أن يكون فعال."></i>
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="tel" wire:model="User.phone"
                               class="form-control form-control-lg form-control-solid"
                               placeholder="رقم الهاتف"/>
                        @error('User.phone')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            @endif

            @if($this->User->is_corporate)
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                        <span class="required">رقم هاتف التواصل</span>
                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                           title="رقم هاتف التواصل مع المؤسسة"></i>
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <input type="tel" wire:model="User.contact_phone"
                               class="form-control form-control-lg form-control-solid"
                               placeholder="رقم هاتف التواصل مع المؤسسة"/>
                        @error('User.contact_phone')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            @endif

            <!--begin::Input group-->
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-4 col-form-label fw-semibold fs-6">
                    <span>الواتس آب</span>
                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                       title="رقم الهاتف يجب أن يكون فعال."></i>
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8 fv-row">
                    <input type="tel" wire:model="User.whatsapp_phone"
                           class="form-control form-control-lg form-control-solid"
                           placeholder="رقم الهاتف"/>
                    @error('User.whatsapp_phone')
                    <div class="alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <!--end::Col-->
            </div>
            <!--end::Input group-->

            @if($this->User->is_person)
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">
                        <span class="required">الجنس</span>
                    </label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row">
                        <select wire:model="User.gender"
                                class="form-select form-select-solid form-select-lg">
                            <option label="">تحديد الجنس...</option>
                            <option value="1">ذكر</option>
                            <option value="2">انثى</option>
                        </select>
                        @error('User.gender')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            @endif

            <!--begin::Action buttons-->
            <div class="d-flex justify-content-end align-items-center mt-12">
                <!--begin::Button-->
                <button wire:click="save" type="button" class="btn btn-primary">
                    <span class="indicator-label">حفظ</span>
                </button>
                <!--end::Button-->
            </div>
            <!--begin::Action buttons-->
        </div>
        <!--end::Card body-->
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
