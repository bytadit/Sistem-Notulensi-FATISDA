<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\KategoriRapat;

class KategoriRapatIndex extends Component
{
    public $statusUpdate = false, $kategori_delete_id, $kategori_rapat_old;
    protected $listeners = [
        'kategoriStored' => 'handleStored',
        'kategoriUpdated' => 'handleUpdated'
    ];
    public function render()
    {
        return view('livewire.kategori-rapat-index', [
            'categories' => KategoriRapat::latest()->get()
        ]);
    }
    public function getKategoriRapat($id)
    {
        $this->statusUpdate = true;
        $kategoriRapat = KategoriRapat::find($id);
        $this->emit('getKategoriRapat', $kategoriRapat);
    }
    public function deleteConfirmation($id)
    {
        if($id){
            $this->kategori_delete_id = $id;
            $kategoriRapat = KategoriRapat::find($this->kategori_delete_id);
            $this->kategori_rapat_old = $kategoriRapat->nama;
        }
    }
    public function showCreateModal(){
        $this->statusUpdate = false;
        $this->dispatchBrowserEvent('show-create-modal');
    }
    public function deleteKategoriRapat()
    {
        $kategoriRapat = KategoriRapat::find($this->kategori_delete_id);
        $kategoriRapat->delete();
        session()->flash('message', 'Kategori ' . $this->kategori_rapat_old . ' Berhasil Dihapus !');
        $this->kategori_delete_id = '';
        $this->kategori_rapat_old = '';
        $this->dispatchBrowserEvent('close-delete-modal');
    }
    public function cancel()
    {
        $this->kategori_delete_id = '';
    }
    public function handleStored($kategori_rapat)
    {
        session()->flash('message', 'Kategori ' . $kategori_rapat['nama'] . ' Berhasil Ditambahkan !');
    }
    public function handleUpdated($kategori_rapat)
    {
        session()->flash('message', 'Data Kategori Berhasil Diubah !');
    }
}
