<div>
    @section('title')
        Lihat Rapat
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu User
        @endslot
        @slot('li_2')
            Jadwal Rapat
        @endslot
        @slot('li_2_link')
            {{ route('jadwal-rapat', ['team' => $team]) }}
        @endslot
        @slot('title')
            {{ $judul_rapat }}
        @endslot
        @slot('title_link')
            {{ route('jadwal-rapat.show', ['team' => $team, 'rapat' => $rapat_slug]) }}
        @endslot
        @slot('subtitle')
            Notulensi
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-12">
            @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card mt-n4 mx-n4">
                <div class="bg-soft-warning">
                    <div class="card-body pb-0 px-4">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="row align-items-center g-3">
                                    <div class="col-md">
                                        <div>
                                            <h4 class="fw-bold">Notulensi {{ $judul_rapat }}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div><i class="ri-building-line align-bottom me-1"></i> {{ $team_nama }}
                                                </div>
                                                <div class="vr"></div>
                                                <div><span class="fw-medium">{{ Carbon\Carbon::parse($waktu_mulai)->format('d F, Y h:i') . ' WIB - ' . Carbon\Carbon::parse($waktu_selesai)->format('d F, Y h:i') . ' WIB'  }}</span></div>
                                                <div class="vr"></div>
                                                <div class="badge rounded-pill fs-12 bg-white text-dark
                                                    ">
                                                    {{ $kategori_rapat }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-auto">
                                <div class="hstack gap-1 flex-wrap">
                                    <button type="button" class="btn py-0 fs-16 favourite-btn active shadow-none"
                                            data-toggle="favorite" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tandai Rapat">
                                        <i class="ri-star-fill"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content text-muted">
                <div class="tab-pane fade show active" id="project-overview" role="tabpanel">
                    <div class="row">
                        <form wire:submit.prevent="updateNotulensi">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-muted">
                                            <h6 class="mb-3 fw-semibold text-uppercase">Hasil Rapat</h6>
                                            <div class="mb-3">
                                                <div wire:ignore>
                                                <textarea wire:model='hasil_rapat' name="hasil_rapat" type="text" id="hasil_rapat"
                                                          placeholder="Masukkan Hasil Rapat">
                                                    {!! $hasil_rapat !!}
                                                </textarea>
                                                </div>
                                                @error('deskripsi')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-muted">
                                            <h6 class="mb-3 fw-semibold text-uppercase">Catatan Rapat</h6>
                                            <div class="mb-3">
                                                <div wire:ignore>
                                                <textarea wire:model='catatan' name="catatan" type="text" id="catatan"
                                                          placeholder="Masukkan Catatan Rapat">
                                                    {!! $catatan !!}
                                                </textarea>
                                                </div>
                                                @error('deskripsi')
                                                <span class="text-danger text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <div class="col-12 text-end mb-4">
                                    {{-- <button type="button" class="btn btn-danger w-sm">Delete</button> --}}
                                    <button type="button" class="btn btn-secondary w-sm">Draft</button>
                                    <button type="submit" class="btn btn-success w-sm">Ubah</button>
                                </div>
                                <!-- end card -->
                                <!-- end card -->
                            </div>
                        </form>
                        <!-- ene col -->

                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
    <!-- Modal -->
    <!-- end modal -->
    @push('scripts')
        <script src="{{ URL::asset('assets/js/pages/project-overview.init.js') }}"></script>
    @endpush
    @push('scripts')
        <script>
            ClassicEditor
                .create(document.querySelector('#hasil_rapat'))
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                    @this.set('hasil_rapat', editor.getData());
                    })
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
    @push('scripts')
        <script>
            ClassicEditor
                .create(document.querySelector('#catatan'))
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                    @this.set('catatan', editor.getData());
                    })
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</div>
