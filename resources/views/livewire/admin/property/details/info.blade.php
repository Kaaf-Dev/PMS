<div class="card mb-5 mb-xl-8">
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Summary-->
        <!--begin::User Info-->
        <div class="d-flex flex-center flex-column py-5">
            <!--begin::Name-->
            <a class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $this->property->name }}</a>
            <!--end::Name-->
        </div>
        <!--end::User Info-->
        <!--end::Summary-->
        <!--begin::Details toggle-->
        <div class="d-flex flex-stack fs-4 py-3">
            <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">المعلومات
                <span class="ms-2 rotate-180">
															<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
															<span class="svg-icon svg-icon-3">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
																</svg>
															</span>
                    <!--end::Svg Icon-->
														</span></div>
        </div>
        <!--end::Details toggle-->
        <div class="separator"></div>
        <!--begin::Details content-->
        <div id="kt_user_view_details" class="collapse show">

            <div class="mt-5">
                <div class="row g-xl-5">
                    <div class="col-xl-6 col-md-12">
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3 text-center">
                            <!--begin::Number-->
                            <div class="">
                                <div class="fs-4 fw-bold">
                                    <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2023-01-26-051612/core/html/src/media/icons/duotune/abstract/abs027.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-2hx">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                           <path d="M17 7V17H7V7H17ZM20 3H4C3.4 3 3 3.4 3 4V20C3 20.6 3.4 21 4 21H20C20.6 21 21 20.6 21 20V4C21 3.4 20.6 3 20 3Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Number-->

                            <!--begin::Label-->
                            <div class="fw-semibold fs-4 text-dark-400">{{ $this->property->area }}</div>
                            <div class="fw-semibold fs-6 text-gray-400">المساحة</div>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                    </div>
                    <div class="col-xl-6 col-md-12">
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3 text-center">
                            <!--begin::Number-->
                            <div class="">
                                <div class="fs-4 fw-bold">
                                    <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2023-01-26-051612/core/html/src/media/icons/duotune/abstract/abs027.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-2hx">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="currentColor"/>
                                            <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Number-->

                            <!--begin::Label-->
                            <div class="fw-semibold fs-4 text-dark-400">{{ $this->property->floors_count }}</div>
                            <div class="fw-semibold fs-6 text-gray-400">عدد الطوابق</div>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <!--begin::Stat-->
                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3 text-center">
                            <!--begin::Number-->
                            <div class="">
                                <div class="fs-4 fw-bold">
                                    <!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/metronic/html/releases/2023-01-26-051612/core/html/src/media/icons/duotune/abstract/abs027.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-2hx">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="currentColor"/>
                                            <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="currentColor"/>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                            </div>
                            <!--end::Number-->

                            <!--begin::Label-->
                            <div class="fw-semibold fs-4 text-dark-400">{{ $this->property->construction_date }}</div>
                            <div class="fw-semibold fs-6 text-gray-400">سنة التأسيس</div>
                            <!--end::Label-->
                        </div>
                        <!--end::Stat-->
                    </div>
                </div>
            </div>
        </div>
        <!--end::Details content-->
    </div>
    <!--end::Card body-->
</div>
