<div>
    @section('title')
        Atur Peserta Rapat
    @endsection
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu Admin
        @endslot
        @slot('left_title')
            Peserta Rapat
        @endslot
        @slot('li_2')
            Daftar Rapat
        @endslot
        @slot('li_2_link')
            {{ route('daftar-rapat', ['team' => $team]) }}
        @endslot
        @slot('title')
            {{ $judul_rapat }}
        @endslot
        @slot('title_link')
            {{ route('daftar-rapat.show', ['team' => $team, 'rapat' => $rapat_slug]) }}
        @endslot
        @slot('subtitle')
            Daftar Peserta Rapat
        @endslot
    @endcomponent
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- <h1>{{ $rapats->where('slug', $rapat_slug)->first()->judul_rapat }}</h1> --}}
    <button data-bs-toggle="modal" data-bs-target="#inviteMembersModal" type="button" class="btn btn-success mb-4 cursor-pointer">Atur Anggota +</button>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Peserta Rapat {{ $judul_rapat }}</h5>
                </div>
                <div class="card-body">
                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Jabatan Peserta</th>
                                <th>Role Rapat</th>
                                <th>Status Konfirmasi</th>
                                <th>Detail Konfirmasi</th>
                                <th>Status Kehadiran</th>
                                <th>Detail Kehadiran</th>
{{--                                <th>Aksi</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensis as $presensi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $users->where('id', $pegawais->where('id', $presensi->id_pegawai)->first()->id_user)->first()->name }}
                                    </td>
                                    <td>{{ $presensi->jabatan_peserta }}</td>
                                    <td>
                                        @if($users->find($pegawais->where('id', $presensi->id_pegawai)->first()->id_user)->hasRole('penanggung-jawab', $this_team) == true)
                                            Penanggung Jawab
                                        @elseif($users->find($pegawais->where('id', $presensi->id_pegawai)->first()->id_user)->hasRole('notulis', $this_team) == true)
                                            Notulis
                                        @else
                                            Anggota
                                        @endif
                                    </td>
                                    <td><span class="badge
                                        @if ($presensi->status_konfirmasi == 0)
                                            bg-danger
                                        @elseif ($presensi->status_konfirmasi  == 1)
                                            bg-success
                                        @elseif($presensi->status_konfirmasi  == 2)
                                            bg-warning
                                        @elseif($presensi->status_konfirmasi  == 3)
                                            bg-dark
                                        @endif
                                        ">
                                        @if ($presensi->status_konfirmasi == 0)
                                            Tidak Hadir
                                        @elseif ($presensi->status_konfirmasi == 1)
                                            Hadir
                                        @elseif($presensi->status_konfirmasi == 2)
                                            Izin
                                        @elseif($presensi->status_konfirmasi == 3)
                                            Sakit
                                        @endif
                                    </span>
                                </td>
                                    <td>{{ $presensi->detail_konfirmasi == null ? 'Belum Terisi' : $presensi->detail_konfirmasi }}</td>
                                    <td><span class="badge
                                        @if ($presensi->status_kehadiran == 0)
                                            bg-danger
                                        @elseif ($presensi->status_kehadiran  == 1)
                                            bg-success
                                        @elseif($presensi->status_kehadiran  == 2)
                                            bg-warning
                                        @elseif($presensi->status_kehadiran  == 3)
                                            bg-dark
                                        @endif
                                        ">
                                        @if ($presensi->status_kehadiran == 0)
                                            Tidak Hadir
                                        @elseif ($presensi->status_kehadiran == 1)
                                            Hadir
                                        @elseif($presensi->status_kehadiran == 2)
                                            Izin
                                        @elseif($presensi->status_kehadiran == 3)
                                            Sakit
                                        @endif
                                    </span>
                                </td>
                                    <td>{{ $presensi->detail_kehadiran == null ? 'Belum Terisi' : $presensi->detail_kehadiran }}</td>
{{--                                    <td>{{ $presensi->id }}</td>--}}

                                    {{-- <td>{{ $rapat->kategoriRapat->nama }}</td> --}}
                                    {{-- <td>{{ $rapat->topikRapat->nama }}</td>
                                <td><span class="badge
                                        @if ($rapat->status == 0)
                                            badge-soft-primary
                                        @elseif ($rapat->status == 1)
                                            badge-soft-info
                                        @elseif($rapat->status == 2)
                                            badge-soft-danger
                                        @endif
                                        ">
                                        @if ($rapat->status == 0)
                                            Dijadwalkan
                                        @elseif ($rapat->status == 1)
                                            Berlangsung
                                        @elseif($rapat->status == 2)
                                            Selesai
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <span wire:click='deleteConfirmation({{ $rapat->id }})'
                                            class="cursor-pointer" data-bs-toggle="modal"
                                            data-bs-target="#modalDeleteRapat">
                                            <a class="btn btn-sm btn-danger edit-item-btn align-middle" data-toggle="delete"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Rapat">
                                                <i class="mdi mdi-trash-can"></i>
                                                Hapus
                                            </a>
                                        </span>
                                        <span wire:click="getRapat({{ $rapat->id }})" class="cursor-pointer">
                                            <a class="btn btn-sm btn-info edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Lihat Rapat"
                                                href="daftar-rapat/{{ $rapat->slug }}">
                                                <i class="mdi mdi-eye"></i>
                                                Lihat
                                            </a>
                                        </span>
                                        <span wire:click="editRapat({{ $rapat->id }})" class="cursor-pointer">
                                            <a class="btn btn-sm btn-warning edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Ubah Data"
                                                href="daftar-rapat/{{ $rapat->slug }}/edit">
                                                <i class="mdi mdi-pencil-box-multiple"></i>
                                                Ubah
                                            </a>
                                        </span>
                                        <span wire:click="addMembers({{ $rapat->id }})" class="cursor-pointer">
                                            <a class="btn btn-sm btn-success edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Atur Anggota"
                                                href="{{ route('rapat-members', ['team' => $team, 'rapat' => $rapat->slug]) }}">
                                                <i class="mdi mdi-account-group"></i>
                                                Atur Anggota
                                            </a>
                                        </span>
                                    </div>
                                </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="inviteMembersModal" tabindex="-1" aria-labelledby="inviteMembersModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="storeMembers">
                <div class="modal-content">
                    <div class="modal-header p-3 ps-4 bg-soft-success">
                        <h5 class="modal-title" id="inviteMembersModalLabel">Peserta Rapat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">

                        <div class="search-box mb-3">
                            <input type="text" class="form-control bg-light border-light"
                                placeholder="Search here....">
                            <i class="ri-search-line search-icon"></i>
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
                                        @if($user->hasRole('penanggung-jawab', $this_team) == false && $user->hasRole('notulis', $this_team) == false && in_array($pegawais->where('id_user',$user->id)->first()->id, $pejabats->where('id_team', $team)->pluck('id_pegawai')->toArray()) == true)
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
                                                <input wire:model.defer="members" class="form-check-input" type="checkbox"
                                                    id="member{{ $user->id }}"
                                                    value={{ $pegawais->where('id_user', $user->id)->first()->id }}
                                                    {{ $presensis->where('id_rapat', $rapat_id)->pluck('id_pegawai')->contains($pegawais->where('id_user', $user->id)->first()->id)? 'checked': '' }}>
                                                {{-- <button type="button" class="btn btn-light btn-sm">Add</button> --}}
                                            </div>
                                        @endif
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
