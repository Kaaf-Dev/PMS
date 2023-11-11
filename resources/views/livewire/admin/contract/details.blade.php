<div>
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    إدارة العقود
                </h1>
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
                        <a href="{{ route('admin.contracts') }}" class="text-muted text-hover-primary">العقود</a>
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
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
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">

                    <!--begin::Card-->
                        @livewire('admin.contract.details.overview', ['contract_id' => $this->contract->id, 'preset' => 'contract_page'])
                    <!--end::Card-->

                    <!--begin::Card-->
                        @livewire('admin.contract.details.invoices-list', ['contract_id' => $this->contract->id])
                    <!--end::Card-->

                    <!--begin::Card-->
                        @livewire('admin.contract.details.attachment-list', ['contract_id' => $this->contract->id])
                    <!--end::Card-->

                    @if($this->contract->is_lawyerable)

                        @livewire('admin.lawyer-case.details.overview', ['lawyer_case' => $this->contract->lawyerCase->id])

                        @livewire('admin.lawyer-case.invoice.list-table', ['lawyer_case' => $this->contract->lawyerCase->id])

                    @endif

                    @if($this->contract->contract_replies_count > 0 or $this->contract->is_lawyerable)
                        <!--begin::Card-->
                        @livewire('admin.contract.details.replies', ['contract' => $this->contract->id])
                        <!--end::Card-->
                    @endif

                </div>
                <!--end::Content-->
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
                    <!--begin::Card-->
                    @livewire('admin.contract.details.summary', ['contract_id' => $this->contract->id])
                    <!--end::Card-->
                </div>
                <!--end::Sidebar-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>
