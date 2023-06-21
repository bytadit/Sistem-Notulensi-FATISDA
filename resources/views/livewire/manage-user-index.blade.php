<div class="col-12">
    @section('title')
        Atur User
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu SuperAdmin
        @endslot
        @slot('title')
            Atur User
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
{{--        <livewire:manage-user-update></livewire:manage-user-update>--}}
{{--    @else--}}
{{--        --}}{{-- modal create --}}
{{--        <livewire:manage-user-create></livewire:manage-user-create>--}}
{{--    @endif--}}
        <div class="row">
            <div class="col-xxl-6 col-lg-6 col-sm-6">
                <a href="{{route('manage-roles')}}" class="cursor-pointer">
                    <div class="card card-primary shadow-sm">
                        <div class="card-body m-3">
                                <div class="d-flex justify-content-center cursor-pointer align-items-center">
                                    <h6 class="card-title mb-0">{{$roles->count()}} Roles</h6>
                                </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xxl-6 col-lg-6 col-sm-6">
                <a href="{{route('manage-permissions')}}" class="cursor-pointer">
                    <div class="card card-primary shadow-sm">
                        <div class="card-body m-3">
                                <div class="d-flex justify-content-center align-items-center">
                                    <h6 class="card-title mb-0">{{$permissions->count()}} Permissions</h6>
                                </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Daftar User</h5>
                    </div>
                    <div class="card-body">
                        <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nama</th>
                                <th>Jumlah Role</th>
                                <th>Jumlah Permission</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->roles->count() }}</td>
                                    <td>{{ $user->permissions->count() }}</td>
                                    <td>
                                        <span wire:click="editUser({{ $user->id }})" class="cursor-pointer">
                                            <a class="btn btn-sm btn-warning edit-item-btn align-middle" data-bs-toggle="tooltip"
                                               data-bs-placement="top" title="Atur User"
                                               href="{{route('manage-users.edit', ['user' => $user->id])}}">
                                                <i class="mdi mdi-pencil-box-multiple"></i>
                                                Atur User
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


