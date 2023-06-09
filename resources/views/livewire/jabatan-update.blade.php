<div wire:ignore.self class="modal fade" id="modalEditJabatan" tabindex="-1" aria-labelledby="modalEditJabatanLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalJabatanLabel">Ubah Jabatan Rapat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="updateJabatan">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <input wire:model="jabatan_nama" type="text" class="form-control" id="jabatan_nama" placeholder="Masukkan jabatan ..." autofocus>
                                @error('jabatan_nama')
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
