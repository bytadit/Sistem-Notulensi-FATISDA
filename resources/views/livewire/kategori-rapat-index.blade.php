<div class="col-12">
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu Admin
        @endslot
        @slot('title')
            Kategori Rapat
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
        <livewire:kategori-rapat-update></livewire:kategori-rapat-update>
    @else
    {{-- modal create --}}
        <livewire:kategori-rapat-create></livewire:kategori-rapat-create>
    @endif
    {{-- modal delete --}}
    <div wire:ignore.self class="modal fade" id="modalDeleteKategori" tabindex="-1" aria-labelledby="modalDeleteKategoriLabel" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteKategoriLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <h6>Apakah yakin ingin menghapus <strong>{{ $kategori_rapat_old }}</strong> ?</h6>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button wire:click='cancel()'type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button wire:click='deleteKategoriRapat()'type="submit" class="btn btn-primary">Yakin</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal delete --}}

    <button wire:click='showCreateModal()'type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#modalCreateKategori">Buat Baru +</button>
    <div class="row">
        @foreach ($categories as $category)
            <div class="col-xxl-4 col-lg-4 col-sm-6">
                <div class="card card-primary">
                    <div class="card-body m-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <h6 class="card-title mb-0">{{ $category->nama }}</h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <div class="align-items-center">
                            <div class="float-end">
                                <ul class="list-inline card-toolbar-menu float-end d-flex align-items-center mb-0">
                                    <li class="list-inline-item">
                                        <span wire:click='deleteConfirmation({{ $category->id }})' class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalDeleteKategori">
                                            <a class="align-middle link-danger" data-toggle="delete"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Hapus Data"
                                                >
                                                <i class="mdi mdi-trash-can"></i>
                                            </a>
                                        </span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span wire:click="getKategoriRapat({{ $category->id }})" class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalEditKategori">
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



