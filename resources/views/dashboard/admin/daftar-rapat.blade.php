@extends('layouts.dashboard')
@section('title')
Daftar Rapat
@endsection
{{-- @section('css')
    <link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />
@endsection --}}
@section('content')
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu Admin
        @endslot
        @slot('title')
            Daftar Rapat
        @endslot
    @endcomponent
    <div class="row">
        <livewire:daftar-rapat-index></livewire:daftar-rapat-index>
    </div>
@endsection

{{-- @section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/swiper/swiper.min.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

@endsection --}}
