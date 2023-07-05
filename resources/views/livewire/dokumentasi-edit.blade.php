<div wire:ignore.self class="modal fade" id="modalEditDokumentasi" tabindex="-1" aria-labelledby="modalEditDokumentasiLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditDokumentasiLabel">Ubah Informasi Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="updateDokumentasi">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <input wire:model="nama_dokumen" type="text" class="form-control" id="nama_dokumen" placeholder="Masukkan Nama Dokumen ..." autofocus>
                                @error('nama_dokumen')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <input wire:model="file_dokumen" type="file" class="form-control" id="file_dokumen" placeholder="Upload Dokumen ..." autofocus>
                                @error('file_dokumen')
                                <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" wire:click='cancel()' class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
