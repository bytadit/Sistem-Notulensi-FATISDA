<?php

namespace App\Http\Livewire;

use App\Models\Dokumentasi;
use App\Models\KategoriRapat;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class DokumentasiCreate extends Component
{
    use WithFileUploads;
    public $dokumentasi, $nama_dokumen, $file_dokumen, $team, $rapat_id;
    public function render()
    {
        return view('livewire.dokumentasi-create');
    }
    protected $listeners = [
        'getCreateDokumentasi' => 'showDokumentasi'
    ];
    protected $messages = [
        'nama_dokumen.required' => 'Input Nama Dokumen tidak boleh kosong!',
        'file_dokumen.required' => 'Input File Dokumen tidak boleh kosong!',
    ];
    public function mount()
    {
        $this->team = request()->team;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'nama_dokumen' => 'required',
            'file_dokumen' => 'required'
        ]);
    }
    public function cancel()
    {
        $this->resetInput();
    }
    private function resetInput()
    {
        $this->nama_dokumen = '';
        $this->file_dokumen = '';
    }
    public function showDokumentasi($rapat){
        $this->rapat_id = $rapat['id'];
    }
    public function storeDokumentasi()
    {
        $this->validate([
            'nama_dokumen' => 'required',
            'file_dokumen' => 'required|max:5000'
        ]);
        $path_dokumen = $this->file_dokumen->store('public/storage/dokumen');
        $dokumentasi = Dokumentasi::create([
            'nama' => $this->nama_dokumen,
            'path' => $path_dokumen,
            'id_rapat' => $this->rapat_id
        ]);
        $this->resetInput();
        $this->emit('dokumentasiStored', $dokumentasi);
        $this->dispatchBrowserEvent('close-create-dokumentasi');
    }
}
