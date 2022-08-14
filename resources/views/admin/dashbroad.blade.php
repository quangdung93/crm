@extends('admin.body')
@section('title','Tổng quan')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-ecommerce.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/charts/chart-apex.css') }}">
@endsection
@section('content')
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
    <div class="row match-height">
        <!-- Medal Card -->
        <div class="col-xl-4 col-md-6 col-12">
            <div class="card card-congratulation-medal">
                <div class="card-body">
                    <h5>Chúc mừng 🎉 {{ Auth::user()->name }}!</h5>
                    <p class="card-text font-small-3">Đã nhận được giải thưởng</p>
                    <h3 class="mb-75 mt-2 pt-50">
                        <a href="javascript:void(0);">500.000 VNĐ</a>
                    </h3>
                    <button type="button" class="btn btn-primary">Xem chi tiết</button>
                    <img src="../../../app-assets/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Pic" />
                </div>
            </div>
        </div>
        <!--/ Medal Card -->

        <!-- Statistics Card -->
        <div class="col-xl-8 col-md-6 col-12">
            <div class="card card-statistics">
                <div class="card-header">
                    <h4 class="card-title">Thống kê</h4>
                    <div class="d-flex align-items-center">
                        <p class="card-text font-small-2 mr-25 mb-0">Updated 1 month ago</p>
                    </div>
                </div>
                <div class="card-body statistics-body">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="media">
                                <div class="avatar bg-light-primary mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="trending-up" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">12420</h4>
                                    <p class="card-text font-small-3 mb-0">Đơn hàng</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                            <div class="media">
                                <div class="avatar bg-light-info mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="user" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">5533</h4>
                                    <p class="card-text font-small-3 mb-0 text-nowrap">Khách hàng</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                            <div class="media">
                                <div class="avatar bg-light-danger mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="box" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">1565</h4>
                                    <p class="card-text font-small-3 mb-0">Sản phẩm</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12">
                            <div class="media">
                                <div class="avatar bg-light-success mr-2">
                                    <div class="avatar-content">
                                        <i data-feather="users" class="avatar-icon"></i>
                                    </div>
                                </div>
                                <div class="media-body my-auto">
                                    <h4 class="font-weight-bolder mb-0">13</h4>
                                    <p class="card-text font-small-3 mb-0">Thành viên</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Statistics Card -->
    </div>

    <div class="row match-height">
        <div class="col-lg-4 col-12">
            <div class="row match-height">
                <!-- Bar Chart - Orders -->
                {{-- <div class="col-lg-6 col-md-3 col-6">
                    <div class="card">
                        <div class="card-body pb-50">
                            <h6>Orders</h6>
                            <h2 class="font-weight-bolder mb-1">2,76k</h2>
                            <div id="statistics-order-chart"></div>
                        </div>
                    </div>
                </div> --}}
                <!--/ Bar Chart - Orders -->

                <!-- Line Chart - Profit -->
                {{-- <div class="col-lg-6 col-md-3 col-6">
                    <div class="card card-tiny-line-stats">
                        <div class="card-body pb-50">
                            <h6>Profit</h6>
                            <h2 class="font-weight-bolder mb-1">6,24k</h2>
                            <div id="statistics-profit-chart"></div>
                        </div>
                    </div>
                </div> --}}
                <!--/ Line Chart - Profit -->

                <!-- Earnings Card -->
                {{-- <div class="col-lg-12 col-md-6 col-12">
                    <div class="card earnings-card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <h4 class="card-title mb-1">Earnings</h4>
                                    <div class="font-small-2">This Month</div>
                                    <h5 class="mb-1">$4055.56</h5>
                                    <p class="card-text text-muted font-small-2">
                                        <span class="font-weight-bolder">68.2%</span><span> more earnings than last month.</span>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <div id="earnings-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!--/ Earnings Card -->
            </div>
        </div>

        <!-- Revenue Report Card -->
        <div class="col-xl-12 col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                    <div class="header-left">
                        <h4 class="card-title">Doanh số bán hàng tháng 8</h4>
                    </div>
                    {{-- <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
                        <i data-feather="calendar"></i>
                        <input type="text" class="form-control flat-picker border-0 shadow-none bg-transparent pr-0" placeholder="YYYY-MM-DD" />
                    </div> --}}
                </div>
                <div class="card-body">
                    <canvas class="bar-chart-ex chartjs" data-height="400"></canvas>
                </div>
            </div>
        </div>
        <!--/ Revenue Report Card -->
    </div>
</section>
<!-- Dashboard Ecommerce ends -->
@endsection

@section('javascript')
    {{-- Charts --}}
    <script src="{{ asset('app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/charts/chart.min.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script> --}}
    {{-- <script src="{{ asset('app-assets/js/scripts/charts/chart-chartjs.js') }}"></script> --}}

    <script type="text/javascript">
        $(window).on('load', function () {
            var chartWrapper = $('.chartjs');
            var flatPicker = $('.flat-picker');
            let barChartEx = $('.bar-chart-ex');

            // Color Variables
            var primaryColorShade = '#836AF9',
                yellowColor = '#ffe800',
                successColorShade = '#28dac6',
                warningColorShade = '#ffe802',
                warningLightColor = '#FDAC34',
                infoColorShade = '#299AFF',
                greyColor = '#4F5D70',
                blueColor = '#2c9aff',
                blueLightColor = '#84D0FF',
                greyLightColor = '#EDF1F4',
                tooltipShadow = 'rgba(0, 0, 0, 0.25)',
                lineChartPrimary = '#666ee8',
                lineChartDanger = '#ff4961',
                labelColor = '#6e6b7b',
                grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout

            // Detect Dark Layout
            if ($('html').hasClass('dark-layout')) {
                labelColor = '#b4b7bd';
            }

            // Wrap charts with div of height according to their data-height
            if (chartWrapper.length) {
                chartWrapper.each(function () {
                $(this).wrap($('<div style="height:' + this.getAttribute('data-height') + 'px"></div>'));
                });
            }

            if (barChartEx.length) {
                var barChartExample = new Chart(barChartEx, {
                type: 'bar',
                options: {
                    elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderSkipped: 'bottom'
                    }
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    responsiveAnimationDuration: 500,
                    legend: {
                    display: false
                    },
                    tooltips: {
                    // Updated default tooltip UI
                    shadowOffsetX: 1,
                    shadowOffsetY: 1,
                    shadowBlur: 8,
                    shadowColor: tooltipShadow,
                    backgroundColor: window.colors.solid.white,
                    titleFontColor: window.colors.solid.black,
                    bodyFontColor: window.colors.solid.black
                    },
                    scales: {
                    xAxes: [
                        {
                        display: true,
                        gridLines: {
                            display: true,
                            color: grid_line_color,
                            zeroLineColor: grid_line_color
                        },
                        scaleLabel: {
                            display: false
                        },
                        ticks: {
                            fontColor: labelColor
                        }
                        }
                    ],
                    yAxes: [
                        {
                        display: true,
                        gridLines: {
                            color: grid_line_color,
                            zeroLineColor: grid_line_color
                        },
                        ticks: {
                            stepSize: 100,
                            min: 0,
                            max: 400,
                            fontColor: labelColor
                        }
                        }
                    ]
                    }
                },
                data: {
                    labels: {!! json_encode(array_keys($dataCharts)) !!},
                    datasets: [
                    {
                        barThickness: 15,
                        data: {!! json_encode(array_values($dataCharts)) !!},
                        backgroundColor: successColorShade,
                        borderColor: 'transparent'
                    }
                    ]
                }
                });
            }
        });
    </script>
@endsection