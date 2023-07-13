<div class="col-12">
    @section('title')
        Halaman Dashboard
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Dashboard
        @endslot
        @slot('title')
            Halaman Utama
        @endslot
    @endcomponent
    <div class="row">
        <h1>Selamat Datang {{ auth()->user()->name }}</h1>
    </div>
</div>
