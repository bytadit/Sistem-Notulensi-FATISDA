<?php

namespace App\Http\Livewire;
use App\Models\KategoriRapat;
use Livewire\Component;

class KategoriRapatUpdate extends Component
{
    public $kategori_rapat;
    public $kategori_rapat_id, $team;
    protected $listeners = [
        'getKategoriRapat' => 'showKategoriRapat'
    ];
    public function render()
    {
        return view('livewire.kategori-rapat-update');
    }
    public function mount()
    {
        $this->team = request()->team;
    }
    protected $messages = [
        'kategori_rapat.required' => 'Input Kategori Rapat tidak boleh kosong!',
    ];
    public function showKategoriRapat($kategoriRapat){
        $this->kategori_rapat = $kategoriRapat['nama'];
        $this->kategori_rapat_id = $kategoriRapat['id'];
        $this->dispatchBrowserEvent('show-edit-modal');
    }
    public function updateKategoriRapat()
    {
        $this->validate([
            'kategori_rapat' => 'required',
        ]);
        if($this->kategori_rapat_id){
            $kategoriRapat = KategoriRapat::find($this->kategori_rapat_id);
            $kategoriRapat->update([
                'nama' => $this->kategori_rapat
            ]);
        }
        $this->resetInput();
        $this->emit('kategoriUpdated', $kategoriRapat);
        $this->dispatchBrowserEvent('close-edit-modal');
    }
    private function resetInput()
    {
        $this->kategori_rapat = '';
        $this->kategori_rapat_id = '';
    }
}
