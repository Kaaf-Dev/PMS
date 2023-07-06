<div>
    <!--begin::Card-->
    <div wire:init="load" class="card">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row p-7">
                <!--begin::Content-->
                <div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0">
                    <!--begin::Ticket view-->
                    <div class="mb-0">
                        <!--begin::Comments-->
                        <div class="mb-15">

                            <!--begin::Content-->
                            <div class="d-flex flex-column">
                                <!--begin::Title-->
                                <h1 class="text-gray-800 fw-semibold mb-10">
                                    الملاحظات

                                    <div wire:loading wire:target="load">
                                        <span class="spinner-border spinner-border-sm align-middle"></span>
                                    </div>

                                </h1>
                                <!--end::Title-->
                            </div>
                            <!--end::Content-->

                            @if ($replies)
                                @forelse($replies ?? [] as $reply)
                                    <!--begin::Comment-->
                                    <div class="mb-9">
                                        <!--begin::Card-->
                                        <div class="card card-bordered w-100">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Wrapper-->
                                                <div class="w-100 d-flex flex-stack mb-8">
                                                    <!--begin::Container-->
                                                    <div class="d-flex align-items-center f">
                                                        <!--begin::Author-->
                                                        <div class="symbol symbol-50px me-5">
                                                            <div class="symbol-label fs-1 fw-bold bg-light-success text-success">S</div>
                                                        </div>
                                                        <!--end::Author-->
                                                        <!--begin::Info-->
                                                        <div class="d-flex flex-column fw-semibold fs-5 text-gray-600 text-dark">
                                                            <!--begin::Text-->
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Username-->
                                                                <a href="../../demo37/dist/pages/user-profile/overview.html" class="text-gray-800 fw-bold text-hover-primary fs-5 me-3">Sandra Piquet</a>
                                                                <!--end::Username-->
                                                                <span class="m-0"></span>
                                                            </div>
                                                            <!--end::Text-->
                                                            <!--begin::Date-->
                                                            <span class="text-muted fw-semibold fs-6">2 Days ago</span>
                                                            <!--end::Date-->
                                                        </div>
                                                        <!--end::Info-->
                                                    </div>
                                                    <!--end::Container-->
                                                    <!--begin::Actions-->
                                                    <div class="m-0">
                                                        <button class="btn btn-color-gray-400 btn-active-color-primary p-0 fw-bold">Reply</button>
                                                    </div>
                                                    <!--end::Actions-->
                                                </div>
                                                <!--end::Wrapper-->
                                                <!--begin::Desc-->
                                                <p class="fw-normal fs-5 text-gray-700 m-0">I run a team of 20 product managers, developers, QA and UX Previously we designed everything ourselves.</p>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Comment-->
                                @empty
                                @endforelse
                            @endif



{{--                            <!--begin::Comment-->--}}
{{--                            <div class="mb-9">--}}
{{--                                <!--begin::Card-->--}}
{{--                                <div class="card card-bordered w-100">--}}
{{--                                    <!--begin::Body-->--}}
{{--                                    <div class="card-body">--}}
{{--                                        <!--begin::Wrapper-->--}}
{{--                                        <div class="w-100 d-flex flex-stack mb-8">--}}
{{--                                            <!--begin::Container-->--}}
{{--                                            <div class="d-flex align-items-center f">--}}
{{--                                                <!--begin::Author-->--}}
{{--                                                <div class="symbol symbol-50px me-5">--}}
{{--                                                    <div class="symbol-label fs-1 fw-bold bg-light-info text-info">B</div>--}}
{{--                                                </div>--}}
{{--                                                <!--end::Author-->--}}
{{--                                                <!--begin::Info-->--}}
{{--                                                <div class="d-flex flex-column fw-semibold fs-5 text-gray-600 text-dark">--}}
{{--                                                    <!--begin::Text-->--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <!--begin::Username-->--}}
{{--                                                        <a href="../../demo37/dist/pages/user-profile/overview.html" class="text-gray-800 fw-bold text-hover-primary fs-5 me-3">Bob Clarcson</a>--}}
{{--                                                        <!--end::Username-->--}}
{{--                                                        <span class="badge badge-light-danger">Author</span>--}}
{{--                                                    </div>--}}
{{--                                                    <!--end::Text-->--}}
{{--                                                    <!--begin::Date-->--}}
{{--                                                    <span class="text-muted fw-semibold fs-6">4 Days ago</span>--}}
{{--                                                    <!--end::Date-->--}}
{{--                                                </div>--}}
{{--                                                <!--end::Info-->--}}
{{--                                            </div>--}}
{{--                                            <!--end::Container-->--}}
{{--                                            <!--begin::Actions-->--}}
{{--                                            <div class="m-0">--}}
{{--                                                <button class="btn btn-color-gray-400 btn-active-color-primary p-0 fw-bold">Reply</button>--}}
{{--                                            </div>--}}
{{--                                            <!--end::Actions-->--}}
{{--                                        </div>--}}
{{--                                        <!--end::Wrapper-->--}}
{{--                                        <!--begin::Desc-->--}}
{{--                                        <p class="fw-normal fs-5 text-gray-700 m-0">I run a team of 20 product managers, developers, QA and UX Previously we designed everything ourselves.</p>--}}
{{--                                        <!--end::Desc-->--}}
{{--                                    </div>--}}
{{--                                    <!--end::Body-->--}}
{{--                                </div>--}}
{{--                                <!--end::Card-->--}}
{{--                            </div>--}}
{{--                            <!--end::Comment-->--}}

                            <!--begin::Input group-->
                            <div class="mb-0">
                                <textarea class="form-control form-control-solid placeholder-gray-600 fw-bold fs-4 ps-9 pt-7" rows="6" name="message" placeholder="Share Your Knowledge"></textarea>
                                <!--begin::Submit-->
                                <button type="submit" class="btn btn-primary mt-n20 mb-20 position-relative float-end me-7">Send</button>
                                <!--end::Submit-->
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Comments-->
                    </div>
                    <!--end::Ticket view-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</div>
