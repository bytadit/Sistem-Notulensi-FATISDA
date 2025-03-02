<?php

namespace App\Http\Livewire;
use App\Models\KategoriRapat;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class KategoriRapatCreate extends Component
{
    public $kategori_rapat, $team;
    protected $messages = [
        'kategori_rapat.required' => 'Input Kategori Rapat tidak boleh kosong!',
    ];
    public function mount()
    {
        $this->team = request()->team;
    }
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
    public function storeKategoriRapat(Request $request)
    {
        $this->validate([
            'kategori_rapat' => 'required'
        ]);
        $kategori_rapat = KategoriRapat::create([
            'nama' => $this->kategori_rapat,
            'id_team' => $this->team
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
