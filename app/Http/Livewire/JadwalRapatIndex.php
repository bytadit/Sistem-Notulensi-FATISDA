<?php

namespace App\Http\Livewire;

use App\Models\JabatanPegawai;
use Livewire\Component;
use App\Models\Rapat;
use App\Models\Presensi;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Team;

class JadwalRapatIndex extends Component
{
    public $statusUpdate = false, $rapat, $team, $user, $this_team;
    public function render()
    {
        return view('livewire.jadwal-rapat-index', [
            'rapats' => Rapat::whereIn('id', Presensi::where('id_pegawai', Pegawai::where('id_user', auth()->user()->id)->first()->id)->pluck('id_rapat'))->where('id_team', $this->team)->where('status', '<', 2)->get()
            // 'rapats' => Rapat::all()
        ])->layout('layouts.dashboard');
    }
    protected $listeners = [
        'presensiUpdated' => 'handlePresensi',
        'konfirmasiUpdated' => 'handleKonfirmasi'
    ];
    public function getPresensi($id)
    {
        $this->statusUpdate = true;
        $id_presensi = Presensi::where('id_rapat', $id)->where('id_pegawai', Pegawai::where('id_user', auth()->user()->id)->first()->id)->first()->id;
        $presensi = Presensi::find($id_presensi);
        $this->emit('getPresensi', $presensi);
    }
    public function getKonfirmasi($id)
    {
        $this->statusUpdate = false;
        $id_konfirmasi = Presensi::where('id_rapat', $id)->where('id_pegawai', Pegawai::where('id_user', auth()->user()->id)->first()->id)->first()->id;
        $konfirmasi = Presensi::find($id_konfirmasi);
        $this->emit('getKonfirmasi', $konfirmasi);
    }
    public function handlePresensi($presensi)
    {
        session()->flash('message', 'Presensi Berhasil Disimpan !');
    }
    public function handleKonfirmasi($konfirmasi)
    {
        session()->flash('message', 'Konfirmasi Kehadiran Berhasil Disimpan !');
    }
    public function mount()
    {
        $this->team = request()->team;
        $this->this_team = Team::find($this->team);
        $this->user = User::find(auth()->user()->id);
    }

}
