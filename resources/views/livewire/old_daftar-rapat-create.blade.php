<div wire:ignore.self class="modal fade" id="modalCreateRapat" tabindex="-1" aria-labelledby="modalCreateRapatLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateRapatLabel">Buat Rapat Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="storeRapat">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="judul_rapat" class="form-label">Judul Rapat</label>
                                <input wire:model="judul_rapat" type="text" class="form-control" id="judul_rapat" placeholder="Masukkan Judul Rapat ..." autofocus>
                                @error('judul_rapat')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                            <input wire:model="waktu_mulai" type="text" class="form-control" id="waktu_mulai" placeholder="Waktu Mulai Rapat ..." autofocus data-provider="flatpickr"
                            data-date-format="d-m-Y" data-enable-time>
                            @error('waktu_mulai')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                            <input wire:model="waktu_selesai" type="text" class="form-control" id="judul_rapat" placeholder="Waktu Selesai Rapat ..." autofocus data-provider="flatpickr"
                            data-date-format="d-m-Y" data-enable-time>
                            @error('waktu_selesai')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="bentuk_rapat" class="form-label">Bentuk Rapat</label>
                                <select wire:model="bentuk_rapat" class="form-select" aria-label="Select Bentuk Rapat" id="bentuk_rapat">
                                    <option selected value=''>Pilih Bentuk Rapat</option>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                                @error('bentuk_rapat')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
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
                        <div class="col-xxl-6">
                            <div>
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
                        <div class="col-lg-6">
                            <div>
                                <label for="penanggung_jawab" class="form-label">Penanggung Jawab Rapat</label>
                                <select wire:model="penanggung_jawab" class="form-control" id="penanggung_jawab" data-choices
                                    data-choices-groups data-placeholder="Select Penanggung Jawab" name="penanggung_jawab">
                                    <option selected value="">Pilih Penanggung Jawab Rapat</option>
                                    @foreach ($many_penanggung_jawab as $single_penanggung_jawab)
                                        <optgroup label="{{ $jabatans->where('id', $single_penanggung_jawab->id_jabatan)->first()->nama }}">
                                            <option value="{{ $single_penanggung_jawab->id }}">{{ $users->where('id', $pegawais->where('id', $single_penanggung_jawab->id_pegawai)->first()->id_user)->first()->name }}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('penanggung_jawab')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="notulis" class="form-label">Notulis Rapat</label>
                                <select wire:model="notulis" class="form-control" id="notulis" data-choices
                                    data-choices-groups data-placeholder="Select Notulis" name="notulis">
                                    <option selected value="">Pilih Notulis Rapat</option>
                                    @foreach ($many_notulis as $single_notulis)
                                        <optgroup label="{{ $jabatans->where('id', $single_notulis->id_jabatan)->first()->nama }}">
                                            <option value="{{ $single_notulis->id }}">{{ $users->where('id', $pegawais->where('id', $single_notulis->id_pegawai)->first()->id_user)->first()->name }}</option>
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('notulis')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="lokasi_rapat" class="form-label">Lokasi Rapat</label>
                                <textarea wire:model="lokasi_rapat" type="text" class="form-control" id="lokasi_rapat" placeholder="Masukkan Lokasi Rapat ..." autofocus></textarea>
                                @error('lokasi_rapat')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
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
