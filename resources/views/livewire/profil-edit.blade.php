<div class="col-12">
    @section('title')
        Ubah Profil
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu User
        @endslot
        @slot('li_2')
            Profil Saya
        @endslot
        @slot('li_2_link')
            {{ route('profil-saya') }}
        @endslot
        @slot('title')
            Ubah Profil
        @endslot
    @endcomponent
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form wire:submit.prevent="updateProfil">
        <div class="row">
            <div class="col-xxl-3">
                <div class="card mt-0">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                <img src="@if($path_photo != null){{ $path_photo->temporaryUrl() }}@else{{ Storage::url($old_path) }}@endif"
                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow"
                                    alt="user-profile-image">
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input wire:model='path_photo'name="path_photo" id="path_photo" type="file" class="profile-img-file-input">
                                    <label for="path_photo" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body shadow">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <h5 class="fs-16 mb-1">{{ $user->name }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-xxl-9">
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="fas fa-home"></i>
                                    Detail Personal
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            {{-- personal detail --}}
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                            <input wire:model='nama_lengkap' type="text" class="form-control"
                                                id="nama_lengkap" placeholder="Masukkan Nama Lengkap ...."
                                                value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email
                                                Anda</label>
                                            <input wire:model='email' type="email" class="form-control" id="email"
                                                placeholder="Masukkan Email Anda ..." value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username Anda</label>
                                            <input wire:model='username' disabled type="text" class="form-control"
                                                id="username" placeholder="Masukkan Username Anda ..."
                                                value="{{ $user->username }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="nip" class="form-label">NIP Anda</label>
                                            <input wire:model='nip' type="number" class="form-control" id="nip"
                                                placeholder="Masukkan NIP Anda ..."
                                                value="{{ $pegawai->first()->nip }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="no_wa" class="form-label">Nomor WhatsApp</label>
                                            <input wire:model='no_wa' type="number" class="form-control" id="no_wa"
                                                placeholder="Masukkan Nomor Whatsapp ..."
                                                value="{{ $pegawai->first()->no_wa }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3 pb-2">
                                            <label for="exampleFormControlTextarea" class="form-label">Alamat</label>
                                            <textarea wire:model='alamat' class="form-control" id="alamat" placeholder="Masukkan Alamat Anda ..."
                                                rows="3">{{ $pegawai->first()->alamat }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                            <button type="button" wire:click="batal" class="btn btn-soft-success">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
