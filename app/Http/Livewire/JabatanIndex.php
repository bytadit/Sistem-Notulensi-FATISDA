<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Jabatan;

class JabatanIndex extends Component
{
    public function render()
    {
        return view('livewire.jabatan-index', [
            'jabatans' => Jabatan::latest()->get()
        ])->layout('layouts.dashboard');;
    }
    public $statusUpdate = false;
    public $jabatan_delete_id;
    public $jabatan_old;
    protected $listeners = [
        'jabatanStored' => 'handleStored',
        'jabatanUpdated' => 'handleUpdated'
    ];
    public function getJabatan($id)
    {
        $this->statusUpdate = true;
        $jabatan = Jabatan::find($id);
        $this->emit('getJabatan', $jabatan);
    }
    public function deleteConfirmation($id)
    {
        if($id){
            $this->jabatan_delete_id = $id;
            $jabatan = Jabatan::find($this->jabatan_delete_id);
            $this->jabatan_old = $jabatan->nama;
        }
    }
    public function showCreateModal(){
        $this->statusUpdate = false;
        $this->dispatchBrowserEvent('show-create-modal');
    }
    public function deleteJabatan()
    {
        $jabatan = Jabatan::find($this->jabatan_delete_id);
        $jabatan->delete();
        session()->flash('message', 'Jabatan ' . $this->jabatan_old . ' Berhasil Dihapus !');
        $this->jabatan_delete_id = '';
        $this->jabatan_old = '';
        $this->dispatchBrowserEvent('close-delete-modal');
    }
    public function cancel()
    {
        $this->jabatan_delete_id = '';
    }
    public function handleStored($jabatan)
    {
        session()->flash('message', 'Jabatan ' . $jabatan['nama'] . ' Berhasil Ditambahkan !');
    }
    public function handleUpdated($jabatan)
    {
        session()->flash('message', 'Data Jabatan Berhasil Diubah !');
    }
}
