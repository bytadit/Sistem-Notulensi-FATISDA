<?php

namespace App\Http\Livewire;
use App\Models\KategoriRapat;
use Livewire\Component;

class KategoriRapatCreate extends Component
{
    public $kategori_rapat;
    protected $messages = [
        'kategori_rapat.required' => 'Input Kategori Rapat tidak boleh kosong!',
    ];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'kategori_rapat' => 'required'
        ]);
    }
    private function resetInput()
    {
        $this->kategori_rapat = '';
    }
    public function storeKategoriRapat()
    {
        $this->validate([
            'kategori_rapat' => 'required'
        ]);
        $kategori_rapat = KategoriRapat::create([
            'nama' => $this->kategori_rapat
        ]);
        $this->resetInput();
        $this->emit('kategoriStored', $kategori_rapat);
        $this->dispatchBrowserEvent('close-create-modal');
    }
    public function render()
    {
        return view('livewire.kategori-rapat-create');
    }
}
