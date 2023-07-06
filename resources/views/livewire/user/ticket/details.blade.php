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
                        <span>متابعة طلب الصيانة</span>
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
            <!--begin::Actions-->
            <div class="d-flex align-self-center flex-center flex-shrink-0">
                <a href="#" class="btn btn-sm btn-success d-flex flex-center ms-3 px-4 py-3" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                    <i class="ki-outline ki-plus-square fs-2"></i>
                    <span>Invite</span>
                </a>
                <a href="#" class="btn btn-sm btn-dark ms-3 px-4 py-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Create
                    <span class="d-none d-sm-inline">Target</span></a>
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">

        @livewire('user.ticket.details.overview', ['ticket' => $this->ticket->id])

        @livewire('user.ticket.details.replies', ['ticket' => $this->ticket->id])

    </div>
    <!--end::Content-->
</div>
