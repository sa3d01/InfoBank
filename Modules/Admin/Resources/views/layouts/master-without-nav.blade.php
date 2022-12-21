<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title> @yield('title') | {{config('app.name', 'Laravel')}} </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="sa3d01" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico')}}">
        @include('admin::layouts.head')
  </head>
    @yield('body')

    @yield('content')

    @include('admin::layouts.footer-script')
    </body>
</html>
