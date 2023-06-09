<div wire:ignore.self class="modal fade" id="modalCreateJabatanPegawai" tabindex="-1" aria-labelledby="modalCreateJabatanPegawaiLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateJabatanPegawaiLabel">Buat Pejabat Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="storeJabatanPegawai">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <select wire:model="unit_nama" class="form-select mb-3" aria-label="Select Unit" id="unit_nama">
                                    <option selected value="">Pilih Unit Pejabat</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                    @endforeach
                                </select>
                                @error('unit_nama')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <select wire:model="jabatan_nama" class="form-select mb-3" aria-label="Select Jabatan" id="jabatan_nama">
                                    <option selected value="">Pilih Jabatan</option>
                                    @foreach ($jabatans as $jabatan)
                                        <option value="{{ $jabatan->id }}">{{ $jabatan->nama }}</option>
                                    @endforeach
                                </select>
                                @error('jabatan_nama')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <select wire:model="pegawai_nama" class="form-select mb-3" aria-label="Select Pegawai" id="pegawai_nama">
                                    <option selected value="">Pilih Unit Pejabat</option>
                                    @foreach ($pegawais as $pegawai)
                                        <option value="{{ $pegawai->id }}">{{ $users->where('id', $pegawai->id_user)->first()->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_nama')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="col-xxl-6">
                            <div>
                                <input wire:model="unit_nama" type="text" class="form-control" id="unit_nama" placeholder="Masukkan Nama Unit ..." autofocus>
                                @error('unit_nama')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                        {{-- <div class="col-xxl-6">
                            <div>
                                <select wire:model="unit_isaktif" class="form-select mb-3" aria-label="Select Status Unit" id="unit_isaktif">
                                    <option selected value="">Pilih Status Unit</option>
                                    <option value="0">Non-Aktif</option>
                                    <option value="1">Aktif</option>
                                </select>
                                @error('unit_isaktif')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

