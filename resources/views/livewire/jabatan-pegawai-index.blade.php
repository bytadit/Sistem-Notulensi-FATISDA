<div class="col-12">
    @section('title')
        Atur Pejabat
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu Admin
        @endslot
        @slot('title')
            Atur Pejabat
        @endslot
    @endcomponent
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
     {{-- modals --}}
     @if($statusUpdate)
     {{-- modal update --}}
         <livewire:jabatan-pegawai-update :team_id="$team_id"></livewire:jabatan-pegawai-update>
     @else
     {{-- modal create --}}
         <livewire:jabatan-pegawai-create :team_id="$team_id"></livewire:jabatan-pegawai-create>
     @endif
    {{-- modals --}}
    {{-- <livewire:daftar-rapat-create></livewire:daftar-rapat-create> --}}
    {{-- modal delete --}}
    <div wire:ignore.self class="modal fade" id="modalDeleteJabatanPegawai" tabindex="-1" aria-labelledby="modalDeleteJabatanPegawaiLabel"
        aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteJabatanPegawaiLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <h6>Apakah yakin ingin menghapus Pejabat <strong>{{ $jabatan_pegawai_old }}</strong> ?</h6>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button wire:click='cancel()'type="button" class="btn btn-light"
                                data-bs-dismiss="modal">Batal</button>
                            <button wire:click='deleteJabatanPegawai()'type="submit" class="btn btn-primary">Yakin</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal delete --}}

    {{-- <button wire:click='showCreateModal()'type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#modalCreateRapat">Buat Baru +</button> --}}
    <button wire:click='showCreateModal()'type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#modalCreateJabatanPegawai">Buat Baru +</button>
    <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar Pejabat</h5>
                    </div>
                    <div class="card-body">
                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Unit</th>
                                    <th>Jabatan</th>
                                    <th>Pegawai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jabatanPegawais as $jabatanPegawai)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jabatanPegawai->team->display_name }}</td>
                                    <td>{{ $jabatanPegawai->jabatan->nama }}</td>
                                    <td>{{ $users->where('id', $pegawais->where('id', $jabatanPegawai->id_pegawai)->first()->id_user)->first()->name }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            {{-- <div class="edit">
                                                <button class="btn btn-sm btn-success edit-item-btn"
                                                data-bs-toggle="modal" data-bs-target="#showModal">Edit</button>
                                            </div> --}}
                                            <span wire:click='deleteConfirmation({{ $jabatanPegawai->id }})'
                                                class="cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#modalDeleteJabatanPegawai">
                                                <a class="btn btn-sm btn-danger edit-item-btn align-middle" data-toggle="delete"
                                                    data-bs-toggle="tooltip" data-bs-placement="left" title="Hapus Pejabat">
                                                    <i class="mdi mdi-trash-can"></i>
                                                    Hapus
                                                </a>
                                            </span>

                                            {{-- <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Remove</button>
                                            </div> --}}
                                            {{-- <span wire:click="getJabatanPegawai({{ $jabatanPegawai->id }})" class="cursor-pointer">
                                                <a class="btn btn-sm btn-info edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                    data-bs-placement="bottom" title="Lihat Pejabat"
                                                    href="pejabat/{{ $jabatanPegawai->id }}">
                                                    <i class="mdi mdi-eye"></i>
                                                    Lihat
                                                </a>
                                            </span> --}}
                                            {{-- <span wire:click="editJabatanPegawai({{ $jabatanPegawai->id }})" class="cursor-pointer">
                                                <a class="btn btn-sm btn-warning edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                    data-bs-placement="right" title="Ubah Pejabat"
                                                    href="pejabat/{{ $jabatanPegawai->id }}/edit">
                                                    <i class="mdi mdi-pencil-box-multiple"></i>
                                                    Ubah
                                                </a>
                                            </span> --}}
                                            <span wire:click="getJabatanPegawai({{ $jabatanPegawai->id }})" class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalEditJabatanPegawai">
                                                <a class="btn btn-sm btn-warning edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                    data-bs-placement="right" title="Ubah Data">
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
