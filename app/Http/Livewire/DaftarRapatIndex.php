<?php

namespace App\Http\Livewire;
use App\Models\Rapat;
use Livewire\Component;

class DaftarRapatIndex extends Component
{
    public $daftar_rapat_delete_id, $daftar_rapat_old, $daftar_rapat_show_id;
    protected $listeners = [
        'rapatStored' => 'handleStored',
    ];
    public function render()
    {
        return view('livewire.daftar-rapat-index', [
            'meetings' => Rapat::latest()->get()
        ])->layout('layouts.dashboard');
    }
    public function getRapat($id)
    {
        return redirect()->route('daftar-rapat.show', ['id' => $id]);
    }
    public function editRapat($id)
    {
        return redirect()->route('daftar-rapat.edit', ['id' => $id]);
    }
    public function createRapat()
    {
        return redirect()->route('daftar-rapat.create');
    }
    public function deleteConfirmation($id)
    {
        if($id){
            $this->daftar_rapat_delete_id = $id;
            $daftarRapat = Rapat::find($this->daftar_rapat_delete_id);
            $this->daftar_rapat_old = $daftarRapat->judul_rapat;
        }
    }
    public function showCreateModal(){
        $this->dispatchBrowserEvent('show-create-modal');
    }
    public function deleteRapat()
    {
        $daftarRapat = Rapat::find($this->daftar_rapat_delete_id);
        $daftarRapat->delete();
        session()->flash('message', 'Data Rapat ' . $this->daftar_rapat_old . ' Berhasil Dihapus !');
        $this->daftar_rapat_delete_id = '';
        $this->daftar_rapat_old = '';
        $this->dispatchBrowserEvent('close-delete-modal');
    }
    public function cancel()
    {
        $this->daftar_rapat_delete_id = '';
    }
    public function handleStored($daftar_rapat)
    {
        session()->flash('message', 'Rapat ' . $daftar_rapat['judul_rapat'] . ' Berhasil Ditambahkan !');
    }
}
