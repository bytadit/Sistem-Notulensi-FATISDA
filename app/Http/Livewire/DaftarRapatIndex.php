<?php

namespace App\Http\Livewire;
use App\Models\Rapat;
use Livewire\Component;
use App\Models\Team;

class DaftarRapatIndex extends Component
{
    public $daftar_rapat_delete_id, $daftar_rapat_old, $daftar_rapat_show_id, $team, $rapat, $status_rapat = [];
    protected $listeners = [
        'rapatStored' => 'handleStored',
    ];
    public function mount()
    {
        $this->team = request()->team;
        $this->rapat = Rapat::where('id_team', $this->team)->get();
        $arr_rapat = Rapat::where('id_team', $this->team)->pluck('id');
        $status_rapat = [];
        foreach($arr_rapat as $rapat_id){
            $status_rapat[$rapat_id] = Rapat::where('id', $rapat_id)->first()->status;
        }
        $this->status_rapat = $status_rapat;
    }
    public function render()
    {
        return view('livewire.daftar-rapat-index', [
            'meetings' => Rapat::where('id_team', $this->team)->get()
        ])->layout('layouts.dashboard');
    }
    public function updateStatus()
    {
        foreach($this->status_rapat as $rapatId => $status)
        {
            Rapat::find($rapatId)->update([
                'status' => $status
            ]);
        }
        session()->flash('message', 'Status Rapat Berhasil Diperbarui !');
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
        return redirect()->route('daftar-rapat.create', ['team' => $this->team]);
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
