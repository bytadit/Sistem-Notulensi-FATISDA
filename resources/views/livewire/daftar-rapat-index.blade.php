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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Rapat</h5>
                </div>
                <div class="card-body">
                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Prioritas</th>
                                <th>Judul Rapat</th>
                                <th>Kategori</th>
                                <th>Topik</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($meetings as $meeting)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge
                                                @if ($meeting->prioritas == 1)
                                                    bg-success
                                                @elseif ($meeting->prioritas == 2)
                                                    bg-info
                                                @elseif($meeting->prioritas == 3)
                                                    bg-danger
                                                @endif
                                                ">
                                                @if ($meeting->prioritas == 1)
                                                    Rendah
                                                @elseif ($meeting->prioritas == 2)
                                                    Sedang
                                                @elseif($meeting->prioritas == 3)
                                                    Tinggi
                                                @endif
                                            </span>
                                        </td>
                                <td>{{ $meeting->judul_rapat }}</td>
                                <td>{{ $meeting->kategoriRapat->nama }}</td>
                                <td>{{ $meeting->topikRapat->nama }}</td>
                                <td><span class="badge
                                        @if ($meeting->status == 0)
                                            badge-soft-primary
                                        @elseif ($meeting->status == 1)
                                            badge-soft-info
                                        @elseif($meeting->status == 2)
                                            badge-soft-danger
                                        @endif
                                        ">
                                        @if ($meeting->status == 0)
                                            Dijadwalkan
                                        @elseif ($meeting->status == 1)
                                            Berlangsung
                                        @elseif($meeting->status == 2)
                                            Selesai
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        {{-- <div class="edit">
                                            <button class="btn btn-sm btn-success edit-item-btn"
                                            data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                        </div> --}}
                                        <span wire:click='deleteConfirmation({{ $meeting->id }})'
                                            class="cursor-pointer" data-bs-toggle="modal"
                                            data-bs-target="#modalDeleteRapat">
                                            <a class="btn btn-sm btn-danger edit-item-btn align-middle" data-toggle="delete"
                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Hapus Rapat">
                                                <i class="mdi mdi-trash-can"></i>
                                                Hapus
                                            </a>
                                        </span>

                                        {{-- <div class="remove">
                                            <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
                                        </div> --}}
                                        <span wire:click="getRapat({{ $meeting->id }})" class="cursor-pointer">
                                            <a class="btn btn-sm btn-info edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                data-bs-placement="bottom" title="Lihat Rapat"
                                                href="daftar-rapat/{{ $meeting->slug }}">
                                                <i class="mdi mdi-eye"></i>
                                                Lihat
                                            </a>
                                        </span>
                                        <span wire:click="editRapat({{ $meeting->id }})" class="cursor-pointer">
                                            <a class="btn btn-sm btn-warning edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                data-bs-placement="right" title="Ubah Data"
                                                href="daftar-rapat/{{ $meeting->slug }}/edit">
                                                <i class="mdi mdi-pencil-box-multiple"></i>
                                                Ubah
                                            </a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
