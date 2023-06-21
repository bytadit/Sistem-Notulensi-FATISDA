<div>
    @section('title')
        Buat Role
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu SuperAdmin
        @endslot
        @slot('left_title')
            Buat Role Baru
        @endslot
        @slot('li_2')
            Daftar Role
        @endslot
        @slot('li_2_link')
            {{ route('manage-roles') }}
        @endslot
        @slot('title')
            Buat Role Baru
        @endslot
    @endcomponent
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form wire:submit.prevent="storeRole">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="name">Role Name</label>
                            <input wire:model='name' type="text" class="form-control" id="name"
                                   placeholder="Masukkan Role Name" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="display_name">Display Name</label>
                            <input wire:model='display_name' wire:keyup='generateSlug' type="text" class="form-control" id="display_name"
                                   placeholder="Masukkan Nama Role">
                            @error('display_name')
                            <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="description">Display Name</label>
                            <input wire:model='description' type="text" class="form-control" id="description"
                                   placeholder="Masukkan Deskripsi Role">
                            @error('description')
                            <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <label class="form-label mb-3">Daftar Permission</label>
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <div class="d-inline input-group">
                                            <input wire:model.defer="permission_array" class="form-check-input" type="checkbox"
                                                       id="permission{{ $permission->id }}"
                                                       value={{ $permission->id }}>
    {{--                                                {{ $presensis->where('id_rapat', $rapat_id)->pluck('id_pegawai')->contains(2)? 'checked': '' }}>--}}
                                            <label for="permission{{ $permission->id }}" class="form-label">{{$permission->display_name}}</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-end mb-4">
                <button type="button" class="btn btn-secondary w-sm">Draft</button>
                <button type="submit" class="btn btn-success w-sm">Buat</button>
            </div>
        </div>
    </form>
</div>
