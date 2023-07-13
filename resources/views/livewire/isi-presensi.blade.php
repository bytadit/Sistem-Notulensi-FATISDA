<div wire:ignore.self class="modal fade" id="modalPresensi" tabindex="-1" aria-labelledby="modalPresensiLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPresensiLabel">Presensi {{$rapat_name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="updatePresensi">
                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <select wire:model="status" class="form-select mb-3" aria-label="Pilih Status" id="status_kehadiran">
                                    <option selected value="">Pilih Status Kehadiran</option>
                                    <option value=0>Tidak Hadir</option>
                                    <option value=1>Hadir</option>
                                    <option value=2>Izin</option>
                                    <option value=3>Sakit</option>
                                </select>
                                @error('status_kehadiran')
                                    <span class="text-danger text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <textarea wire:model="detail" class="form-control mb-3" aria-label="Detail Kehadiran" id="detail"></textarea>
                                @error('detail')
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

