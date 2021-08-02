@extends('layouts.backend.app')
@section('title', 'Dashboard')
@section('content')
    <!-- push external head elements to head -->
    @push('head')

        <link rel="stylesheet" href="{{ asset('assets/backend/plugins/weather-icons/css/weather-icons.min.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/backend/plugins/chartist/dist/chartist.min.css') }}">
    @endpush

    <div class="container-fluid">
        <div class="row">
            <!-- page statustic chart start -->
            <div class="col-xl-3 col-md-6">
                <div class="card card-red text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('2,563')}}</h4>
                                <p class="mb-0">{{ __('Products')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="fas fa-cube f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart1" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-blue text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('3,612')}}</h4>
                                <p class="mb-0">{{ __('Orders')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-shopping-cart f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart2" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-green text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('865')}}</h4>
                                <p class="mb-0">{{ __('Customers')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik ik-user f-30"></i>
                            </div>
                        </div>
                        <div id="Widget-line-chart3" class="chart-line chart-shadow"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card card-yellow text-white">
                    <div class="card-block">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-0">{{ __('35,500')}}</h4>
                                <p class="mb-0">{{ __('Sales')}}</p>
                            </div>
                            <div class="col-4 text-right">
                                <i class="ik f-30">৳</i>
                            </div>
                        </div>
                        <div id="Widget-line-chart4" class="chart-line chart-shadow" ></div>
                    </div>
                </div>
            </div>
            <!-- page statustic chart end -->
        </div>
    </div>



        <!-- push external js -->
        @push('script')
{{--            <script type="text/javascript">--}}
{{--                var API_URL = "{{ route('frontend.home') }}";--}}

{{--                var globalVariable = {--}}
{{--                    bmi: {{ $user->fitnessProfile->bmi }}--}}
{{--                };--}}

{{--                //             // Set up data source--}}
{{--                //             $.get(API_URL + '/fitness/weight').then(function (response) {--}}
{{--                //                 console.log(response);--}}
{{--                // // Display the array elements--}}
{{--                //                 chart.data = response;--}}


{{--            </script>--}}






            {{--        for new amcharts v4--}}
{{--            <script src="{{ asset('assets/backend/plugins/amcharts/amcharts4/core.js') }}"></script>--}}
{{--            <script src="{{ asset('assets/backend/plugins/amcharts/amcharts4/charts.js') }}"></script>--}}
{{--            <script src="{{ asset('assets/backend/plugins/amcharts/amcharts4/themes/animated.js') }}"></script>--}}




{{--            <script src="{{ asset('assets/backend/js/widget-chart.js') }}"></script>--}}
{{--            <script src="{{ asset('assets/backend/js/widget-statistic.js') }}"></script>--}}
{{--            --}}{{--        <script src="{{ asset('assets/backend/js/chart-amcharts.js') }}"></script>--}}

{{--            <script src="{{ asset('assets/backend/js/amchart_custom.js') }}"></script>--}}


        @endpush

@endsection
