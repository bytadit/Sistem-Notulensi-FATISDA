<div class="col-12">
    @section('title')
        Atur User {{$user_name}}
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu SuperAdmin
        @endslot
            @slot('li_2')
                Atur User
            @endslot
            @slot('li_2_link')
                {{ route('manage-users') }}
            @endslot
        @slot('title')
            {{$user_name}}
        @endslot

    @endcomponent
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- modals --}}
    {{--    @if($statusUpdate)--}}
    {{--        --}}{{-- modal update --}}
    {{--        <livewire:manage-team-update></livewire:manage-team-update>--}}
    {{--    @else--}}
    {{--        --}}{{-- modal create --}}
    {{--        <livewire:manage-team-create></livewire:manage-team-create>--}}
    {{--    @endif--}}
    <div wire:ignore.self class="modal fade" id="modalDeleteUserTeam" tabindex="-1" aria-labelledby="modalDeleteUserTeamLabel" aria-modal="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteUserTeamLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <h6>Apakah yakin ingin menghapus <strong>{{ $user_team_old }}</strong> ?</h6>
                </div>
                <div class="modal-footer">
                    <div class="col-lg-12">
                        <div class="hstack gap-2 justify-content-end">
                            <button wire:click='cancel()'type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button wire:click='deleteUserTeam()'type="submit" class="btn btn-primary">Yakin</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Daftar Unit {{$user_name}}</h5>
                </div>
                <div class="card-body">
                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Unit</th>
                            <th>Jumlah Role</th>
                            <th>Jumlah Permission</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($teams as $team)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $team->display_name }}</td>
                                <td>{{ $roles->whereIn('id', $role_users->where('user_id', $user_id)->where('team_id', $team->id)->pluck('role_id'))->count() }}</td>
                                <td>{{ $permissions->whereIn('id', $permission_users->where('user_id', $user_id)->where('team_id', $team->id)->pluck('permission_id'))->count() }}</td>
{{--                                <td>{{ $team->roles != null ? $team->roles->count() : 'Tidak Punya Tim' }}</td>--}}
{{--                                <td>ss</td>--}}
                                <td>
                                        <span wire:click="editUserDetail({{ $team->id }})" class="cursor-pointer">
                                            <a class="btn btn-sm btn-warning edit-item-btn align-middle" data-bs-toggle="tooltip"
                                               data-bs-placement="top" title="Atur User"
                                               href="{{route('manage-users.edit', ['user' => $user_id, 'team' => $team->id])}}">
                                                <i class="mdi mdi-pencil-box-multiple"></i>
                                                Atur User
                                            </a>
                                        </span>
                                    <span wire:click='deleteConfirmation({{ $team->id }})'
                                          class="cursor-pointer" data-bs-toggle="modal"
                                          data-bs-target="#modalDeleteUser">
                                            <a class="btn btn-sm btn-danger edit-item-btn align-middle" data-toggle="delete"
                                               data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus User">
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


