<div wire:ignore.self class="modal fade" id="modalCreateUnit" tabindex="-1" aria-labelledby="modalCreateUnitLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateUnitLabel">Buat Unit Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="storeUnit">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <input wire:model="unit_kode" type="text" class="form-control" id="unit_kode" placeholder="Masukkan Kode Unit ..." autofocus>
                                @error('unit_kode')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <input wire:model="unit_nama" type="text" class="form-control" id="unit_nama" placeholder="Masukkan Nama Unit ..." autofocus>
                                @error('unit_nama')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xxl-6">
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

