<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Topik;

class TopikRapatIndex extends Component
{
    public $statusUpdate = false;
    public $topik_delete_id;
    public $topik_rapat_old;
    protected $listeners = [
        'topikStored' => 'handleStored',
        'topikUpdated' => 'handleUpdated'
    ];
    public function render()
    {
        return view('livewire.topik-rapat-index', [
            'topics' => Topik::latest()->get()
        ])->layout('layouts.dashboard');
    }
    public function getTopikRapat($id)
    {
        $this->statusUpdate = true;
        $topikRapat = Topik::find($id);
        $this->emit('getTopikRapat', $topikRapat);
    }
    public function deleteConfirmation($id)
    {
        if($id){
            $this->topik_delete_id = $id;
            $topikRapat = Topik::find($this->topik_delete_id);
            $this->topik_rapat_old = $topikRapat->nama;
        }
    }
    public function showCreateModal(){
        $this->statusUpdate = false;
        $this->dispatchBrowserEvent('show-create-modal');
    }
    public function deleteTopikRapat()
    {
        $topikRapat = Topik::find($this->topik_delete_id);
        $topikRapat->delete();
        session()->flash('message', 'Topik Rapat ' . $this->topik_rapat_old . ' Berhasil Dihapus !');
        $this->topik_delete_id = '';
        $this->topik_rapat_old = '';
        $this->dispatchBrowserEvent('close-delete-modal');
    }
    public function cancel()
    {
        $this->topik_delete_id = '';
    }
    public function handleStored($topik_rapat)
    {
        session()->flash('message', 'Topik ' . $topik_rapat['nama'] . ' Berhasil Ditambahkan !');
    }
    public function handleUpdated($topik_rapat)
    {
        session()->flash('message', 'Data Topik Rapat Berhasil Diubah !');
    }
}
