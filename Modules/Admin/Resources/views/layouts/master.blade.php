<!doctype html>
<html  lang="ar">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | {{config('app.name', 'Laravel')}} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="sa3d01" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico')}}">
    @include('admin::layouts.head')
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;900&display=swap" rel="stylesheet">
    <style>
        body,h4{
            font-family: 'Cairo', serif;
        }

        .button-list{
            display: inline-block;
            margin: 0;
        }
    </style>
</head>

@section('body')
@show
<body data-layout="detached" data-topbar="colored">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- Begin page -->
    <div class="container-fluid">
        <div id="layout-wrapper">
            @include('admin::layouts.topbar')
            @include('admin::layouts.sidebar')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    @yield('content')
                </div>
                <!-- End Page-content -->
                @include('admin::layouts.footer')
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
    </div>
    <!-- END container-fluid -->

    <!-- JAVASCRIPT -->
    @include('admin::layouts.footer-script')
</body>

</html>
