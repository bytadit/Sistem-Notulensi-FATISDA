<div>
    @section('title')
        Ubah Rapat
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu Admin
        @endslot
        @slot('li_2')
            Daftar Rapat
        @endslot
        @slot('li_2_link')
            {{ route('daftar-rapat', ['team' => $team]) }}
        @endslot
        @slot('title')
            Ubah {{ $judul_rapat }}
        @endslot
    @endcomponent
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form wire:submit.prevent="updateRapat">
        <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="judul_rapat">Judul Rapat</label>
                        <input wire:model='judul_rapat' type="text" class="form-control" id="judul_rapat"
                            placeholder="Masukkan Judul Rapat">
                        @error('judul_rapat')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="kategori_rapat" class="form-label">Kategori Rapat</label>
                                <select wire:model="kategori_rapat" class="form-select" aria-label="Select Kategori Rapat" id="kategori_rapat">
                                    <option selected value=''>Pilih Kategori Rapat</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_rapat')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="topik_rapat" class="form-label">Topik Rapat</label>
                                <select wire:model="topik_rapat" class="form-select" aria-label="Select Topik Rapat" id="topik_rapat">
                                    <option selected value=''>Pilih Topik Rapat</option>
                                    @foreach ($topics as $topic)
                                        <option value="{{ $topic->id }}">{{ $topic->nama }}</option>
                                    @endforeach
                                </select>
                                @error('topik_rapat')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                <input wire:model="waktu_mulai" type="text" class="form-control" id="waktu_mulai"
                                    placeholder="Waktu Mulai Rapat ..." autofocus data-provider="flatpickr"
                                    data-date-format="d-m-Y" data-enable-time>
                                @error('waktu_mulai')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                <input wire:model="waktu_selesai" type="text" class="form-control" id="judul_rapat"
                                    placeholder="Waktu Selesai Rapat ..." autofocus data-provider="flatpickr"
                                    data-date-format="d-m-Y" data-enable-time>
                                @error('waktu_selesai')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="prioritas" class="form-label">Prioritas</label>
                                <select wire:model='prioritas'class="form-select"
                                    id="prioritas">
                                    <option selected value=''>Prioritas Rapat</option>
                                    <option selected value="1">Rendah</option>
                                    <option value="2">Sedang</option>
                                    <option value="3">Tinggi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="bentuk_rapat" class="form-label">Bentuk Rapat</label>
                                <select wire:model='bentuk_rapat'class="form-select" id="bentuk_rapat">
                                    <option selected value=''>Bentuk Rapat</option>
                                    <option selected value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="status_rapat" class="form-label">Status Rapat</label>
                                <select wire:model='status_rapat'class="form-select"
                                    id="status_rapat">
                                    <option selected value=''>Status Rapat</option>
                                    <option selected value="0">Dijadwalkan</option>
                                    <option value="1">Berlangsung</option>
                                    <option value="2">Selesai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="lokasi_rapat">Lokasi Rapat</label>
                        <textarea wire:model='lokasi_rapat' type="text" class="form-control" id="lokasi_rapat"
                            placeholder="Masukkan Lokasi Rapat"></textarea>
                        @error('lokasi_rapat')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Rapat</label>
                        <div wire:ignore>
                            <textarea wire:model='deskripsi' name="deskripsi" type="text" id="deskripsi"
                                placeholder="Masukkan Deksripsi Rapat">
                                {{ $deskripsi }}
                            </textarea>
                        </div>
                        @error('deskripsi')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Peserta Rapat</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="penanggung_jawab" class="form-label">Penanggung Jawab Rapat</label>
                        <select wire:model="penanggung_jawab" class="form-control" id="penanggung_jawab" data-placeholder="Select Penanggung Jawab" name="penanggung_jawab">
                            <option selected value="">Pilih Penanggung Jawab</option>
                            @foreach($users as $user)
                                @if($user->hasRole('penanggung-jawab', $this_team))
                                    <optgroup label="{{$jabatans->where('id', $pejabats->where('id_team', $team)->where('id_pegawai', $pegawais->where('id_user', $user->id)->first()->id)->first()->id_jabatan)->first()->nama}}">
                                        <option value="{{ $pejabats->where('id_team', $team)->where('id_pegawai', $pegawais->where('id_user', $user->id)->first()->id)->first()->id }}">
                                            {{ $user->name }}
                                        </option>
                                    </optgroup>
                                @endif
                            @endforeach
{{--                            @foreach ($many_penanggung_jawab as $single_penanggung_jawab)--}}
{{--                                <optgroup--}}
{{--                                    label="{{ $jabatans->where('id', $single_penanggung_jawab->id_jabatan)->first()->nama }}">--}}
{{--                                    <option value="{{ $single_penanggung_jawab->id }}">--}}
{{--                                        {{ $users->where('id', $pegawais->where('id', $single_penanggung_jawab->id_pegawai)->first()->id_user)->first()->name }}--}}
{{--                                    </option>--}}
{{--                                </optgroup>--}}
{{--                            @endforeach--}}
                        </select>
                        @error('penanggung_jawab')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="notulis" class="form-label">Notulis Rapat</label>
                        <select wire:model="notulis" class="form-control" id="notulis" data-placeholder="Select Notulis" name="notulis">
                            <option selected value="">Pilih Notulis Rapat</option>
                            @foreach($users as $user)
                                @if($user->hasRole('notulis', $this_team))
                                    <optgroup label="{{$jabatans->where('id', $pejabats->where('id_team', $team)->where('id_pegawai', $pegawais->where('id_user', $user->id)->first()->id)->first()->id_jabatan)->first()->nama}}">
                                        <option value="{{ $pejabats->where('id_team', $team)->where('id_pegawai', $pegawais->where('id_user', $user->id)->first()->id)->first()->id }}">
                                            {{ $user->name }}
                                        </option>
                                    </optgroup>
                                @endif
                            @endforeach
{{--                            @foreach ($many_notulis as $single_notulis)--}}
{{--                                <optgroup--}}
{{--                                    label="{{ $jabatans->where('id', $single_notulis->id_jabatan)->first()->nama }}">--}}
{{--                                    <option value="{{ $single_notulis->id }}">--}}
{{--                                        {{ $users->where('id', $pegawais->where('id', $single_notulis->id_pegawai)->first()->id_user)->first()->name }}--}}
{{--                                    </option>--}}
{{--                                </optgroup>--}}
{{--                            @endforeach--}}
                        </select>
                        @error('notulis')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                   {{-- <div>
                            <label class="form-label">Anggota Rapat</label>
                            <div class="avatar-group">
                                <a href="javascript: void(0);" class="avatar-group-item shadow"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
                                    title="Brent Gonzalez">
                                    <div class="avatar-xs">
                                        <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}"
                                            alt="" class="rounded-circle img-fluid">
                                    </div>
                                </a>
                                <a href="javascript: void(0);" class="avatar-group-item shadow"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
                                    title="Sylvia Wright">
                                    <div class="avatar-xs">
                                        <div class="avatar-title rounded-circle bg-secondary">
                                            S
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript: void(0);" class="avatar-group-item shadow"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
                                    title="Ellen Smith">
                                    <div class="avatar-xs">
                                        <img src="{{ URL::asset('assets/images/users/avatar-4.jpg') }}"
                                            alt="" class="rounded-circle img-fluid">
                                    </div>
                                </a>
                                <a href="javascript: void(0);" class="avatar-group-item shadow"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
                                    title="Add Members">
                                    <div class="avatar-xs" data-bs-toggle="modal"
                                        data-bs-target="#inviteMembersModal">
                                        <div
                                            class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                            +
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div> --}}
                </div>
                <!-- end card body -->
            </div>
        </div>
        <div class="col-12 text-end mb-4">
            {{-- <button type="button" class="btn btn-danger w-sm">Delete</button> --}}
            {{-- <button type="button" class="btn btn-secondary w-sm">Draft</button> --}}
            <button type="submit" class="btn btn-success w-sm">Ubah</button>
        </div>
        </div>
    </form>

    <div class="modal fade" id="inviteMembersModal" tabindex="-1" aria-labelledby="inviteMembersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form wire:submit.prevent="storeMembers">
        <div class="modal-content">
            <div class="modal-header p-3 ps-4 bg-soft-success">
                <h5 class="modal-title" id="inviteMembersModalLabel">Anggota Rapat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="search-box mb-3">
                    <input type="text" class="form-control bg-light border-light"
                        placeholder="Search here....">
                    <i class="ri-search-line search-icon"></i>
                </div>
                <div class="mb-4 d-flex align-items-center">
                    {{-- <div class="me-2">
                        <h5 class="mb-0 fs-13">Anggota :</h5>
                    </div> --}}
                    {{-- <div class="avatar-group justify-content-center">
                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-placement="top" title="Brent Gonzalez">
                            <div class="avatar-xs">
                                <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" alt=""
                                    class="rounded-circle img-fluid">
                            </div>
                        </a>
                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-placement="top" title="Sylvia Wright">
                            <div class="avatar-xs">
                                <div class="avatar-title rounded-circle bg-secondary">
                                    S
                                </div>
                            </div>
                        </a>
                        <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip"
                            data-bs-trigger="hover" data-bs-placement="top" title="Ellen Smith">
                            <div class="avatar-xs">
                                <img src="{{ URL::asset('assets/images/users/avatar-4.jpg') }}" alt=""
                                    class="rounded-circle img-fluid">
                            </div>
                        </a>
                    </div> --}}
                </div>

                    <div class="mx-n4 px-4" data-simplebar style="max-height: 225px;">
                        <div class="vstack gap-3">

                            {{-- @foreach ($jabatanPengadaans as $jabatanPengadaan)
                                <div class="d-flex align-items-center">
                                    <input type="checkbox" class="non-table form-check-input" name="id_jabatan_pengadaan[]"
                                        value={{ $jabatanPengadaan->id }} id="jabatanPengadaan{{ $jabatanPengadaan->id }}">
                                    <label for="jabatanPengadaan{{ $jabatanPengadaan->id }}" class="ms-2">{{ $jabatanPengadaan->nama }}</label>
                                    <br>
                                </div>
                            @endforeach --}}

                            @foreach ($users as $user)
                                <div class="d-flex align-items-center">
                                        <div class="avatar-xs flex-shrink-0 me-3">
                                            <img src="{{ URL::asset('assets/images/users/avatar-2.jpg') }}"
                                                alt="" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="flex-grow-1">
                                            <label for="member{{ $user->id }}" class="form-check-label fs-13 mb-0">
                                                    {{ $user->name }}
                                            </label>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <input wire:model.defer="members" class="form-check-input" type="checkbox" id="member{{ $user->id }}" value={{ $pegawais->where('id_user',$user->id)->first()->id }}
                                            {{ $presensis->where('id_rapat', $rapat_id)->pluck('id_pegawai')->contains(2) ? 'checked': '' }}>
                                            {{-- <button type="button" class="btn btn-light btn-sm">Add</button> --}}
                                        </div>
                                    {{-- </div> --}}
                                </div>
                            @endforeach
                            <!-- end member item -->
                        </div>
                        <!-- end list -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light w-xs" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success w-xs">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('scripts')
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .then(editor => {
            editor.model.document.on('change:data', () => {
            @this.set('deskripsi', editor.getData());
            })
        })
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
</div>

