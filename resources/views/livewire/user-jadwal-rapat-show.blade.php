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
    @endcomponent

        @if($dokumentasiUpdate)
            {{-- modal update --}}
            <livewire:dokumentasi-edit></livewire:dokumentasi-edit>
        @else
            {{-- modal create --}}
            <livewire:dokumentasi-create></livewire:dokumentasi-create>
        @endif

        {{-- modal delete --}}
        <div wire:ignore.self class="modal fade" id="modalDeleteDokumentasi" tabindex="-1" aria-labelledby="modalDeleteDokumentasiLabel" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeleteDokumentasiLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                        <h6>Apakah yakin ingin menghapus Dokumen <strong>{{ $dokumentasi_old }}</strong> ?</h6>
                    </div>
                    <div class="modal-footer">
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button wire:click='cancel()'type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button wire:click='deleteDokumentasi()'type="submit" class="btn btn-primary">Yakin</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal delete --}}
    <div class="row">
        <div class="col-12">
            <div class="card mt-n4 mx-n4">
                <div class="bg-soft-warning">
                    <div class="card-body pb-0 px-4">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="row align-items-center g-3">
                                    {{-- <div class="col-md-auto">
                                        <div class="avatar-md">
                                            <div class="avatar-title bg-white rounded-circle">
                                                <img src="{{ URL::asset('assets/images/brands/slack.png') }}"
                                                    alt="" class="avatar-xs">
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md">
                                        <div>
                                            <h4 class="fw-bold">{{ $judul_rapat }}</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div><i class="ri-building-line align-bottom me-1"></i> {{ $team_nama }}
                                                </div>
                                                <div class="vr"></div>
                                                <div><span class="fw-medium">{{ $waktu_mulai . ' WIB'. ' s/d ' . $waktu_selesai . ' WIB'  }}</span></div>
                                                {{-- <div class="vr"></div> --}}
                                                {{-- <div>Waktu Selesai : <span class="fw-medium">{{ Carbon\Carbon::parse($waktu_selesai)->format('d F, Y h:i') . ' WIB' }}</span></div> --}}
                                                <div class="vr"></div>
                                                <div class="badge rounded-pill fs-12 bg-white text-dark
                                                    {{-- @if ($status_rapat == 0)
                                                            bg-primary
                                                        @elseif ($status_rapat == 1)
                                                            bg-success
                                                        @elseif ($status_rapat == 2)
                                                            bg-dark
                                                        @endif --}}
                                                    ">
                                                    {{-- @if ($status_rapat == 0)
                                                        Dijadwalkan
                                                    @elseif ($status_rapat == 1)
                                                        Berlangsung
                                                    @elseif ($status_rapat == 2)
                                                        Selesai
                                                    @endif --}}
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
                                    {{-- @role('administrator') --}}
{{--                                    <a type="button" href="{{ route('daftar-rapat.edit', ['team'=>$team, 'rapat'=>$rapat_slug]) }}" class="btn py-0 fs-16 text-body shadow-none"--}}
{{--                                       data-toggle="edit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ubah Rapat">--}}
{{--                                        <i class="ri-edit-box-fill"></i>--}}
{{--                                    </a>--}}
                                    {{-- @endrole --}}
                                    {{-- <button type="button" class="btn py-0 fs-16 text-body shadow-none"
                                        data-toggle="delete" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus Rapat">
                                        <i class="ri-delete-bin-fill"></i>
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs-custom border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#detail-rapat"
                                   role="tab">
                                    Detail
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#notulensi"
                                   role="tab">
                                    Notulensi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#dokumentasi"
                                   role="tab">
                                    Dokumentasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#presensi"
                                   role="tab">
                                    Presensi
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    <!-- end row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="tab-content text-muted">
                <div class="tab-pane fade show active" id="detail-rapat" role="tabpanel">
                    <div class="row">
                        <div class="col-xl-9 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted">
                                        <h6 class="mb-3 fw-semibold text-uppercase">Deskripsi Rapat</h6>
                                        {!! $deskripsi !!}
                                        {{-- <div>
                                            <button type="button"
                                                class="btn btn-link link-success p-0 shadow-none">Read
                                                more</button>
                                        </div> --}}

                                        <div class="pt-3 border-top border-top-dashed mt-4">
                                            <div class="row">

                                                {{-- <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <p class="mb-2 text-uppercase fw-medium">Create Date :</p>
                                                        <h5 class="fs-15 mb-0">15 Sep, 2021</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <p class="mb-2 text-uppercase fw-medium">Due Date :</p>
                                                        <h5 class="fs-15 mb-0">29 Dec, 2021</h5>
                                                    </div>
                                                </div> --}}
                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <p class="mb-2 text-uppercase fw-medium">Prioritas :</p>
                                                        <div class="badge fs-12
                                                            @if ($prioritas == 1)
                                                                bg-success
                                                            @elseif ($prioritas == 2)
                                                                bg-warning
                                                            @elseif ($prioritas == 3)
                                                                bg-danger
                                                            @endif
                                                        ">
                                                            @if ($prioritas == 1)
                                                                Rendah
                                                            @elseif ($prioritas == 2)
                                                                Sedang
                                                            @elseif ($prioritas == 3)
                                                                Tinggi
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div>
                                                        <p class="mb-2 text-uppercase fw-medium">Status :</p>
                                                        <div class="badge fs-12
                                                            @if ($status_rapat == 0)
                                                                bg-primary
                                                            @elseif ($status_rapat == 1)
                                                                bg-success
                                                            @elseif ($status_rapat == 2)
                                                                bg-dark
                                                            @endif
                                                        ">
                                                            @if ($status_rapat == 0)
                                                                Dijadwalkan
                                                            @elseif ($status_rapat == 1)
                                                                Berlangsung
                                                            @elseif ($status_rapat == 2)
                                                                Selesai
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="pt-3 border-top border-top-dashed mt-4">
                                            <h6 class="mb-3 fw-semibold text-uppercase">Resources</h6>
                                            <div class="row g-3">
                                                <div class="col-xxl-4 col-lg-6">
                                                    <div class="border rounded border-dashed p-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-light text-secondary rounded fs-24 shadow">
                                                                        <i class="ri-folder-zip-line"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <h5 class="fs-13 mb-1"><a href="#"
                                                                        class="text-body text-truncate d-block">App
                                                                        pages.zip</a></h5>
                                                                <div>2.2MB</div>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="d-flex gap-1">
                                                                    <button type="button"
                                                                        class="btn btn-icon text-muted btn-sm fs-18 shadow-none"><i
                                                                            class="ri-download-2-line"></i></button>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-icon text-muted btn-sm fs-18 dropdown shadow-none"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="ri-more-fill"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item"
                                                                                    href="#"><i
                                                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    Rename</a></li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="#"><i
                                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    Delete</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                                <div class="col-xxl-4 col-lg-6">
                                                    <div class="border rounded border-dashed p-2">
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-3">
                                                                <div class="avatar-sm">
                                                                    <div
                                                                        class="avatar-title bg-light text-secondary rounded fs-24 shadow">
                                                                        <i class="ri-file-ppt-2-line"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1 overflow-hidden">
                                                                <h5 class="fs-13 mb-1"><a href="#"
                                                                        class="text-body text-truncate d-block">Velzon
                                                                        admin.ppt</a></h5>
                                                                <div>2.4MB</div>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="d-flex gap-1">
                                                                    <button type="button"
                                                                        class="btn btn-icon text-muted btn-sm fs-18 shadow-none"><i
                                                                            class="ri-download-2-line"></i></button>
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn btn-icon text-muted btn-sm fs-18 dropdown shadow-none"
                                                                            type="button" data-bs-toggle="dropdown"
                                                                            aria-expanded="false">
                                                                            <i class="ri-more-fill"></i>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item"
                                                                                    href="#"><i
                                                                                        class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                                    Rename</a></li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="#"><i
                                                                                        class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                                    Delete</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                        </div> --}}
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Komentar</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#"
                                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{-- <span class="text-muted">Recent<i
                                                        class="mdi mdi-chevron-down ms-1"></i></span> --}}
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Recent</a>
                                                <a class="dropdown-item" href="#">Top Rated</a>
                                                <a class="dropdown-item" href="#">Previous</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">

                                    <div data-simplebar style="height: 300px;" class="px-3 mx-n3 mb-2">
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('assets/images/users/avatar-8.jpg') }}"
                                                     alt="" class="avatar-xs rounded-circle shadow" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-13">Joseph Parker <small class="text-muted ms-2">20
                                                        Dec 2021 - 05:47AM</small></h5>
                                                <p class="text-muted">I am getting message from customers that when
                                                    they place order always get error message .</p>
                                                <a href="javascript: void(0);" class="badge text-muted bg-light"><i
                                                        class="mdi mdi-reply"></i> Reply</a>
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ URL::asset('assets/images/users/avatar-10.jpg') }}"
                                                             alt="" class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-13">Alexis Clarke <small
                                                                class="text-muted ms-2">22 Dec 2021 - 02:32PM</small>
                                                        </h5>
                                                        <p class="text-muted">Please be sure to check your Spam mailbox
                                                            to see if your email filters have identified the email from
                                                            Dell
                                                            as spam.</p>
                                                        <a href="javascript: void(0);"
                                                           class="badge text-muted bg-light"><i
                                                                class="mdi mdi-reply"></i> Reply</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('assets/images/users/avatar-6.jpg') }}"
                                                     alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-13">Donald Palmer <small class="text-muted ms-2">24
                                                        Dec 2021 - 05:20PM</small></h5>
                                                <p class="text-muted">If you have further questions, please contact
                                                    Customer Support from the “Action Menu” on your <a
                                                        href="javascript:void(0);"
                                                        class="text-decoration-underline">Online
                                                        Order Support</a>.</p>
                                                <a href="javascript: void(0);" class="badge text-muted bg-light"><i
                                                        class="mdi mdi-reply"></i> Reply</a>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('assets/images/users/avatar-10.jpg') }}"
                                                     alt="" class="avatar-xs rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h5 class="fs-13">Alexis Clarke <small class="text-muted ms-2">26
                                                        min ago</small></h5>
                                                <p class="text-muted">Your <a href="javascript:void(0)"
                                                                              class="text-decoration-underline">Online Order Support</a>
                                                    provides
                                                    you with the most current status of your order. To help manage your
                                                    order refer to the “Action Menu” to initiate return, contact
                                                    Customer
                                                    Support and more.</p>
                                                <div class="row g-2 mb-3">
                                                    <div class="col-lg-1 col-sm-2 col-6">
                                                        <img src="{{ URL::asset('assets/images/small/img-4.jpg') }}"
                                                             alt="" class="img-fluid rounded">
                                                    </div>
                                                    <div class="col-lg-1 col-sm-2 col-6">
                                                        <img src="{{ URL::asset('assets/images/small/img-5.jpg') }}"
                                                             alt="" class="img-fluid rounded">
                                                    </div>
                                                </div>
                                                <a href="javascript: void(0);" class="badge text-muted bg-light"><i
                                                        class="mdi mdi-reply"></i> Reply</a>
                                                <div class="d-flex mt-4">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ URL::asset('assets/images/users/avatar-6.jpg') }}"
                                                             alt="" class="avatar-xs rounded-circle" />
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-13">Donald Palmer <small
                                                                class="text-muted ms-2">8 sec ago</small></h5>
                                                        <p class="text-muted">Other shipping methods are available at
                                                            checkout if you want your purchase delivered faster.</p>
                                                        <a href="javascript: void(0);"
                                                           class="badge text-muted bg-light"><i
                                                                class="mdi mdi-reply"></i> Reply</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form class="mt-4">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="exampleFormControlTextarea1"
                                                       class="form-label text-body">Berikan Komentar</label>
                                                <textarea class="form-control bg-light border-light" id="exampleFormControlTextarea1" rows="3"
                                                          placeholder="Masukkan komentar..."></textarea>
                                            </div>
                                            <div class="col-12 text-end">
                                                <button type="button"
                                                        class="btn btn-ghost-secondary btn-icon waves-effect me-1 shadow-none"><i
                                                        class="ri-attachment-line fs-16"></i></button>
                                                <a href="javascript:void(0);" class="btn btn-success">Kirim</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- ene col -->
                        <div class="col-xl-3 col-lg-4">
                            <div class="card">
                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                    <h5 class="card-title mb-0 flex-grow-1">Topik Rapat</h5>
                                </div>
                                <div class="card-body">
                                    {{-- <h5 class="card-title mb-4">Topik Rapat</h5> --}}
                                    <div class="d-flex flex-wrap gap-2 fs-16">
                                        <h6 class="fw-medium">{{ $topik_rapat }}</h6>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <div class="card">
                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                    <h5 class="card-title mb-0 flex-grow-1">Lokasi Rapat</h5>
                                </div>
                                <div class="card-body">
                                    {{-- <h5 class="card-title mb-4">Topik Rapat</h5> --}}
                                    <div class="d-flex flex-wrap gap-2 fs-16">
                                        <h6 class="fw-medium">{{ $lokasi_rapat }}</h6>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <div class="card">
                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                    <h5 class="card-title mb-0 flex-grow-1">Penganggung Jawab Rapat</h5>
                                </div>
                                <div class="card-body">
                                    {{-- <h5 class="card-title mb-4">Topik Rapat</h5> --}}
                                    <div class="d-flex flex-wrap gap-2 fs-16">
                                        <h6 class="fw-medium">{{ $users->where('id',$pegawais->where('id',$jabatan_pegawais->where('id', $penanggung_jawab)->first()->id_pegawai)->first()->id_user)->first()->name }}</h6>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <div class="card">
                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                    <h5 class="card-title mb-0 flex-grow-1">Notulis Rapat</h5>
                                </div>
                                <div class="card-body">
                                    {{-- <h5 class="card-title mb-4">Topik Rapat</h5> --}}
                                    <div class="d-flex flex-wrap gap-2 fs-16">
                                        <h6 class="fw-medium">{{ $users->where('id',$pegawais->where('id',$jabatan_pegawais->where('id', $notulis)->first()->id_pegawai)->first()->id_user)->first()->name }}</h6>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            <div class="card">
                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                    <h4 class="card-title mb-0 flex-grow-1">Peserta Rapat</h4>
{{--                                    <div class="flex-shrink-0">--}}
{{--                                        <a href="{{ route('rapat-members', ['team' => $team, 'rapat' => $rapat_slug]) }}"type="button" class="btn btn-soft-danger btn-sm shadow-none">--}}
{{--                                            <i class="ri-share-line me-1 align-bottom"></i>--}}
{{--                                            Tambah Anggota--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
                                </div>

                                <div class="card-body">
                                    <div data-simplebar class="mx-n3 px-3">
                                        <div class="vstack gap-3">
                                            @foreach ($members as $member)
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-xs flex-shrink-0 me-3">
                                                        <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}"
                                                             alt="" class="img-fluid rounded-circle">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h5 class="fs-13 mb-0"><a href="#"
                                                                                  class="text-body d-block">{{ $users->where('id',$pegawais->where('id', $member->id_pegawai)->first()->id_user)->first()->name }}</a></h5>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- end list -->
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                            {{-- attach,ment card --}}
                            {{-- <div class="card">
                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                    <h4 class="card-title mb-0 flex-grow-1">Attachments</h4>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-soft-info btn-sm shadow-none"><i
                                                class="ri-upload-2-fill me-1 align-bottom"></i> Upload</button>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div class="vstack gap-2">
                                        <div class="border rounded border-dashed p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-light text-secondary rounded fs-24 shadow">
                                                            <i class="ri-folder-zip-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="fs-13 mb-1"><a href="#"
                                                            class="text-body text-truncate d-block">App-pages.zip</a>
                                                    </h5>
                                                    <div>2.2MB</div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <div class="d-flex gap-1">
                                                        <button type="button"
                                                            class="btn btn-icon text-muted btn-sm fs-18 shadow-none"><i
                                                                class="ri-download-2-line"></i></button>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-icon text-muted btn-sm fs-18 dropdown shadow-none"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Rename</a></li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                        Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border rounded border-dashed p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-light text-secondary rounded fs-24 shadow">
                                                            <i class="ri-file-ppt-2-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="fs-13 mb-1"><a href="#"
                                                            class="text-body text-truncate d-block">Velzon-admin.ppt</a>
                                                    </h5>
                                                    <div>2.4MB</div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <div class="d-flex gap-1">
                                                        <button type="button"
                                                            class="btn btn-icon text-muted btn-sm fs-18 shadow-none"><i
                                                                class="ri-download-2-line"></i></button>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-icon text-muted btn-sm fs-18 dropdown shadow-none"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Rename</a></li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                        Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border rounded border-dashed p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-light text-secondary rounded fs-24 shadow">
                                                            <i class="ri-folder-zip-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="fs-13 mb-1"><a href="#"
                                                            class="text-body text-truncate d-block">Images.zip</a></h5>
                                                    <div>1.2MB</div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <div class="d-flex gap-1">
                                                        <button type="button"
                                                            class="btn btn-icon text-muted btn-sm fs-18 shadow-none"><i
                                                                class="ri-download-2-line"></i></button>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-icon text-muted btn-sm fs-18 dropdown shadow-none"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Rename</a></li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                        Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border rounded border-dashed p-2">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-sm">
                                                        <div
                                                            class="avatar-title bg-light text-secondary rounded fs-24 shadow">
                                                            <i class="ri-image-2-line"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="fs-13 mb-1"><a href="#"
                                                            class="text-body text-truncate d-block">bg-pattern.png</a>
                                                    </h5>
                                                    <div>1.1MB</div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <div class="d-flex gap-1">
                                                        <button type="button"
                                                            class="btn btn-icon text-muted btn-sm fs-18 shadow-none"><i
                                                                class="ri-download-2-line"></i></button>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-icon text-muted btn-sm fs-18 dropdown shadow-none"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                <i class="ri-more-fill"></i>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                                                        Rename</a></li>
                                                                <li><a class="dropdown-item" href="#"><i
                                                                            class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>
                                                                        Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-2 text-center">
                                            <button type="button" class="btn btn-success">View more</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div> --}}
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end tab pane -->
{{--                <div class="tab-pane fade" id="dokumentasi" role="tabpanel">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex align-items-center mb-4">--}}
{{--                                <h5 class="card-title flex-grow-1">Dokumentasi Rapat</h5>--}}
{{--                            </div>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-12">--}}
{{--                                    <div class="table-responsive table-card">--}}
{{--                                        <table class="table table-borderless align-middle mb-0">--}}
{{--                                            <thead class="table-light">--}}
{{--                                            <tr>--}}
{{--                                                <th scope="col">File Name</th>--}}
{{--                                                <th scope="col">Type</th>--}}
{{--                                                <th scope="col">Size</th>--}}
{{--                                                <th scope="col">Upload Date</th>--}}
{{--                                                <th scope="col" style="width: 120px;">Action</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="avatar-sm">--}}
{{--                                                            <div--}}
{{--                                                                class="avatar-title bg-light text-secondary rounded fs-24 shadow">--}}
{{--                                                                <i class="ri-folder-zip-line"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="ms-3 flex-grow-1">--}}
{{--                                                            <h5 class="fs-14 mb-0"><a href="javascript:void(0)"--}}
{{--                                                                                      class="text-dark">Artboard-documents.zip</a>--}}
{{--                                                            </h5>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>Zip File</td>--}}
{{--                                                <td>4.57 MB</td>--}}
{{--                                                <td>12 Dec 2021</td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="dropdown">--}}
{{--                                                        <a href="javascript:void(0);"--}}
{{--                                                           class="btn btn-soft-secondary btn-sm btn-icon shadow-none"--}}
{{--                                                           data-bs-toggle="dropdown" aria-expanded="true">--}}
{{--                                                            <i class="ri-more-fill"></i>--}}
{{--                                                        </a>--}}
{{--                                                        <ul class="dropdown-menu dropdown-menu-end">--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-eye-fill me-2 align-bottom text-muted"></i>View</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-download-2-fill me-2 align-bottom text-muted"></i>Download</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li class="dropdown-divider"></li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-delete-bin-5-fill me-2 align-bottom text-muted"></i>Delete</a>--}}
{{--                                                            </li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="avatar-sm">--}}
{{--                                                            <div--}}
{{--                                                                class="avatar-title bg-light text-danger rounded fs-24 shadow">--}}
{{--                                                                <i class="ri-file-pdf-fill"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="ms-3 flex-grow-1">--}}
{{--                                                            <h5 class="fs-14 mb-0"><a href="javascript:void(0);"--}}
{{--                                                                                      class="text-dark">Bank Management System</a>--}}
{{--                                                            </h5>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>PDF File</td>--}}
{{--                                                <td>8.89 MB</td>--}}
{{--                                                <td>24 Nov 2021</td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="dropdown">--}}
{{--                                                        <a href="javascript:void(0);"--}}
{{--                                                           class="btn btn-soft-secondary btn-sm btn-icon shadow-none"--}}
{{--                                                           data-bs-toggle="dropdown" aria-expanded="true">--}}
{{--                                                            <i class="ri-more-fill"></i>--}}
{{--                                                        </a>--}}
{{--                                                        <ul class="dropdown-menu dropdown-menu-end">--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-eye-fill me-2 align-bottom text-muted"></i>View</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-download-2-fill me-2 align-bottom text-muted"></i>Download</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li class="dropdown-divider"></li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-delete-bin-5-fill me-2 align-bottom text-muted"></i>Delete</a>--}}
{{--                                                            </li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="avatar-sm">--}}
{{--                                                            <div--}}
{{--                                                                class="avatar-title bg-light text-secondary rounded fs-24 shadow">--}}
{{--                                                                <i class="ri-video-line"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="ms-3 flex-grow-1">--}}
{{--                                                            <h5 class="fs-14 mb-0"><a href="javascript:void(0);"--}}
{{--                                                                                      class="text-dark">Tour-video.mp4</a></h5>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>MP4 File</td>--}}
{{--                                                <td>14.62 MB</td>--}}
{{--                                                <td>19 Nov 2021</td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="dropdown">--}}
{{--                                                        <a href="javascript:void(0);"--}}
{{--                                                           class="btn btn-soft-secondary btn-sm btn-icon shadow-none"--}}
{{--                                                           data-bs-toggle="dropdown" aria-expanded="true">--}}
{{--                                                            <i class="ri-more-fill"></i>--}}
{{--                                                        </a>--}}
{{--                                                        <ul class="dropdown-menu dropdown-menu-end">--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-eye-fill me-2 align-bottom text-muted"></i>View</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-download-2-fill me-2 align-bottom text-muted"></i>Download</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li class="dropdown-divider"></li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-delete-bin-5-fill me-2 align-bottom text-muted"></i>Delete</a>--}}
{{--                                                            </li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="avatar-sm">--}}
{{--                                                            <div--}}
{{--                                                                class="avatar-title bg-light text-success rounded fs-24 shadow">--}}
{{--                                                                <i class="ri-file-excel-fill"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="ms-3 flex-grow-1">--}}
{{--                                                            <h5 class="fs-14 mb-0"><a href="javascript:void(0);"--}}
{{--                                                                                      class="text-dark">Account-statement.xsl</a>--}}
{{--                                                            </h5>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>XSL File</td>--}}
{{--                                                <td>2.38 KB</td>--}}
{{--                                                <td>14 Nov 2021</td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="dropdown">--}}
{{--                                                        <a href="javascript:void(0);"--}}
{{--                                                           class="btn btn-soft-secondary btn-sm btn-icon shadow-none"--}}
{{--                                                           data-bs-toggle="dropdown" aria-expanded="true">--}}
{{--                                                            <i class="ri-more-fill"></i>--}}
{{--                                                        </a>--}}
{{--                                                        <ul class="dropdown-menu dropdown-menu-end">--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-eye-fill me-2 align-bottom text-muted"></i>View</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-download-2-fill me-2 align-bottom text-muted"></i>Download</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li class="dropdown-divider"></li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-delete-bin-5-fill me-2 align-bottom text-muted"></i>Delete</a>--}}
{{--                                                            </li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="avatar-sm">--}}
{{--                                                            <div--}}
{{--                                                                class="avatar-title bg-light text-warning rounded fs-24 shadow">--}}
{{--                                                                <i class="ri-folder-fill"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="ms-3 flex-grow-1">--}}
{{--                                                            <h5 class="fs-14 mb-0"><a href="javascript:void(0);"--}}
{{--                                                                                      class="text-dark">Project Screenshots--}}
{{--                                                                    Collection</a></h5>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>Floder File</td>--}}
{{--                                                <td>87.24 MB</td>--}}
{{--                                                <td>08 Nov 2021</td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="dropdown">--}}
{{--                                                        <a href="javascript:void(0);"--}}
{{--                                                           class="btn btn-soft-secondary btn-sm btn-icon shadow-none"--}}
{{--                                                           data-bs-toggle="dropdown" aria-expanded="true">--}}
{{--                                                            <i class="ri-more-fill"></i>--}}
{{--                                                        </a>--}}
{{--                                                        <ul class="dropdown-menu dropdown-menu-end">--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-eye-fill me-2 align-bottom text-muted"></i>View</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-download-2-fill me-2 align-bottom text-muted"></i>Download</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li class="dropdown-divider"></li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-delete-bin-5-fill me-2 align-bottom text-muted"></i>Delete</a>--}}
{{--                                                            </li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            <tr>--}}
{{--                                                <td>--}}
{{--                                                    <div class="d-flex align-items-center">--}}
{{--                                                        <div class="avatar-sm">--}}
{{--                                                            <div--}}
{{--                                                                class="avatar-title bg-light text-danger rounded fs-24 shadow">--}}
{{--                                                                <i class="ri-image-2-fill"></i>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="ms-3 flex-grow-1">--}}
{{--                                                            <h5 class="fs-14 mb-0"><a href="javascript:void(0);"--}}
{{--                                                                                      class="text-dark">Velzon-logo.png</a></h5>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                                <td>PNG File</td>--}}
{{--                                                <td>879 KB</td>--}}
{{--                                                <td>02 Nov 2021</td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="dropdown">--}}
{{--                                                        <a href="javascript:void(0);"--}}
{{--                                                           class="btn btn-soft-secondary btn-sm btn-icon shadow-none"--}}
{{--                                                           data-bs-toggle="dropdown" aria-expanded="true">--}}
{{--                                                            <i class="ri-more-fill"></i>--}}
{{--                                                        </a>--}}
{{--                                                        <ul class="dropdown-menu dropdown-menu-end">--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-eye-fill me-2 align-bottom text-muted"></i>View</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-download-2-fill me-2 align-bottom text-muted"></i>Download</a>--}}
{{--                                                            </li>--}}
{{--                                                            <li class="dropdown-divider"></li>--}}
{{--                                                            <li><a class="dropdown-item"--}}
{{--                                                                   href="javascript:void(0);"><i--}}
{{--                                                                        class="ri-delete-bin-5-fill me-2 align-bottom text-muted"></i>Delete</a>--}}
{{--                                                            </li>--}}
{{--                                                        </ul>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                    <div class="text-center mt-3">--}}
{{--                                        <a href="javascript:void(0);" class="text-success "><i--}}
{{--                                                class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load more--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}



                <div class="tab-pane fade" id="dokumentasi" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h5 class="card-title flex-grow-1">Dokumentasi Rapat</h5>

                                @if($user->hasRole('notulis', $this_team))
                                    <button wire:click='getCreateDokumentasi({{$rapat_id}})' type="button" class="btn btn-sm btn-info edit-item-btn align-middle" data-bs-toggle="modal" data-bs-target="#modalCreateDokumentasi">
                                        Tambah Dokumentasi +
                                    </button>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive table-card">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                            <tr>
                                                <th scope="col">Nama Dokumen</th>
                                                <th scope="col">Tipe</th>
                                                <th scope="col">Ukuran</th>
                                                <th scope="col">Tanggal Upload</th>
                                                <th scope="col" style="width: 120px;">Aksi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($documents as $document)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm">
                                                                <div
                                                                    class="avatar-title bg-light text-secondary rounded fs-24 shadow">
                                                                    <i class="ri-folder-zip-line"></i>
                                                                </div>
                                                            </div>
                                                            <div class="ms-3 flex-grow-1">
                                                                <h5 class="fs-14 mb-0"><a href="javascript:void(0)"
                                                                                          class="text-dark">{{$document->nama}}</a>
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{$getTipeFile($document->path)}}
                                                    </td>
                                                    <td>{{ number_format(Storage::size($document->path) /  1048576, 2)}} MB</td>
                                                    <td>{{$document->created_at->format('d-m-Y')}}</td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                        <span wire:click='deleteDokumentasiConfirmation({{ $document->id }})'
                                              class="cursor-pointer" data-bs-toggle="modal"
                                              data-bs-target="#modalDeleteDokumentasi">
                                            <a class="btn btn-sm btn-danger edit-item-btn align-middle" data-toggle="delete"
                                               data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Dokumen">
                                                <i class="mdi mdi-trash-can"></i>
{{--                                                Hapus--}}
                                            </a>
                                        </span>
                                                            {{--                                                            <span wire:click="getDokumentasi({{ $document->id }})" class="cursor-pointer">--}}
                                                            {{--                                            <a class="btn btn-sm btn-info edit-item-btn align-middle" data-bs-toggle="tooltip"--}}
                                                            {{--                                               data-bs-placement="top" title="Lihat Dokumen"--}}
                                                            {{--                                               href="daftar-rapat/{{ $document->id }}">--}}
                                                            {{--                                                <i class="mdi mdi-eye"></i>--}}
                                                            {{--                                                Lihat--}}
                                                            {{--                                            </a>--}}
                                                            {{--                                        </span>--}}
                                                            {{--                                                            <span wire:click="editDokumentasi({{ $document->id }})" class="cursor-pointer" data-bs-toggle="modal"--}}
                                                            {{--                                                                  data-bs-target="#modalEditDokumentasi">--}}
                                                            {{--                                            <a class="btn btn-sm btn-warning edit-item-btn align-middle" data-bs-toggle="tooltip"--}}
                                                            {{--                                               data-bs-placement="top" title="Ubah Data">--}}
                                                            {{--                                                <i class="mdi mdi-pencil-box-multiple"></i>--}}
                                                            {{--                                                Ubah--}}
                                                            {{--                                            </a>--}}
                                                            {{--                                        </span>--}}
                                                            <span wire:click="getDokumentasi({{ $document->id }})" class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalEditDokumentasi">
                                            <a class="btn btn-sm btn-warning edit-item-btn align-middle" data-bs-toggle="tooltip"
                                               data-bs-placement="right" title="Ubah Data">
                                                <i class="mdi mdi-pencil-box-multiple"></i>
                                            </a>
                                        </span>
                                                            <span wire:click="unduhDokumen({{$document->id}})" class="cursor-pointer">
                                            <button class="btn btn-sm btn-success edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Unduh Dokumen"
                                            >
                                                <i class="mdi mdi-download"></i>
{{--                                                Lihat--}}
                                            </button>
                                        </span>
                                                            {{--                                                            <span wire:click="addMembers({{ $meeting->id }})" class="cursor-pointer">--}}
                                                            {{--                                            <a class="btn btn-sm btn-success edit-item-btn align-middle" data-bs-toggle="tooltip"--}}
                                                            {{--                                               data-bs-placement="top" title="Atur Anggota"--}}
                                                            {{--                                               href="{{ route('rapat-members', ['team' => $team, 'rapat' => $meeting->slug]) }}">--}}
                                                            {{--                                                <i class="mdi mdi-account-group"></i>--}}
                                                            {{--                                            </a>--}}
                                                            {{--                                        </span>--}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--                                    <div class="text-center mt-3">--}}
                                    {{--                                        <a href="javascript:void(0);" class="text-success "><i--}}
                                    {{--                                                class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load more--}}
                                    {{--                                        </a>--}}
                                    {{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- end tab pane -->
                <div class="tab-pane fade" id="notulensi" role="tabpanel">
                    <div class="d-flex justify-content-end mb-3">
                        @if($user->hasRole('notulis', $this_team))
                            @if($notulensi->where('id_rapat', $rapat_id)->count() < 1)
                                <a class="btn btn-sm btn-info edit-item-btn align-middle" data-bs-toggle="tooltip"
                                   data-bs-placement="top" title="Tambah Notulensi"
                                   href="{{ route('jadwal-rapat.notulensi', ['team' => $team, 'rapat' => $rapat_slug]) }}">
                                    <i class="ri-edit-box-fill"></i>
                                    Buat Notulensi
                                </a>
                            @else
                                <a class="btn btn-sm btn-info edit-item-btn align-middle" data-bs-toggle="tooltip"
                                   data-bs-placement="top" title="Ubah Notulensi"
                                   href="{{ route('jadwal-rapat.notulensi-edit', ['team' => $team, 'rapat' => $rapat_slug]) }}">
                                    <i class="ri-edit-box-fill"></i>
                                    Ubah Notulensi
                                </a>
                            @endif
                        @endif
                    </div>
                    <div class="col-xxl-4">
                        <div class="card border card-border-info">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Hasil Rapat</h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    @if($hasil_rapat == '')
                                        <i>Hasil Rapat Masih Kosong....</i>
                                    @else
                                        {!!  $hasil_rapat !!}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="card border card-border-info">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Catatan Rapat</h6>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    @if($catatan == '')
                                        <i>Catatan Rapat Masih Kosong....</i>
                                    @else
                                        {!! $catatan !!}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!-- end tab pane -->
                <div class="tab-pane fade" id="presensi" role="tabpanel">
                    <!-- end row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Peserta {{ $judul_rapat }}</h5>
                                </div>
                                <div class="card-body">
                                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Jabatan Peserta</th>
                                            <th>Role Rapat</th>
                                            <th>Status Kehadiran</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($presensis as $presensi)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $users->where('id', $pegawais->where('id', $presensi->id_pegawai)->first()->id_user)->first()->name }}
                                                </td>
                                                <td>{{ $presensi->jabatan_peserta }}</td>
                                                <td>
                                                    @if($users->find($pegawais->where('id', $presensi->id_pegawai)->first()->id_user)->hasRole('penanggung-jawab', $this_team) == true)
                                                        Penanggung Jawab
                                                    @elseif($users->find($pegawais->where('id', $presensi->id_pegawai)->first()->id_user)->hasRole('notulis', $this_team) == true)
                                                        Notulis
                                                    @else
                                                        Anggota
                                                    @endif
                                                </td>
                                                <td><span class="badge
                                        @if ($presensi->status_kehadiran == 0)
                                            bg-danger
                                        @elseif ($presensi->status_kehadiran  == 1)
                                            bg-success
                                        @elseif($presensi->status_kehadiran  == 2)
                                            bg-warning
                                        @elseif($presensi->status_kehadiran  == 3)
                                            bg-dark
                                        @endif
                                        ">
                                        @if ($presensi->status_kehadiran == 0)
                                                            Tidak Hadir
                                                        @elseif ($presensi->status_kehadiran == 1)
                                                            Hadir
                                                        @elseif($presensi->status_kehadiran == 2)
                                                            Izin
                                                        @elseif($presensi->status_kehadiran == 3)
                                                            Sakit
                                                        @endif
                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end team list -->
                </div>

                <!-- end tab pane -->
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
</div>
