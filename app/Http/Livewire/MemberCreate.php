<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Rapat;
use App\Models\Presensi;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Jabatan;
use App\Models\JabatanPegawai;

class MemberCreate extends Component
{
    public $rapat_id, $rapat_slug, $team, $judul_rapat, $members = [];
    public function render()
    {
        return view('livewire.member-create', [
            'rapats' => Rapat::all(),
            'pegawais' => Pegawai::all(),
            'users' => User::all(),
            'pejabats' => JabatanPegawai::all(),
            'jabatans' => Jabatan::all(),
            'presensis' => Presensi::where('id_rapat', $this->rapat_id)->get()
        ])->layout('layouts.dashboard');
    }

    public function storeMembers()
    {
        $members = $this->members;
        $data = [];
        $rapat_presen = Rapat::findOrFail($this->rapat_id);
        if (!empty($this->members)) {
            foreach ($members as $member) {
                $data[$member] = ['jabatan_peserta' => Jabatan::where('id', JabatanPegawai::where('id_pegawai', $member)->first()->id_jabatan)->first()->nama];
            }
            $rapat_presen->pegawai()->sync($data);
            $data = [];
        } else {
            $rapat_presen->pegawai()->detach();
        }
        $this->dispatchBrowserEvent('close-members-modal');
    }

    public function mount()
    {
        $this->rapat_slug = request()->rapat;
        $this->team = request()->team;
        $this->judul_rapat = Rapat::where('slug', $this->rapat_slug)->first()->judul_rapat;
        $this->rapat_id = Rapat::where('slug', $this->rapat_slug)->first()->id;
        $this->members = Presensi::where('id_rapat', $this->rapat_id)->pluck('id_pegawai');
    }
}
