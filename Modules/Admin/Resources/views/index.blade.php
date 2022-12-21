@extends('admin::layouts.master')

@section('title') لوحة التحكم @endsection

@section('content')

    @component('admin::common-components.breadcrumb')
        @slot('title') لوحة التحكم   @endslot
        @slot('title_li') مرحبا بك في {{config('app.name', 'Laravel')}} لوحة التحكم   @endslot
    @endcomponent

    <div class="row ">
        <div>

            @component('admin::common-components.dashboard-widget')

                @slot('title') الاثراءات   @endslot
                @slot('iconClass') mdi mdi-film  @endslot
                @slot('price') {{\Modules\Enrichment\Entities\Enrichment::count()}}  @endslot
                @slot('percentage') {{\Modules\Enrichment\Entities\Enrichment::count()}}   @endslot
                @slot('pClass') progress-bar bg-primary   @endslot
                @slot('pValue') 100   @endslot

            @endcomponent

            @component('admin::common-components.dashboard-widget')

                @slot('title') طلبات الاحتياج التجريبي   @endslot
                @slot('iconClass') mdi mdi-application-import  @endslot
                @slot('price') {{\Modules\Need\Entities\Need::where('status','binding')->count()}}  @endslot
                @slot('percentage') {{\Modules\Need\Entities\Need::count()}}   @endslot
                @slot('pClass') progress-bar bg-primary   @endslot
                @slot('pValue') 100   @endslot

            @endcomponent


        </div>

{{--        <div class="col-xl-9">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h4 class="card-title mb-4">مشاهدات الطلاب</h4>--}}

{{--                    <div id="line-chart" class="apex-charts"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>
    <!-- end row -->

{{--    <div class="row">--}}
{{--        <div class="col-xl-5">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h4 class="card-title mb-4">تحليل الاشتراكات</h4>--}}

{{--                    <div class="row align-items-center">--}}
{{--                        <div class="col-sm-12">--}}
{{--                            <div id="donut-chart" class="apex-charts"></div>--}}
{{--                        </div>--}}
{{--                        <div class="col-sm-12">--}}
{{--                            <div>--}}
{{--                                <div class="row">--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}


{{--        <div class="col-xl-7">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h4 class="card-title mb-4">آراء الطلاب</h4>--}}
{{--                    <div class="mb-3">--}}
{{--                        <i class="fas fa-quote-left h4 text-primary"></i>--}}
{{--                    </div>--}}
{{--                    <div id="reviewExampleControls" class="carousel slide review-carousel" data-ride="carousel">--}}

{{--                        <div class="carousel-inner">--}}
{{--                            <div class="carousel-item active">--}}
{{--                                <div>--}}
{{--                                    <p>ممتاز جدا</p>--}}
{{--                                    <div class="media mt-4">--}}
{{--                                        <div class="avatar-sm mr-3">--}}
{{--                                                            <span class="avatar-title bg-soft-primary text-primary rounded-circle">--}}
{{--                                                                    J--}}
{{--                                                                </span>--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h5 class="font-size-16 mb-1">جيهان السادات</h5>--}}
{{--                                            <p class="mb-2">Accounting course</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="carousel-item">--}}
{{--                                <div>--}}
{{--                                    <p>محتوي رائع</p>--}}
{{--                                    <div class="media mt-4">--}}
{{--                                        <div class="avatar-sm mr-3">--}}
{{--                                            <img src="images/users/avatar-4.jpg" alt="" class="img-fluid rounded-circle">--}}
{{--                                        </div>--}}
{{--                                        <div class="media-body">--}}
{{--                                            <h5 class="font-size-16 mb-1">مريم حسام</h5>--}}
{{--                                            <p class="mb-2">Accounting course</p>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                        </div>--}}

{{--                        <a class="carousel-control-prev" href="#reviewExampleControls" role="button" data-slide="prev">--}}
{{--                            <i class="mdi mdi-chevron-left carousel-control-icon"></i>--}}
{{--                        </a>--}}
{{--                        <a class="carousel-control-next" href="#reviewExampleControls" role="button" data-slide="next">--}}
{{--                            <i class="mdi mdi-chevron-right carousel-control-icon"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}


@endsection

@section('script')
    <!-- plugin js -->
    <script src="{{ URL::asset('libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- jquery.vectormap map -->
{{--    <script src="{{ URL::asset('libs/jquery-vectormap/jquery-vectormap.min.js')}}"></script>--}}

    <!-- Calendar init -->
    <script src="{{ URL::asset('js/pages/dashboard.init.js')}}"></script>
@endsection
