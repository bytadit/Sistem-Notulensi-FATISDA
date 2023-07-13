<?php

namespace App\Http\Livewire;

use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\Rapat;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class RiwayatRapatIndex extends Component
{
    public $statusUpdate = false, $rapat, $team, $user, $this_team;
    public function render()
    {
        return view('livewire.riwayat-rapat-index', [
            'rapats' => Rapat::whereIn('id', Presensi::where('id_pegawai', Pegawai::where('id_user', auth()->user()->id)->first()->id)->pluck('id_rapat'))->where('id_team', $this->team)->where('status', '>', 1)->get()
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
