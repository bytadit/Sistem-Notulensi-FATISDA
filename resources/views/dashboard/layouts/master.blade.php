<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Minute - Sistem Notulensi Rapat FATISDA UNS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
    @livewireStyles
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    @include('layouts.head-css')
</head>

@section('body')
    @include('dashboard.layouts.body')
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('dashboard.layouts.topbar')
        @include('dashboard.layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('dashboard.layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    {{-- @include('dashboard.layouts.customizer') --}}

    <!-- JAVASCRIPT -->
    @livewireScripts
    @stack('scripts')
    @include('layouts.vendor-scripts')
</body>
</html>
