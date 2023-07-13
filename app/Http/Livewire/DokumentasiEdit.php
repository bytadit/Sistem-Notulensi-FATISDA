<?php

namespace App\Http\Livewire;

use App\Models\Dokumentasi;
use App\Models\KategoriRapat;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class DokumentasiEdit extends Component
{
    use WithFileUploads;
    public $dokumentasi, $nama_dokumen, $file_dokumen, $rapat_id, $old_path;
    public $dokumentasi_id, $team;
    protected $listeners = [
        'getDokumentasi' => 'showDokumentasi'
    ];
    public function render()
    {
        return view('livewire.dokumentasi-edit');
    }
    public function mount()
    {
        $this->team = request()->team;
    }
    protected $messages = [
        'nama_dokumen.required' => 'Input Nama Dokumen tidak boleh kosong!',
        'file_dokumen.required' => 'Input File Dokumen tidak boleh kosong!',
    ];
    public function showDokumentasi($dokumentasi){
        $this->nama_dokumen = $dokumentasi['nama'];
//        $this->file_dokumen = $dokumentasi['path'];
        $this->dokumentasi_id = $dokumentasi['id'];
        $this->rapat_id = $dokumentasi['id_rapat'];
        $this->old_path = $dokumentasi['path'];
        $this->dispatchBrowserEvent('show-edit-dokumentasi');
    }
    public function updateDokumentasi()
    {
        $this->validate([
            'nama_dokumen' => 'required',
            'file_dokumen' => 'required',
        ]);
        $path_dokumen = $this->file_dokumen->store('public/storage/dokumen');
        if($this->dokumentasi_id){
            $dokumentasi =Dokumentasi::find($this->dokumentasi_id);
            $dokumentasi->update([
                'nama' => $this->nama_dokumen,
                'path' => $path_dokumen,
                'id_rapat' => $this->rapat_id
            ]);
        }
        Storage::delete('/'.$this->old_path);
        $this->resetInput();
        $this->emit('dokumentasiUpdated', $dokumentasi);
        $this->dispatchBrowserEvent('close-edit-dokumentasi');
    }
    private function resetInput()
    {
        $this->nama_dokumen = '';
        $this->file_dokumen = '';
        $this->rapat_id = '';
        $this->old_path = '';
        $this->dokumentasi_id = '';
    }
}
