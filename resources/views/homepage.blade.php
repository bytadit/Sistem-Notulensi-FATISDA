@extends('layouts.non-dashboard')
@section('content')
    <div class="">
        <div class="container min-vh-100 d-flex align-items-center">
            <div class="row d-flex align-items-center">
                <div class="col-md-6 mb-5">
                    <img src="{{ asset('assets/images/meeting2.png') }}" alt="" class="m-auto">
                </div>
                <div class="col-md-6">
                    <h2 class="mb-0">Selamat Datang di Aplikasi MINOT</h2>
                    <h5 class="fw-normal">Aplikasi Sistem Notulensi Rapat FATISDA</h5>
                </div>
            </div>
        </div>
        <footer class="footer bg-dark pt-5 pt-md-6">

            <div class="bg-darker py-4 py-md-3">
                <div class="container d-md-flex align-items-center justify-content-between pt-3">
                    <div class="d-flex flex-wrap align-item-center order-md-1">
                        <p class="fs-sm pt-2 mb-3"><span class="text-light opacity-50 me-1">© All rights reserved.
                                2021 - 2023</span><a class="nav-link-style nav-link-light" href="https://fatisda.uns.ac.id"
                                                     target="_blank" rel="noopener">FATISDA UNS</a>
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
