<div class="col-12">
    @section('title')
        Profil Saya
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu User
        @endslot
        @slot('title')
            Profil Saya
        @endslot
    @endcomponent
    {{-- @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif --}}
    {{-- modals --}}
    @if($statusUpdate)
    {{-- modal update --}}
        <livewire:profil-update></livewire:profil-update>
    @else
    {{-- modal create --}}
        <livewire:profil-create></livewire:profil-create>
    @endif


    <div class="profile-foreground position-relative mx-n4 mt-n4">

        <div class="profile-wid-bg">
            {{-- <img src="{{ URL::asset('assets/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" /> --}}
        </div>
    </div>
    <div class="pt-4 pb-lg-4">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <img src="@if ($old_path != '') {{ Storage::url($old_path) }}@else{{ asset('assets/images/users/avatar-1.jpg') }} @endif" alt="user-img" class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow" />
                </div>
            </div>
            <!--end col-->
            <div class="col d-flex align-content-center flex-wrap">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $user->name }}</h3>
                    <p class="text-white-75 mb-0">NIP. {{ $pegawai->first()->nip }}</p>
                    {{-- <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i
                                class="ri-map-pin-user-line me-1 text-white-75 fs-16 align-middle"></i>{{ $pegawai->first()->alamat}}</div>
                        <div><i class="ri-building-line me-1 text-white-75 fs-16 align-middle"></i>Themesbrand
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col">
                <div class="d-flex align-items-end flex-column">
                    <div class="flex-shrink-0">
                        <a href="{{route('ubah-profil')}}" class="btn btn-success"><i
                                class="ri-edit-box-line align-bottom"></i> Ubah Profil</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div></div>
                <div class="tab-content pt-2 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-xxl-3">

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Profil Saya</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Nama Lengkap :</th>
                                                        <td class="text-muted">{{ $user->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Email :</th>
                                                        <td class="text-muted">{{ $user->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Username :</th>
                                                        <td class="text-muted">{{ $user->username }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">NIP :</th>
                                                        <td class="text-muted">{{ $pegawai->first()->nip }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">Alamat :</th>
                                                        <td class="text-muted">{{ $pegawai->first()->alamat }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="ps-0" scope="row">No. WA :</th>
                                                        <td class="text-muted">{{ $pegawai->first()->no_wa }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>

    {{-- modal delete --}}
    {{-- <div wire:ignore.self class="modal fade" id="modalDeleteTopik" tabindex="-1" aria-labelledby="modalDeleteTopikLabel" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteTopikLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <h6>Apakah yakin ingin menghapus <strong>{{ $topik_rapat_old }}</strong> ?</h6>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button wire:click='cancel()'type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button wire:click='deleteTopikRapat()'type="submit" class="btn btn-primary">Yakin</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- end modal delete --}}

    {{-- <button wire:click='showCreateModal()'type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#modalCreateTopik">Buat Baru +</button>
    <div class="row">
        @foreach ($topics as $topic)
            <div class="col-xxl-4 col-lg-4 col-sm-6">
                <div class="card card-dark">
                    <div class="card-header">
                        <span class="badge float-start text-bg-success">Success</span>
                        <h5><span class="badge float-end badge-label
                                    @if ($topic->priority == 1)
                                        bg-warning
                                    @elseif ($topic->priority == 2)
                                        bg-secondary
                                    @elseif ($topic->priority == 3)
                                        bg-danger
                                    @endif
                                    ">
                            <i class="mdi mdi-circle-medium"></i>
                            @if($topic->priority == 1)
                                Prioritas Rendah
                            @elseif ($topic->priority == 2)
                                Prioritas Sedang
                            @elseif ($topic->priority == 3)
                                Prioritas Tinggi
                            @endif
                        </span></h5>
                    </div>
                    <div class="card-body m-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <h6 class="card-title mb-0">{{ $topic->nama }}</h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="align-items-center">
                            <div class="float-end">
                                <ul class="list-inline card-toolbar-menu float-end d-flex align-items-center mb-0">
                                    <li class="list-inline-item">
                                        <span wire:click='deleteConfirmation({{ $topic->id }})' class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalDeleteTopik">
                                            <a class="align-middle link-danger" data-toggle="delete"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Hapus Data"
                                                >
                                                <i class="mdi mdi-trash-can"></i>
                                            </a>
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span wire:click="getTopikRapat({{ $topic->id }})" class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalEditTopik">
                                            <a class="align-middle link-warning" data-bs-toggle="tooltip"
                                                data-bs-placement="right" title="Ubah Data">
                                                <i class="mdi mdi-pencil-box-multiple"></i>
                                            </a>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div> --}}
</div>


