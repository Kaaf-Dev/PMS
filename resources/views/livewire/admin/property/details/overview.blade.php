<div class="row g-6 g-xl-9">
        <!--begin::Col-->
    <div class="col-lg-12">
        <!--begin::Summary-->
        <div class="card card-flush h-lg-100">
            <!--begin::Card header-->
            <div class="card-header mt-6">
                <!--begin::Card title-->
                <div class="card-title flex-column">
                    <h3 class="fw-bold mb-1">الوحدات والاراضي</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-9 pt-5">
                <!--begin::Wrapper-->
                <div class="d-flex flex-wrap">
                    <!--begin::Chart-->
                    <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
                        <div class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
                            <span class="fs-2qx fw-bold">{{ $this->property->apartments_count }}</span>
                            <span class="fs-6 fw-semibold text-gray-400">المجموع</span>
                        </div>
                        <canvas wire:ignore id="apartments_overview_chart"></canvas>
                    </div>
                    <!--end::Chart-->
                    <!--begin::Labels-->
                    <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                            <div class="bullet bg-success me-3"></div>
                            <div class="text-gray-400">المتاح</div>
                            <div class="ms-auto fw-bold text-gray-700">{{ $this->property->available_apartments_count }}</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Label-->
                        <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                            <div class="bullet bg-primary me-3"></div>
                            <div class="text-gray-400">المؤجر</div>
                            <div class="ms-auto fw-bold text-gray-700">{{ $this->property->rented_apartments_count }}</div>
                        </div>
                        <!--end::Label-->
                    </div>
                    <!--end::Labels-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Summary-->
    </div>
    <!--end::Col-->

    <!--begin::Col-->
    <div class="col-lg-12">
        <div class="row g-5 g-xl-8">
{{--            <div class="col-xl-4">--}}
{{--                <!--begin::Statistics Widget 5-->--}}
{{--                <div class="card bg-primary hoverable card-xl-stretch mb-xl-8">--}}
{{--                    <!--begin::Body-->--}}
{{--                    <div class="card-body">--}}
{{--                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->--}}
{{--                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">--}}
{{--														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--															<rect x="8" y="9" width="3" height="10" rx="1.5" fill="currentColor"></rect>--}}
{{--															<rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="currentColor"></rect>--}}
{{--															<rect x="18" y="11" width="3" height="8" rx="1.5" fill="currentColor"></rect>--}}
{{--															<rect x="3" y="13" width="3" height="6" rx="1.5" fill="currentColor"></rect>--}}
{{--														</svg>--}}
{{--													</span>--}}
{{--                        <!--end::Svg Icon-->--}}
{{--                        <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">1452.25 د.ب</div>--}}
{{--                        <div class="fw-semibold text-gray-100">العوائد لهذا الشهر</div>--}}
{{--                    </div>--}}
{{--                    <!--end::Body-->--}}
{{--                </div>--}}
{{--                <!--end::Statistics Widget 5-->--}}
{{--            </div>--}}
{{--            <div class="col-xl-4">--}}
{{--                <!--begin::Statistics Widget 5-->--}}
{{--                <div class="card bg-dark hoverable card-xl-stretch mb-xl-8">--}}
{{--                    <!--begin::Body-->--}}
{{--                    <div class="card-body">--}}
{{--                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->--}}
{{--                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">--}}
{{--														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--															<path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor"></path>--}}
{{--															<path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor"></path>--}}
{{--															<path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor"></path>--}}
{{--														</svg>--}}
{{--													</span>--}}
{{--                        <!--end::Svg Icon-->--}}
{{--                        <div class="text-gray-100 fw-bold fs-2 mb-2 mt-5">130.50 د.ب</div>--}}
{{--                        <div class="fw-semibold text-gray-100">العوائد القادمة</div>--}}
{{--                    </div>--}}
{{--                    <!--end::Body-->--}}
{{--                </div>--}}
{{--                <!--end::Statistics Widget 5-->--}}
{{--            </div>--}}
{{--            <div class="col-xl-4">--}}
{{--                <!--begin::Statistics Widget 5-->--}}
{{--                <div href="#" class="card bg-danger hoverable card-xl-stretch mb-xl-8">--}}
{{--                    <!--begin::Body-->--}}
{{--                    <div class="card-body">--}}
{{--                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->--}}
{{--                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">--}}
{{--                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="currentColor"></path>--}}
{{--                                <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="currentColor"></path>--}}
{{--                            </svg>--}}
{{--                        </span>--}}
{{--                        <!--end::Svg Icon-->--}}
{{--                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $this->openTickets }}</div>--}}
{{--                        <div class="fw-semibold text-white">طلبات الصيانة المفتوحة</div>--}}
{{--                    </div>--}}
{{--                    <!--end::Body-->--}}
{{--                </div>--}}
{{--                <!--end::Statistics Widget 5-->--}}
{{--            </div>--}}
        </div>
    </div>
    <!--end::Col-->

</div>

@push('js')
    <script>
        "use strict";
        var KTProjectOverview = (function () {
            var t = KTUtil.getCssVariableValue("--kt-primary"),
                e = KTUtil.getCssVariableValue("--kt-primary-light"),
                a = KTUtil.getCssVariableValue("--kt-success"),
                r = KTUtil.getCssVariableValue("--kt-success-light"),
                o = KTUtil.getCssVariableValue("--kt-gray-200"),
                n = KTUtil.getCssVariableValue("--kt-gray-500");
            return {
                init: function () {
                    var s, i;
                    !(function () {
                        var t = document.getElementById("apartments_overview_chart");
                        if (t) {
                            var e = t.getContext("2d");
                            new Chart(e, {
                                type: "doughnut",
                                data: {
                                    datasets: [{
                                        data: [
                                            {{ $this->property->available_apartments_count }},
                                            {{ $this->property->rented_apartments_count }},
                                        ],
                                        backgroundColor: [
                                            "#50CD89",
                                            "#00A3FF"
                                        ]
                                    }],
                                    labels: ["المتاح", "المؤجر"]
                                },
                                options: {
                                    chart: { fontFamily: "inherit" },
                                    cutoutPercentage: 75,
                                    responsive: !0,
                                    maintainAspectRatio: !1,
                                    cutout: "75%",
                                    title: { display: !1 },
                                    animation: { animateScale: !0, animateRotate: !0 },
                                    tooltips: {
                                        enabled: !0,
                                        intersect: !1,
                                        mode: "nearest",
                                        bodySpacing: 5,
                                        yPadding: 10,
                                        xPadding: 10,
                                        caretPadding: 0,
                                        displayColors: !1,
                                        backgroundColor: "#20D489",
                                        titleFontColor: "#ffffff",
                                        cornerRadius: 4,
                                        footerSpacing: 0,
                                        titleSpacing: 0,
                                    },
                                    plugins: { legend: { display: !1 } },
                                },
                            });
                        }
                    })()
                },
            };
        })();
        KTUtil.onDOMContentLoaded(function () {
            KTProjectOverview.init();
        });
    </script>
@endpush
