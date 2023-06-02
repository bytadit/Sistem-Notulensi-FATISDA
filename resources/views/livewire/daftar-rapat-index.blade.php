<div class="col-12">
    @section('title')
        Daftar Rapat
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu Admin
        @endslot
        @slot('title')
            Daftar Rapat
        @endslot
    @endcomponent
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- modals --}}
    {{-- <livewire:daftar-rapat-create></livewire:daftar-rapat-create> --}}
    {{-- modal delete --}}
    <div wire:ignore.self class="modal fade" id="modalDeleteRapat" tabindex="-1" aria-labelledby="modalDeleteRapatLabel"
        aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteRapatLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <h6>Apakah yakin ingin menghapus Rapat <strong>{{ $daftar_rapat_old }}</strong> ?</h6>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button wire:click='cancel()'type="button" class="btn btn-light"
                                data-bs-dismiss="modal">Batal</button>
                            <button wire:click='deleteRapat()'type="submit" class="btn btn-primary">Yakin</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal delete --}}

    {{-- <button wire:click='showCreateModal()'type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#modalCreateRapat">Buat Baru +</button> --}}
    <button wire:click='createRapat()'type="button" class="btn btn-success mb-4 cursor-pointer">Buat Baru +</button>
    <div class="row">
        @foreach ($meetings as $meeting)
            <div class="col-xxl-4 col-lg-4 col-sm-6">
                <div class="card card-secondary">
                    <div class="card-body m-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <h6 class="card-title mb-0">{{ $meeting->judul_rapat }}</h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="align-items-center">
                            <div class="float-end">
                                <ul class="list-inline card-toolbar-menu float-end d-flex align-items-center mb-0">
                                    <li class="list-inline-item">
                                        <span wire:click='deleteConfirmation({{ $meeting->id }})'
                                            class="cursor-pointer" data-bs-toggle="modal"
                                            data-bs-target="#modalDeleteRapat">
                                            <a class="align-middle link-danger" data-toggle="delete"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Hapus Rapat">
                                                <i class="mdi mdi-trash-can"></i>
                                            </a>
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        {{-- <span class="cursor-pointer"> --}}
                                        <span wire:click="getRapat({{ $meeting->id }})" class="cursor-pointer">
                                            <a class="align-middle link-primary" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Lihat Rapat"
                                                href="daftar-rapat/{{ $meeting->slug }}">
                                                <i class="mdi mdi-eye"></i>
                                            </a>
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span wire:click="editRapat({{ $meeting->id }})" class="cursor-pointer">
                                            <a class="align-middle link-warning" data-bs-toggle="tooltip"
                                                data-bs-placement="right" title="Ubah Data"
                                                href="daftar-rapat/{{ $meeting->slug }}/edit">
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
