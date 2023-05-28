<div>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">بيانات المستأجر</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">الرئيسية</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.users') }}" class="text-muted text-hover-primary">المستأجرين</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">بيانات المستأجرين</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">

            <!--begin::Layout-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                    <!--begin::Card-->
                    <div class="row">
                    </div>
                    <div class="card mb-5 mb-xl-8" wire:ignore>
                        @livewire('admin.users.details.info', ['user' => $this->User], key($this->User->id))
                    </div>

                    <div class="col-lg-12">
                        @livewire('admin.users.details.attachments', ['user' => $this->User])
                    </div>
                </div>
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                               href="#kt_user_view_overview_security">نظرة عامة</a>

                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true"
                               data-bs-toggle="tab" href="#kt_user_view_overview_tab">العمليات</a>
                        </li>
                        <!--end:::Tab item-->

{{--                        <!--begin:::Tab item-->--}}
{{--                        <li class="nav-item ms-auto">--}}
{{--                            <!--begin::Action menu-->--}}
{{--                            <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click"--}}
{{--                               data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">العمليات--}}
{{--                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->--}}
{{--                                <span class="svg-icon svg-icon-2 me-0">--}}
{{--            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
{{--                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                <path--}}
{{--                    d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"--}}
{{--                    fill="currentColor"/>--}}
{{--            </svg>--}}
{{--        </span>--}}
{{--                                <!--end::Svg Icon--></a>--}}
{{--                            <!--begin::Menu-->--}}
{{--                            <div--}}
{{--                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6"--}}
{{--                                data-kt-menu="true">--}}
{{--                                <!--begin::Menu item-->--}}
{{--                                <div class="menu-item px-5">--}}
{{--                                    <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Payments</div>--}}
{{--                                </div>--}}
{{--                                <!--end::Menu item-->--}}
{{--                                <!--begin::Menu item-->--}}
{{--                                <div class="menu-item px-5">--}}
{{--                                    <a href="#" class="menu-link px-5">Create invoice</a>--}}
{{--                                </div>--}}
{{--                                <!--end::Menu item-->--}}
{{--                                <!--begin::Menu item-->--}}
{{--                                <div class="menu-item px-5">--}}
{{--                                    <a href="#" class="menu-link flex-stack px-5">Create payments--}}
{{--                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"--}}
{{--                                           title="Specify a target name for future usage and reference"></i></a>--}}
{{--                                </div>--}}
{{--                                <!--end::Menu item-->--}}
{{--                                <!--begin::Menu item-->--}}
{{--                                <div class="menu-item px-5" data-kt-menu-trigger="hover"--}}
{{--                                     data-kt-menu-placement="left-start">--}}
{{--                                    <a href="#" class="menu-link px-5">--}}
{{--                                        <span class="menu-title">Subscription</span>--}}
{{--                                        <span class="menu-arrow"></span>--}}
{{--                                    </a>--}}
{{--                                    <!--begin::Menu sub-->--}}
{{--                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">--}}
{{--                                        <!--begin::Menu item-->--}}
{{--                                        <div class="menu-item px-3">--}}
{{--                                            <a href="#" class="menu-link px-5">Apps</a>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Menu item-->--}}
{{--                                        <!--begin::Menu item-->--}}
{{--                                        <div class="menu-item px-3">--}}
{{--                                            <a href="#" class="menu-link px-5">Billing</a>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Menu item-->--}}
{{--                                        <!--begin::Menu item-->--}}
{{--                                        <div class="menu-item px-3">--}}
{{--                                            <a href="#" class="menu-link px-5">Statements</a>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Menu item-->--}}
{{--                                        <!--begin::Menu separator-->--}}
{{--                                        <div class="separator my-2"></div>--}}
{{--                                        <!--end::Menu separator-->--}}
{{--                                        <!--begin::Menu item-->--}}
{{--                                        <div class="menu-item px-3">--}}
{{--                                            <div class="menu-content px-3">--}}
{{--                                                <label--}}
{{--                                                    class="form-check form-switch form-check-custom form-check-solid">--}}
{{--                                                    <input class="form-check-input w-30px h-20px" type="checkbox"--}}
{{--                                                           value="" name="notifications" checked="checked"--}}
{{--                                                           id="kt_user_menu_notifications"/>--}}
{{--                                                    <span class="form-check-label text-muted fs-6"--}}
{{--                                                          for="kt_user_menu_notifications">Notifications</span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Menu item-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Menu sub-->--}}
{{--                                </div>--}}
{{--                                <!--end::Menu item-->--}}
{{--                                <!--begin::Menu separator-->--}}
{{--                                <div class="separator my-3"></div>--}}
{{--                                <!--end::Menu separator-->--}}
{{--                                <!--begin::Menu item-->--}}
{{--                                <div class="menu-item px-5">--}}
{{--                                    <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Account</div>--}}
{{--                                </div>--}}
{{--                                <!--end::Menu item-->--}}
{{--                                <!--begin::Menu item-->--}}
{{--                                <div class="menu-item px-5">--}}
{{--                                    <a href="#" class="menu-link px-5">Reports</a>--}}
{{--                                </div>--}}
{{--                                <!--end::Menu item-->--}}
{{--                                <!--begin::Menu item-->--}}
{{--                                <div class="menu-item px-5 my-1">--}}
{{--                                    <a href="#" class="menu-link px-5">Account Settings</a>--}}
{{--                                </div>--}}
{{--                                <!--end::Menu item-->--}}
{{--                                <!--begin::Menu item-->--}}
{{--                                <div class="menu-item px-5">--}}
{{--                                    <a href="#" class="menu-link text-danger px-5">Delete customer</a>--}}
{{--                                </div>--}}
{{--                                <!--end::Menu item-->--}}
{{--                            </div>--}}
{{--                            <!--end::Menu-->--}}
{{--                            <!--end::Menu-->--}}
{{--                        </li>--}}
{{--                        <!--end:::Tab item-->--}}
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin:::Tab content-->
                    <div class="tab-content" id="myTabContent">
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade" id="kt_user_view_overview_tab" role="tabpanel">
                            @livewire('admin.users.details.settings', ['User' => $this->User])
                        </div>
                        <!--end:::Tab pane-->
                        <!--begin:::Tab pane-->
                        <div class="tab-pane fade active show" id="kt_user_view_overview_security" role="tabpanel">

                            <!--begin::Card-->
                            @livewire('admin.users.details.invoices-card', ['user_id' => $User->id])
                            <!--end::Card-->

{{--                            <!--begin::Card-->--}}
{{--                            <div class="card pt-4 mb-6 mb-xl-9">--}}
{{--                                <!--begin::Card header-->--}}
{{--                                <div class="card-header border-0">--}}
{{--                                    <!--begin::Card title-->--}}
{{--                                    <div class="card-title">--}}
{{--                                        <h2>الملف الشخصي</h2>--}}
{{--                                    </div>--}}
{{--                                    <!--end::Card title-->--}}
{{--                                </div>--}}
{{--                                <!--end::Card header-->--}}
{{--                                <!--begin::Card body-->--}}
{{--                                <!--begin::Card body-->--}}
{{--                                <div class="card-body border-top p-9">--}}
{{--                                    <!--begin::Input group-->--}}
{{--                                    <div class="row mb-6">--}}
{{--                                        <!--begin::Col-->--}}
{{--                                        <!--begin::Input group-->--}}
{{--                                        <div class="fv-row mb-7">--}}
{{--                                            <!--begin::Label-->--}}
{{--                                            <label class="d-block fw-semibold fs-6 mb-5">الصورة الشخصية</label>--}}
{{--                                            <!--end::Label-->--}}
{{--                                            <!--begin::Image placeholder-->--}}
{{--                                            <style>.image-input-placeholder {--}}
{{--                                                    background-image: url('assets/media/svg/files/blank-image.svg');--}}
{{--                                                }--}}

{{--                                                [data-theme="dark"] .image-input-placeholder {--}}
{{--                                                    background-image: url('assets/media/svg/files/blank-image-dark.svg');--}}
{{--                                                }</style>--}}
{{--                                            <!--end::Image placeholder-->--}}
{{--                                            <!--begin::Image input-->--}}
{{--                                            <div class="image-input image-input-outline image-input-placeholder"--}}
{{--                                                 data-kt-image-input="true">--}}
{{--                                                <!--begin::Preview existing avatar-->--}}
{{--                                                <div wire:ignore class="image-input-wrapper w-125px h-125px"--}}
{{--                                                     style="background-image: url({{\Illuminate\Support\Facades\URL::asset('user-image/'.$User->user_image_path)}});"></div>--}}
{{--                                                <!--end::Preview existing avatar-->--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <label--}}
{{--                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"--}}
{{--                                                    data-kt-image-input-action="change" data-bs-toggle="tooltip"--}}
{{--                                                    title="Change avatar">--}}
{{--                                                    <i class="bi bi-pencil-fill fs-7"></i>--}}
{{--                                                    <!--begin::Inputs-->--}}
{{--                                                    <input type="file" wire:model="user_image_path" name="avatar"--}}
{{--                                                           accept=".png, .jpg, .jpeg"/>--}}
{{--                                                    <input type="hidden" name="avatar_remove"/>--}}
{{--                                                    <!--end::Inputs-->--}}
{{--                                                </label>--}}
{{--                                                <!--end::Label-->--}}
{{--                                                <!--begin::Cancel-->--}}
{{--                                                <span--}}
{{--                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"--}}
{{--                                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip"--}}
{{--                                                    title="Cancel avatar">--}}
{{--																					<i class="bi bi-x fs-2"></i>--}}
{{--																				</span>--}}
{{--                                                <!--end::Cancel-->--}}
{{--                                                <!--begin::Remove-->--}}
{{--                                                <span--}}
{{--                                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"--}}
{{--                                                    data-kt-image-input-action="remove" data-bs-toggle="tooltip"--}}
{{--                                                    title="Remove avatar">--}}
{{--																					<i class="bi bi-x fs-2"></i>--}}
{{--																				</span>--}}
{{--                                                <!--end::Remove-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Image input-->--}}
{{--                                            <!--begin::Hint-->--}}
{{--                                            <div class="form-text">الامتدادات المسموح بها: png, jpg, jpeg.</div>--}}
{{--                                            @error('user_image')--}}
{{--                                            <div class="alert alert-danger">--}}
{{--                                                {{$message}}--}}
{{--                                            </div>--}}
{{--                                            @enderror--}}
{{--                                            <!--end::Hint-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Input group-->--}}
{{--                                        <!--end::Col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Input group-->--}}
{{--                                    <!--begin::Input group-->--}}
{{--                                    <div class="row mb-6">--}}
{{--                                        <!--begin::Label-->--}}
{{--                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">نوع--}}
{{--                                            المستأجر</label>--}}
{{--                                        <!--end::Label-->--}}
{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-lg-8 fv-row">--}}
{{--                                            <!--begin::Options-->--}}
{{--                                            <div class="d-flex align-items-center mt-3">--}}
{{--                                                <!--begin::Option-->--}}
{{--                                                <label for="user_type_person" class="form-check form-check-custom form-check-inline form-check-solid me-5">--}}
{{--                                                    <input class="form-check-input" wire:model="User.user_type"--}}
{{--                                                           type="radio" value="1"/>--}}
{{--                                                    <span class="fw-semibold ps-2 fs-6">أفراد</span>--}}
{{--                                                </label>--}}
{{--                                                <!--end::Option-->--}}
{{--                                                <!--begin::Option-->--}}
{{--                                                <label--}}
{{--                                                    class="form-check form-check-custom form-check-inline form-check-solid">--}}
{{--                                                    <input class="form-check-input" wire:model="User.user_type"--}}
{{--                                                           type="radio" value="2"/>--}}
{{--                                                    <span class="fw-semibold ps-2 fs-6">شركات</span>--}}
{{--                                                </label>--}}
{{--                                                <!--end::Option-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Options-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Input group-->--}}
{{--                                    <!--begin::Input group-->--}}
{{--                                    <div class="row mb-6 ">--}}
{{--                                        <!--begin::Label-->--}}
{{--                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">الأسم--}}
{{--                                            الكامل</label>--}}
{{--                                        <!--end::Label-->--}}
{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-lg-8">--}}
{{--                                            <!--begin::Row-->--}}
{{--                                            <div class="row">--}}
{{--                                                <!--begin::Col-->--}}
{{--                                                <div class="col-lg-12 fv-row">--}}
{{--                                                    <input type="text" wire:model="User.name"--}}
{{--                                                           class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"--}}
{{--                                                           placeholder="الأسم الكامل"/>--}}
{{--                                                </div>--}}
{{--                                                <!--end::Col-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Row-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Input group-->--}}
{{--                                    <!--begin::Input group-->--}}
{{--                                    <div class="row mb-6">--}}
{{--                                        <!--begin::Label-->--}}
{{--                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">البريد--}}
{{--                                            الإلكتروني</label>--}}
{{--                                        <!--end::Label-->--}}
{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-lg-8 fv-row">--}}
{{--                                            <input type="email" wire:model="User.email"--}}
{{--                                                   class="form-control form-control-lg form-control-solid"--}}
{{--                                                   placeholder="البريد الإلكتروني"/>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Input group-->--}}
{{--                                    <!--begin::Input group-->--}}
{{--                                    <div class="row mb-6">--}}
{{--                                        <!--begin::Label-->--}}
{{--                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">--}}
{{--                                            <span class="required">الرقم الشخصي</span>--}}
{{--                                        </label>--}}
{{--                                        <!--end::Label-->--}}
{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-lg-8 fv-row">--}}
{{--                                            <input type="number" wire:model="User.cpr"--}}
{{--                                                   class="form-control form-control-lg form-control-solid"--}}
{{--                                                   placeholder="الرقم الشخصي"/>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Input group-->--}}
{{--                                    <!--begin::Input group-->--}}
{{--                                    <div class="row mb-6">--}}
{{--                                        <!--begin::Label-->--}}
{{--                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">--}}
{{--                                            <span class="required">رقم الهاتف</span>--}}
{{--                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"--}}
{{--                                               title="رقم الهاتف يجب أن يكون فعال."></i>--}}
{{--                                        </label>--}}
{{--                                        <!--end::Label-->--}}
{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-lg-8 fv-row">--}}
{{--                                            <input type="tel" wire:model="User.phone"--}}
{{--                                                   class="form-control form-control-lg form-control-solid"--}}
{{--                                                   placeholder="رقم الهاتف"/>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Input group-->--}}
{{--                                    <!--begin::Input group-->--}}
{{--                                    <div class="row mb-6">--}}
{{--                                        <!--begin::Label-->--}}
{{--                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">--}}
{{--                                            <span class="required">الواتس آب</span>--}}
{{--                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"--}}
{{--                                               title="رقم الهاتف يجب أن يكون فعال."></i>--}}
{{--                                        </label>--}}
{{--                                        <!--end::Label-->--}}
{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-lg-8 fv-row">--}}
{{--                                            <input type="tel" wire:model="User.whatsapp_phone"--}}
{{--                                                   class="form-control form-control-lg form-control-solid"--}}
{{--                                                   placeholder="رقم الهاتف"/>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Input group-->--}}

{{--                                    <!--begin::Input group-->--}}
{{--                                    <div class="row mb-6">--}}
{{--                                        <!--begin::Label-->--}}
{{--                                        <label class="col-lg-4 col-form-label fw-semibold fs-6">--}}
{{--                                            <span class="required">الجنس</span>--}}
{{--                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"--}}
{{--                                               title="الجنس"></i>--}}
{{--                                        </label>--}}
{{--                                        <!--end::Label-->--}}
{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-lg-8 fv-row">--}}
{{--                                            <select wire:model="User.gender"--}}
{{--                                                    class="form-select form-select-solid form-select-lg">--}}
{{--                                                <option label="">تحديد الجنس...</option>--}}
{{--                                                <option value="1">ذكر</option>--}}
{{--                                                <option value="2">انثى</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Input group-->--}}

{{--                                    <!--begin::Input group-->--}}
{{--                                    <div class="row mb-6">--}}
{{--                                        <!--begin::Label-->--}}
{{--                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">طريقة--}}
{{--                                            التواصل</label>--}}
{{--                                        <!--end::Label-->--}}
{{--                                        <!--begin::Col-->--}}
{{--                                        <div class="col-lg-8 fv-row">--}}
{{--                                            <!--begin::Options-->--}}
{{--                                            <div class="d-flex align-items-center mt-3">--}}
{{--                                                <!--begin::Option-->--}}
{{--                                                <label--}}
{{--                                                    class="form-check form-check-custom form-check-inline form-check-solid me-5">--}}
{{--                                                    <input class="form-check-input" type="radio" value="1"/>--}}
{{--                                                    <span class="fw-semibold ps-2 fs-6">البريد الإلكتروني</span>--}}
{{--                                                </label>--}}
{{--                                                <!--end::Option-->--}}
{{--                                                <!--begin::Option-->--}}
{{--                                                <label--}}
{{--                                                    class="form-check form-check-custom form-check-inline form-check-solid">--}}
{{--                                                    <input class="form-check-input" type="radio" value="2"/>--}}
{{--                                                    <span class="fw-semibold ps-2 fs-6">الهاتف</span>--}}
{{--                                                </label>--}}
{{--                                                <!--end::Option-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Options-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Col-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Input group-->--}}
{{--                                    <!--begin::Action buttons-->--}}
{{--                                    <div class="d-flex justify-content-end align-items-center mt-12">--}}

{{--                                        <!--begin::Button-->--}}
{{--                                        <button wire:click="save" type="button" class="btn btn-primary">--}}
{{--                                            <span class="indicator-label">حفظ</span>--}}
{{--                                        </button>--}}
{{--                                        <!--end::Button-->--}}
{{--                                    </div>--}}
{{--                                    <!--begin::Action buttons-->--}}
{{--                                </div>--}}
{{--                                <!--end::Card body-->--}}
{{--                                <!--end::Card body-->--}}
{{--                            </div>--}}
{{--                            <!--end::Card-->--}}

                        </div>
                        <!--end:::Tab pane-->

                    </div>
                    <!--end:::Tab content-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->

        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
