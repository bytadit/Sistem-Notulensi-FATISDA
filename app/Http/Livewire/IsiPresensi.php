<?php

namespace App\Http\Livewire;

use App\Models\JabatanPegawai;
use App\Models\Presensi;
use Livewire\Component;
use App\Models\Rapat;

class IsiPresensi extends Component
{
    public $presensi_id, $team_id, $status, $detail, $this_presensi, $rapat_name;
    public function render()
    {
        return view('livewire.isi-presensi');
    }
    protected $listeners = [
        'getPresensi' => 'showPresensi',
    ];
    public function showPresensi($presensi){
        $this->status= $presensi['status_kehadiran'];
        $this->detail = $presensi['detail_kehadiran'];
        $rapat = Rapat::find($presensi['id_rapat']);
        $this->rapat_name = $rapat->judul_rapat;
        $this->presensi_id = $presensi['id'];
        $this->dispatchBrowserEvent('show-edit-modal');
    }
    public function updatePresensi()
    {
        if($this->presensi_id){
            $presensi = Presensi::find($this->presensi_id);
            $presensi->update([
                'status_kehadiran' => $this->status,
                'detail_kehadiran' => $this->detail,
            ]);
        }
        $this->resetInput();
        $this->emit('presensiUpdated', $presensi);
        $this->dispatchBrowserEvent('close-edit-modal');
    }
    private function resetInput()
    {
        $this->status = '';
        $this->detail = '';
        $this->presensi_id = '';
    }
}
