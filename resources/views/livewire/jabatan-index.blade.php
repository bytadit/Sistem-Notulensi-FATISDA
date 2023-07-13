<div class="col-12">
    @section('title')
        Jabatan
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu SuperAdmin
        @endslot
        @slot('title')
            Jabatan
        @endslot
    @endcomponent
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- modals --}}
    @if($statusUpdate)
    {{-- modal update --}}
        <livewire:jabatan-update></livewire:jabatan-update>
    @else
    {{-- modal create --}}
        <livewire:jabatan-create></livewire:jabatan-create>
    @endif
    {{-- modal delete --}}
    <div wire:ignore.self class="modal fade" id="modalDeleteJabatan" tabindex="-1" aria-labelledby="modalDeleteJabatanLabel" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteJabatanLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <h6>Apakah yakin ingin menghapus <strong>{{ $jabatan_old }}</strong> ?</h6>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button wire:click='cancel()'type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button wire:click='deleteJabatan()'type="submit" class="btn btn-primary">Yakin</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal delete --}}

    <button wire:click='showCreateModal()'type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#modalCreateJabatan">Buat Baru +</button>
    <div class="row">
        @foreach ($jabatans as $jabatan)
            <div class="col-xxl-4 col-lg-4 col-sm-6">
                <div class="card card-dark">
                    <div class="card-header">
                        {{-- <span class="badge float-start text-bg-success">{{ $jabatan->kode }}</span> --}}
                        {{-- <h5><span class="badge float-end badge-label
                                    @if ($jabatan->is_aktif == 0)
                                        bg-danger
                                    @elseif ($jabatan->is_aktif == 1)
                                        bg-success
                                    @endif
                                    ">
                            <i class="mdi mdi-circle-medium"></i>
                            @if($jabatan->is_aktif == 0)
                                Non-Aktif
                            @elseif ($jabatan->is_aktif == 1)
                                Aktif
                            @endif
                        </span></h5> --}}
                    </div>
                    <div class="card-body m-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <h6 class="card-title mb-0">{{ $jabatan->nama }}</h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="align-items-center">
                            <div class="float-end">
                                <ul class="list-inline card-toolbar-menu float-end d-flex align-items-center mb-0">
                                    <li class="list-inline-item">
                                        <span wire:click='deleteConfirmation({{ $jabatan->id }})' class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalDeleteJabatan">
                                            <a class="align-middle link-danger" data-toggle="delete"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Hapus Data"
                                                >
                                                <i class="mdi mdi-trash-can"></i>
                                            </a>
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span wire:click="getJabatan({{ $jabatan->id }})" class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalEditJabatan">
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
    </div>
</div>


