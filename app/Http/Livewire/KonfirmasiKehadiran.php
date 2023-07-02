<?php

namespace App\Http\Livewire;

use App\Models\Presensi;
use App\Models\Rapat;
use Livewire\Component;

class KonfirmasiKehadiran extends Component
{
    public $konfirmasi_id, $team_id, $status, $detail, $this_konfirmasi, $rapat_name;
    public function render()
    {
        return view('livewire.konfirmasi-kehadiran');
    }
    protected $listeners = [
        'getKonfirmasi' => 'showKonfirmasi',
    ];
    public function showKonfirmasi($konfirmasi){
        $this->status= $konfirmasi['status_konfirmasi'];
        $this->detail = $konfirmasi['detail_konfirmasi'];
        $rapat = Rapat::find($konfirmasi['id_rapat']);
        $this->rapat_name = $rapat->judul_rapat;
        $this->konfirmasi_id = $konfirmasi['id'];
        $this->dispatchBrowserEvent('show-edit-modal');
    }
    public function updateKonfirmasi()
    {
        if($this->konfirmasi_id){
            $konfirmasi = Presensi::find($this->konfirmasi_id);
            $konfirmasi->update([
                'status_konfirmasi' => $this->status,
                'detail_konfirmasi' => $this->detail,
            ]);
        }
        $this->resetInput();
        $this->emit('konfirmasiUpdated', $konfirmasi);
        $this->dispatchBrowserEvent('close-edit-modal');
    }
    private function resetInput()
    {
        $this->status = '';
        $this->detail = '';
        $this->konfirmasi_id = '';
    }
}
