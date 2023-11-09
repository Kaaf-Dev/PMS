<div>
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid pt-0">

        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Search vertical-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Aside-->
                <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xxl-325px mb-8 mb-lg-0 me-lg-9 me-5">
                    @livewire('maintenance.ticket.filter')
                </div>
                <!--end::Aside-->
                <!--begin::Layout-->
                <div class="flex-lg-row-fluid">
                    <!--begin::Card-->
                    @livewire('maintenance.ticket.list-table')
                    <!--end::Card-->
                </div>
                <!--end::Layout-->
            </div>
            <!--begin::Search vertical-->
        </div>
        <!--end::Content wrapper-->

    </div>
    <!--end::Content-->
</div>
