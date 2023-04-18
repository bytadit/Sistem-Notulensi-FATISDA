<div wire:ignore.self class="modal fade" id="modalCreateTopik" tabindex="-1" aria-labelledby="modalCreateTopikLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateTopikLabel">Buat Topik Rapat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="storeTopikRapat">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <input wire:model="topik_rapat" type="text" class="form-control" id="topik_rapat" placeholder="Masukkan Topik Rapat ..." autofocus>
                                @error('topik_rapat')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <select wire:model="topik_rapat_weight" class="form-select mb-3" aria-label="Select Topik Rapat" id="topik_rapat_weight">
                                    <option selected disabled>Pilih Urgensi Topik</option>
                                    <option value="1">Low</option>
                                    <option value="2">Average</option>
                                    <option value="3">High</option>
                                </select>
                                @error('topik_rapat_weight')
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
