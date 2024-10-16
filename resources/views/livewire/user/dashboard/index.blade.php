<div>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar d-flex pb-3 pb-lg-5">
        <!--begin::Toolbar container-->
        <div class="d-flex flex-stack flex-row-fluid">
            <!--begin::Toolbar container-->
            <div class="d-flex flex-column flex-row-fluid">
                <!--begin::Toolbar wrapper-->
                <!--begin::Page title-->
                <div class="page-title d-flex align-items-center me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-lg-2x gap-2">
                        <span>
                            <span class="fw-light">مرحبًا،</span>&nbsp;{{ Auth::user()->name }}
                        </span>
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Row-->
        <div class="row g-5 mb-xl-5">
            <!--begin::Col-->
            <div class="col-xl-8">
                <!--begin::contracts list-->
                <livewire:user.dashboard.invoices-list/>
                <!--end::contracts list-->
            </div>
            <!--end::Col-->

            <!--begin::contracts list-->
            <livewire:user.dashboard.contracts-list/>
            <!--end::contracts list-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-xl-5">
            <livewire:user.dashboard.stats/>

            <!--begin::Col-->
            <div class="col-xl-12 mb-xl-5">
                <!--begin::contracts list-->
                <livewire:user.dashboard.receipt-list/>
                <!--end::contracts list-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Content-->
</div>
