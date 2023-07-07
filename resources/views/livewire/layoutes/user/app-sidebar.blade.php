<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="275px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_toggle">
    <!--begin::Sidebar nav-->
    <div class="app-sidebar-wrapper py-8 py-lg-10" id="kt_app_sidebar_wrapper">
        <!--begin::Nav wrapper-->
        <div id="kt_app_sidebar_nav_wrapper" class="d-flex flex-column px-8 px-lg-10 hover-scroll-y" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="{default: false, lg: '#kt_app_header'}" data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_wrapper" data-kt-scroll-offset="{default: '10px', lg: '40px'}">
            <!--begin::Links-->
            <div class="mb-0">
                <!--begin::Title-->
                <h3 class="text-gray-800 fw-bold mb-8">لوحة التحكم</h3>
                <!--end::Title-->
                <!--begin::Row-->
                <div class="row g-5" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Link-->
                        <a href="{{ route('user.contracts') }}" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                            <!--begin::Icon-->
                            <span class="mb-2">
                                <i class="ki-outline ki-cheque fs-1"></i>
                            </span>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <span class="fs-7 fw-bold">العقود</span>
                            <!--end::Label-->
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Link-->
                        <a href={{ route('user.tickets') }} class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                            <!--begin::Icon-->
                            <span class="mb-2">
                                <i class="ki-outline ki-office-bag fs-1"></i>
                            </span>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <span class="fs-7 fw-bold">الصيانة</span>
                            <!--end::Label-->
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Link-->
                        <a href="#" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                            <!--begin::Icon-->
                            <span class="mb-2">
                                <i class="ki-outline ki-wallet fs-1"></i>
                            </span>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <span class="fs-7 fw-bold">المالية</span>
                            <!--end::Label-->
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-6">
                        <!--begin::Link-->
                        <a href="#" class="btn btn-icon btn-outline btn-bg-light btn-active-light-primary btn-flex flex-column flex-center w-100px h-100px border-gray-200" data-kt-button="true">
                            <!--begin::Icon-->
                            <span class="mb-2">
                                <i class="ki-outline ki-chart-pie-simple fs-1"></i>
                            </span>
                            <!--end::Icon-->
                            <!--begin::Label-->
                            <span class="fs-7 fw-bold">التقارير</span>
                            <!--end::Label-->
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Links-->
        </div>
        <!--end::Nav wrapper-->
    </div>
    <!--end::Sidebar nav-->
</div>
