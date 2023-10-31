<div wire:init="load">
    <!--begin::Report-->
    <div class="card card-xl-stretch">
        <!--begin::Body-->
        <div class="card-body p-0 d-flex justify-content-between flex-column overflow-hidden">
            <!--begin::Hidden-->
            <div class="d-flex flex-stack flex-wrap flex-grow-1 px-9 pt-9 pb-3">
                <div class="me-2">
                    <span class="fw-bold text-gray-800 d-block fs-3">الإحصائية السنوية للعقارات</span>
                    <span class="text-gray-400 fw-bold">خلال سنة {{ date('Y') }}</span>
                </div>
{{--                <div class="fw-bold fs-3 text-info">$15,300</div>--}}
            </div>
            <!--end::Hidden-->
            <!--begin::Chart-->
            <div id="property-rent-overview" data-kt-color="info" style="height: 200px"></div>
            <!--end::Chart-->
        </div>
    </div>
    <!--end::Report-->
    @push('js')
        <script src="{{ asset('admin-assets/js/widgets.bundle.js') }}"></script>
        <script>
            var initPropertyRentOverviewChart = function(params) {
                var element = document.getElementById('property-rent-overview');

                var color;
                var height;
                var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
                var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
                var baseLightColor;
                var secondaryColor = KTUtil.getCssVariableValue('--bs-gray-300');
                var baseColor;
                var options;
                var chart;

                color = element.getAttribute("data-kt-color");
                height = parseInt(KTUtil.css(element, 'height'));
                baseColor = KTUtil.getCssVariableValue('--bs-' + color);

                options = {
                    series: params.series,
                    chart: {
                        fontFamily: 'inherit',
                        type: 'bar',
                        height: height,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: ['50%'],
                            borderRadius: 4
                        },
                    },
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        }
                    },
                    yaxis: {
                        y: 0,
                        offsetX: 0,
                        offsetY: 0,
                        labels: {
                            style: {
                                colors: labelColor,
                                fontSize: '12px'
                            }
                        }
                    },
                    fill: {
                        type: 'solid'
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px'
                        },
                        y: {
                            formatter: function (val) {
                                return val + " د.ب."
                            }
                        }
                    },
                    colors: [baseColor, secondaryColor],
                    grid: {
                        padding: {
                            top: 10
                        },
                        borderColor: borderColor,
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    }
                };
                chart = new ApexCharts(element, options);
                chart.render();
            }

            Livewire.on('init-property-rent-overview-chart', function (params) {
                console.log(params)
                initPropertyRentOverviewChart(params);
            });

            // params = {
            //     series: [{
            //         name: 'Net Profit',
            //         data: [30, 50, 60, 70, 80, 60, 50, 70, 60, 40, 30, 20]
            //     }, {
            //         name: 'Revenue',
            //         data: [30, 50, 60, 70, 80, 60, 50, 70, 60, 40, 30, 20]
            //     }],
            // }
        </script>
    @endpush
</div>
