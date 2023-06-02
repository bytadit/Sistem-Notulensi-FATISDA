<div wire:ignore.self class="modal fade" id="modalEditTopik" tabindex="-1" aria-labelledby="modalEditTopikLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTopikLabel">Ubah Topik Rapat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="updateTopikRapat">
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
                                <select wire:model="topik_rapat_priority" class="form-select mb-3" aria-label="Select Prioritas Topik" id="topik_rapat_priority">
                                    <option selected disabled>Pilih Prioritas Topik</option>
                                    <option value="1">Rendah</option>
                                    <option value="2">Sedang</option>
                                    <option value="3">Tinggi</option>
                                </select>
                                @error('topik_rapat_priority')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
