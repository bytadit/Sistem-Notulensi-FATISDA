<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light">

    <head>
    <meta charset="utf-8" />
    <title>@yield('title') | Minot - Sistem Notulensi Rapat FATISDA UNS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @livewireStyles
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico')}}">
        @include('layouts.head-css')
  </head>

    @yield('body')

    @yield('content')
    @livewireScripts
    @include('layouts.vendor-scripts')
    </body>
</html>
