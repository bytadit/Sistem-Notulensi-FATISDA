<div class="col-12">
    @component('dashboard.layouts.breadcrumb')
        @slot('li_1')
            Menu User
        @endslot
        @slot('title')
            Jadwal Rapat
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
            <livewire:isi-presensi></livewire:isi-presensi>
        @else
            <livewire:konfirmasi-kehadiran></livewire:konfirmasi-kehadiran>
            {{--         <livewire:jadwal-rapat-create></livewire:jadwal-rapat-create> --}}
    @endif
    {{-- modal delete --}}
    {{-- <div wire:ignore.self class="modal fade" id="modalDeleteKategori" tabindex="-1" aria-labelledby="modalDeleteKategoriLabel" aria-modal="true">
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
    </div> --}}
    {{-- end modal delete --}}

    {{-- <button wire:click='showCreateModal()'type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#modalCreateKategori">Buat Baru +</button> --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Jadwal Rapat</h5>
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
                            @foreach ($rapats as $rapat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="badge
                                                @if ($rapat->prioritas == 1)
                                                    bg-success
                                                @elseif ($rapat->prioritas == 2)
                                                    bg-info
                                                @elseif($rapat->prioritas == 3)
                                                    bg-danger
                                                @endif
                                                ">
                                                @if ($rapat->prioritas == 1)
                                                    Rendah
                                                @elseif ($rapat->prioritas == 2)
                                                    Sedang
                                                @elseif($rapat->prioritas == 3)
                                                    Tinggi
                                                @endif
                                            </span>
                                        </td>
                                <td>{{ $rapat->judul_rapat }}</td>
                                <td>{{ $rapat->kategoriRapat->nama }}</td>
                                <td>{{ $rapat->topikRapat->nama }}</td>
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
                                        <span class="cursor-pointer">
                                            @if( $user->hasRole('administrator', $this_team))
                                                <a class="btn btn-sm btn-info edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                   data-bs-placement="top" title="Lihat Rapat"
                                                   href="{{ route('daftar-rapat.show', ['team' => $team, 'rapat' => $rapat->slug]) }}">
                                                <i class="mdi mdi-eye"></i>
                                                Lihat
                                            </a>
                                            @elseif($user->hasRole('user', $this_team))
                                                <a class="btn btn-sm btn-info edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Lihat Rapat"
                                                    href="{{ route('jadwal-rapat.show', ['team' => $team, 'rapat' => $rapat->slug]) }}">
                                                    <i class="mdi mdi-eye"></i>
                                                    Lihat
                                                </a>
                                            @endif
                                        </span>
                                        @if ($rapat->status == 0)
                                            <span wire:click="getKonfirmasi({{ $rapat->id }})" class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalKonfirmasi">
                                                <a class="btn btn-sm btn-primary edit-item-btn align-middle">
                                                        <i class="mdi mdi-eye"></i>
                                                        Konfirmasi Kehadiran
                                                </a>
                                            </span>
                                        @elseif($rapat->status == 1)
                                            <span wire:click="getPresensi({{ $rapat->id }})" class="cursor-pointer" data-bs-toggle="modal" data-bs-target="#modalPresensi">
                                                <a class="btn btn-sm btn-success edit-item-btn align-middle">
                                                        <i class="mdi mdi-eye"></i>
                                                        Presensi
                                                </a>
                                            </span>
                                        @else
                                        @endif

                                        {{-- <span wire:click="editRapat({{ $rapat->id }})" class="cursor-pointer">
                                            <a class="btn btn-sm btn-warning edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Ubah Data"
                                                href="daftar-rapat/{{ $rapat->slug }}/edit">
                                                <i class="mdi mdi-pencil-box-multiple"></i>
                                                Ubah
                                            </a>
                                        </span> --}}
                                        {{-- <span wire:click="addMembers({{ $rapat->id }})" class="cursor-pointer">
                                            <a class="btn btn-sm btn-success edit-item-btn align-middle" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Atur Anggota"
                                                href="{{ route('rapat-members', ['team' => $team, 'rapat' => $rapat->slug]) }}">
                                                <i class="mdi mdi-account-group"></i>
                                                Atur Anggota
                                            </a>
                                        </span> --}}
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
