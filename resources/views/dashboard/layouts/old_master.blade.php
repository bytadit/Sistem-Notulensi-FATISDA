<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Minute - Sistem Notulensi Rapat FATISDA UNS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
    @include('layouts.head-css')
    @livewireStyles
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
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
    @stack('scripts')
    @include('layouts.vendor-scripts')
    <script type='text/javascript' src='{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}'></script>
    {{-- <script src="{{ URL::asset('assets/js/app.min.js') }}"></script> --}}
    <script type='text/javascript' src='{{ URL::asset('assets/libs/choices.js/choices.js.min.js') }}'></script>
    <script src="{{ URL::asset('assets/libs/@ckeditor/@ckeditor.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-editor.init.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/quill/quill.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/app.min.js') }}"></script>
    @livewireScripts
</body>
</html>
