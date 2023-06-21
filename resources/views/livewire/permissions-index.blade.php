<div class="col-12">
    @section('title')
        Atur Permissions
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu SuperAdmin
        @endslot
        @slot('title')
            Atur Permissions
        @endslot
    @endcomponent
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
        @if($statusUpdate)
{{--             modal update --}}
            <livewire:permissions-update></livewire:permissions-update>
        @else
{{--             modal create --}}
            <livewire:permissions-create></livewire:permissions-create>
        @endif
        {{-- modal delete --}}
        <div wire:ignore.self class="modal fade" id="modalDeletePermission" tabindex="-1" aria-labelledby="modalDeletePermissionLabel" aria-modal="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDeletePermissionLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                        <h6>Apakah yakin ingin menghapus <strong>{{ $permission_old }}</strong> ?</h6>
                    </div>
                    <div class="modal-footer">
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button wire:click='cancel()'type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button wire:click='deletePermission()'type="submit" class="btn btn-primary">Yakin</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal delete --}}
        <button wire:click='showCreateModal()'type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#modalCreatePermission">Buat Baru +</button>
        <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Permissions</h5>
                </div>
                <div class="card-body">
                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama/Kode</th>
                            <th>Display Name</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->display_name }}</td>
                                <td>{{ $permission->description }}</td>
                                <td>
                                        <span wire:click="getPermission({{ $permission->id }})" class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalEditPermission">
                                            <a class="btn btn-sm btn-warning edit-item-btn align-middle" data-bs-toggle="tooltip"
                                               data-bs-placement="top" title="Ubah Data">
                                                <i class="mdi mdi-pencil-box-multiple"></i>
                                                Ubah
                                            </a>
                                        </span>
                                    <span wire:click='deleteConfirmation({{ $permission->id }})'
                                          class="cursor-pointer" data-bs-toggle="modal"
                                          data-bs-target="#modalDeletePermission">
                                            <a class="btn btn-sm btn-danger edit-item-btn align-middle" data-toggle="delete"
                                               data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Permission">
                                                <i class="mdi mdi-trash-can"></i>
                                                Hapus
                                            </a>
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

</div>


