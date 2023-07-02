<?php

namespace App\Http\Livewire;

use App\Models\Jabatan;
use App\Models\JabatanPegawai;
use App\Models\KategoriRapat;
use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\Rapat;
use App\Models\Team;
use App\Models\Topik;
use App\Models\User;
use App\Models\Notulensi;
use Livewire\Component;

class UserJadwalRapatShow extends Component
{
    public $judul_rapat, $kategori_rapat, $topik_rapat,
        $bentuk_rapat, $lokasi_rapat, $waktu_mulai, $waktu_selesai,
        $notulis, $penanggung_jawab, $prioritas, $deskripsi, $old_judul_rapat,
        $status_rapat, $rapat_id, $team, $team_nama, $rapat_slug, $hasil_rapat, $catatan, $notulensi, $this_team, $user;

    public function render()
    {
        return view('livewire.user-jadwal-rapat-show', [
            'categories' => KategoriRapat::latest()->get(),
            'topics' => Topik::latest()->get(),
            'many_notulis' => JabatanPegawai::all(),
            'many_penanggung_jawab' => JabatanPegawai::all(),
            'jabatans' => Jabatan::all(),
            'pegawais' => Pegawai::all(),
            'jabatan_pegawais' => JabatanPegawai::all(),
            'users' => User::all(),
            'rapats' => Rapat::all(),
            'presensis' => Presensi::where('id_rapat', $this->rapat_id)->get(),
            'members' => Presensi::where('id_rapat', $this->rapat_id)->take(5)->get()
            // 'jabatans' => Jabatan::with('pegawai')->get(),
            // 'pegawais' => Pegawai::with('jabatan')->get(),
        ])->layout('layouts.dashboard');
    }

    public function mount(Rapat $rapat)
    {
        $this->rapat_id = $rapat->id;
        $this->notulensi = Notulensi::all();
        if(Notulensi::where('id_rapat', $this->rapat_id)->get()->count() != 0){
            $this->hasil_rapat = Notulensi::where('id_rapat', $this->rapat_id)->first()->hasil_rapat;
            $this->catatan = Notulensi::where('id_rapat', $this->rapat_id)->first()->catatan;
        }
        $this->judul_rapat = $rapat->judul_rapat;
        $this->kategori_rapat = $rapat->kategoriRapat->nama;
        $this->topik_rapat = $rapat->topikRapat->nama;
        $this->bentuk_rapat = $rapat->bentuk_rapat;
        $this->lokasi_rapat = $rapat->lokasi_rapat;
        $this->waktu_mulai = \Carbon\Carbon::parse($rapat->waktu_mulai)->format('d-m-Y h:i');
        $this->waktu_selesai = \Carbon\Carbon::parse($rapat->waktu_selesai)->format('d-m-Y h:i');
        $this->penanggung_jawab = $rapat->id_penanggung_jawab;
        $this->notulis = $rapat->id_notulis;
        $this->prioritas = $rapat->prioritas;
        $this->deskripsi = $rapat->deskripsi;
        $this->status_rapat = $rapat->status;
        $this->team = request()->team;
        $this->this_team = Team::find($this->team);
        $this->user = User::find(auth()->user()->id);
        $this->team_nama = Team::where('id', $this->team)->first()->display_name;
        $this->rapat_slug = Rapat::where('id', $this->rapat_id)->first()->slug;
    }

    // protected $listeners = [
    //     'getRapat' => 'showRapat'
    // ];
    // public function showRapat($daftarRapat){
    //     $this->judul_rapat = $daftarRapat->judul_rapat;
    // }

}
