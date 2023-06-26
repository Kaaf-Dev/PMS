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
                        <span>عقد الإيجار</span>
                    </h1>
                    <!--end::Title-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
{{--            <!--begin::Actions-->--}}
{{--            <div class="d-flex align-self-center flex-center flex-shrink-0">--}}
{{--                <a href="#" class="btn btn-sm btn-success d-flex flex-center ms-3 px-4 py-3" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">--}}
{{--                    <i class="ki-outline ki-plus-square fs-2"></i>--}}
{{--                    <span>Invite</span>--}}
{{--                </a>--}}
{{--                <a href="#" class="btn btn-sm btn-dark ms-3 px-4 py-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Create--}}
{{--                    <span class="d-none d-sm-inline">Target</span></a>--}}
{{--            </div>--}}
{{--            <!--end::Actions-->--}}
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">

                @livewire('user.contract.details.overview', ['contract' => $this->contract->id])

                <!--begin::Card-->
                <div class="card card-flush pt-3 mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Recent Events</h2>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <a href="#" class="btn btn-light-primary">View All Events</a>
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table wrapper-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-5" id="kt_table_customers_events">
                                <tbody>
                                <tr>
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bold text-gray-800 text-hover-primary me-1">2576-8186</a>is
                                        <span class="badge badge-light-info">In Progress</span></td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">24 Jun 2023, 5:20 pm</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bold text-gray-800 text-hover-primary me-1">2367-9840</a>has been
                                        <span class="badge badge-light-danger">Declined</span></td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">22 Sep 2023, 10:30 am</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bold text-gray-800 text-hover-primary me-1">5110-8272</a>status has changed from
                                        <span class="badge badge-light-warning me-1">Pending</span>to
                                        <span class="badge badge-light-info">In Progress</span></td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">10 Mar 2023, 5:30 pm</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bold text-gray-800 text-hover-primary me-1">9315-8926</a>status has changed from
                                        <span class="badge badge-light-primary me-1">In Transit</span>to
                                        <span class="badge badge-light-success">Approved</span></td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">25 Oct 2023, 6:43 am</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bold text-gray-800 text-hover-primary me-1">2367-9840</a>has been
                                        <span class="badge badge-light-danger">Declined</span></td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">20 Jun 2023, 10:30 am</td>
                                </tr>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-flush pt-3 mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>Invoices</h2>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Tab nav-->
                            <ul class="nav nav-stretch fs-5 fw-semibold nav-line-tabs nav-line-tabs-2x border-transparent" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a id="kt_referrals_year_tab" class="nav-link text-active-primary active" data-bs-toggle="tab" role="tab" href="#kt_customer_details_invoices_1">This Year</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a id="kt_referrals_2019_tab" class="nav-link text-active-primary ms-3" data-bs-toggle="tab" role="tab" href="#kt_customer_details_invoices_2">2020</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a id="kt_referrals_2018_tab" class="nav-link text-active-primary ms-3" data-bs-toggle="tab" role="tab" href="#kt_customer_details_invoices_3">2019</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a id="kt_referrals_2017_tab" class="nav-link text-active-primary ms-3" data-bs-toggle="tab" role="tab" href="#kt_customer_details_invoices_4">2018</a>
                                </li>
                            </ul>
                            <!--end::Tab nav-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-2">
                        <!--begin::Tab Content-->
                        <div id="kt_referred_users_tab_content" class="tab-content">
                            <!--begin::Tab panel-->
                            <div id="kt_customer_details_invoices_1" class="tab-pane fade show active" role="tabpanel">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table id="kt_customer_details_invoices_table_1" class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                                        <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                                        <tr class="text-start text-gray-400">
                                            <th class="min-w-100px">Order ID</th>
                                            <th class="min-w-100px">Amount</th>
                                            <th class="min-w-100px">Status</th>
                                            <th class="min-w-125px">Date</th>
                                            <th class="w-100px">Invoice</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">102445788</a>
                                            </td>
                                            <td class="text-success">$38.00</td>
                                            <td>
                                                <span class="badge badge-light-info">In progress</span>
                                            </td>
                                            <td>Nov 01, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">423445721</a>
                                            </td>
                                            <td class="text-danger">$-2.60</td>
                                            <td>
                                                <span class="badge badge-light-warning">Pending</span>
                                            </td>
                                            <td>Oct 24, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">312445984</a>
                                            </td>
                                            <td class="text-success">$76.00</td>
                                            <td>
                                                <span class="badge badge-light-warning">Pending</span>
                                            </td>
                                            <td>Oct 08, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">312445984</a>
                                            </td>
                                            <td class="text-success">$5.00</td>
                                            <td>
                                                <span class="badge badge-light-danger">Rejected</span>
                                            </td>
                                            <td>Sep 15, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">523445943</a>
                                            </td>
                                            <td class="text-danger">$-1.30</td>
                                            <td>
                                                <span class="badge badge-light-info">In progress</span>
                                            </td>
                                            <td>May 30, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Tab panel-->
                            <!--begin::Tab panel-->
                            <div id="kt_customer_details_invoices_2" class="tab-pane fade" role="tabpanel">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table id="kt_customer_details_invoices_table_2" class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                                        <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                                        <tr class="text-start text-gray-400">
                                            <th class="min-w-100px">Order ID</th>
                                            <th class="min-w-100px">Amount</th>
                                            <th class="min-w-100px">Status</th>
                                            <th class="min-w-125px">Date</th>
                                            <th class="w-100px">Invoice</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">523445943</a>
                                            </td>
                                            <td class="text-danger">$-1.30</td>
                                            <td>
                                                <span class="badge badge-light-info">In progress</span>
                                            </td>
                                            <td>May 30, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">231445943</a>
                                            </td>
                                            <td class="text-success">$204.00</td>
                                            <td>
                                                <span class="badge badge-light-danger">Rejected</span>
                                            </td>
                                            <td>Apr 22, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">426445943</a>
                                            </td>
                                            <td class="text-success">$31.00</td>
                                            <td>
                                                <span class="badge badge-light-warning">Pending</span>
                                            </td>
                                            <td>Feb 09, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">984445943</a>
                                            </td>
                                            <td class="text-success">$52.00</td>
                                            <td>
                                                <span class="badge badge-light-success">Approved</span>
                                            </td>
                                            <td>Nov 01, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">324442313</a>
                                            </td>
                                            <td class="text-danger">$-0.80</td>
                                            <td>
                                                <span class="badge badge-light-warning">Pending</span>
                                            </td>
                                            <td>Jan 04, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Tab panel-->
                            <!--begin::Tab panel-->
                            <div id="kt_customer_details_invoices_3" class="tab-pane fade" role="tabpanel">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table id="kt_customer_details_invoices_table_3" class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                                        <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                                        <tr class="text-start text-gray-400">
                                            <th class="min-w-100px">Order ID</th>
                                            <th class="min-w-100px">Amount</th>
                                            <th class="min-w-100px">Status</th>
                                            <th class="min-w-125px">Date</th>
                                            <th class="w-100px">Invoice</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">426445943</a>
                                            </td>
                                            <td class="text-success">$31.00</td>
                                            <td>
                                                <span class="badge badge-light-info">In progress</span>
                                            </td>
                                            <td>Feb 09, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">984445943</a>
                                            </td>
                                            <td class="text-success">$52.00</td>
                                            <td>
                                                <span class="badge badge-light-warning">Pending</span>
                                            </td>
                                            <td>Nov 01, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">324442313</a>
                                            </td>
                                            <td class="text-danger">$-0.80</td>
                                            <td>
                                                <span class="badge badge-light-info">In progress</span>
                                            </td>
                                            <td>Jan 04, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">312445984</a>
                                            </td>
                                            <td class="text-success">$5.00</td>
                                            <td>
                                                <span class="badge badge-light-success">Approved</span>
                                            </td>
                                            <td>Sep 15, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">102445788</a>
                                            </td>
                                            <td class="text-success">$38.00</td>
                                            <td>
                                                <span class="badge badge-light-warning">Pending</span>
                                            </td>
                                            <td>Nov 01, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Tab panel-->
                            <!--begin::Tab panel-->
                            <div id="kt_customer_details_invoices_4" class="tab-pane fade" role="tabpanel">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table id="kt_customer_details_invoices_table_4" class="table align-middle table-row-dashed fs-6 fw-bold gs-0 gy-4 p-0 m-0">
                                        <thead class="border-bottom border-gray-200 fs-7 text-uppercase fw-bold">
                                        <tr class="text-start text-gray-400">
                                            <th class="min-w-100px">Order ID</th>
                                            <th class="min-w-100px">Amount</th>
                                            <th class="min-w-100px">Status</th>
                                            <th class="min-w-125px">Date</th>
                                            <th class="w-100px">Invoice</th>
                                        </tr>
                                        </thead>
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">102445788</a>
                                            </td>
                                            <td class="text-success">$38.00</td>
                                            <td>
                                                <span class="badge badge-light-success">Approved</span>
                                            </td>
                                            <td>Nov 01, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">423445721</a>
                                            </td>
                                            <td class="text-danger">$-2.60</td>
                                            <td>
                                                <span class="badge badge-light-danger">Rejected</span>
                                            </td>
                                            <td>Oct 24, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">102445788</a>
                                            </td>
                                            <td class="text-success">$38.00</td>
                                            <td>
                                                <span class="badge badge-light-danger">Rejected</span>
                                            </td>
                                            <td>Nov 01, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">423445721</a>
                                            </td>
                                            <td class="text-danger">$-2.60</td>
                                            <td>
                                                <span class="badge badge-light-info">In progress</span>
                                            </td>
                                            <td>Oct 24, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-gray-600 text-hover-primary">426445943</a>
                                            </td>
                                            <td class="text-success">$31.00</td>
                                            <td>
                                                <span class="badge badge-light-danger">Rejected</span>
                                            </td>
                                            <td>Feb 09, 2020</td>
                                            <td class="">
                                                <button class="btn btn-sm btn-light btn-active-light-primary">Download</button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>
                            <!--end::Tab panel-->
                        </div>
                        <!--end::Tab Content-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Layout-->
    </div>
    <!--end::Content-->
</div>
