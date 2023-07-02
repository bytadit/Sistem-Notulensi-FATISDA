<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $title }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link src="{{ asset('assets/js/home/home.css') }}" media="all" rel="stylesheet" type="text/css" />
    <link src="{{ asset('assets/css/ltr/bootstrap.min.css') }}" media="all" rel="stylesheet" type="text/css" />
    <script src="{{ asset('assets/js/home/home.js') }}"></script>
    <link rel="stylesheet" media="screen" href="https://cdnb.uns.ac.id/pbj/public/assets/front/css/theme.min.css">
    <style>
        .page-loading {
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            -webkit-transition: all .4s .2s ease-in-out;
            transition: all .4s .2s ease-in-out;
            background-color: #fff;
            opacity: 0;
            visibility: hidden;
            z-index: 9999;
        }

        .page-loading.active {
            opacity: 1;
            visibility: visible;
        }

        .page-loading-inner {
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            text-align: center;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            -webkit-transition: opacity .2s ease-in-out;
            transition: opacity .2s ease-in-out;
            opacity: 0;
        }

        .page-loading.active>.page-loading-inner {
            opacity: 1;
        }

        .page-loading-inner>span {
            display: block;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: normal;
            color: #737491;
        }

        .page-spinner {
            display: inline-block;
            width: 2.75rem;
            height: 2.75rem;
            margin-bottom: .75rem;
            vertical-align: text-bottom;
            border: .15em solid #766df4;
            border-right-color: transparent;
            border-radius: 50%;
            -webkit-animation: spinner .75s linear infinite;
            animation: spinner .75s linear infinite;
        }

        @-webkit-keyframes spinner {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes spinner {
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
    </style>
    <script>
        (function() {
            window.onload = function() {
                var preloader = document.querySelector('.page-loading');
                preloader.classList.remove('active');
                setTimeout(function() {
                    preloader.remove();
                }, 2000);
            };
        })();
    </script>
</head>

<body>
<div class="page-loading active">
    <div class="page-loading-inner">
        <div class="page-spinner"></div><span>Memuat...</span>
    </div>
</div>
<div class="page-wrapper" id="page-wrapper">
    <header class="header navbar navbar-expand-lg navbar-light bg-light navbar-shadow navbar-sticky"
            data-scroll-header="" data-fixed-element="">
        <div class="container px-0 px-xl-3">
            <a class="navbar-brand flex-shrink-0 order-lg-1 ms-lg-0 pe-lg-2 me-lg-4" href="/">
                Minot
            </a>
            @if (Auth::check())
                <div class="d-flex align-items-center order-lg-3 ms-lg-auto">
                    <a class="btn btn-info ms-grid-gutter d-none d-lg-inline-block" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </div>
            @else
                <div class="d-flex align-items-center order-lg-3 ms-lg-auto">
                    <a class="nav-link-style fs-sm text-nowrap" href="{{ route('login') }}">
                        <i class="ai-user fs-xl me-2"></i>
                        Masuk
                    </a>
                    <a class="btn btn-info ms-grid-gutter d-none d-sm-inline-block"
                       href="{{ route('register') }}">Daftar</a>
                </div>
            @endif
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <script src="https://cdnb.uns.ac.id/pbj/public/assets/front/js/theme.min.js"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
</body>

</html>
