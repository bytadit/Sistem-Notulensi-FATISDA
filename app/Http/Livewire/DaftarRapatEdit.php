<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Rapat;
use App\Models\KategoriRapat;
use App\Models\Topik;
use App\Models\Pegawai;
use App\Models\JabatanPegawai;
use App\Models\Jabatan;
use App\Models\User;
use App\Models\Presensi;
use App\Models\Team;

class DaftarRapatEdit extends Component
{
    // public function render()
    // {
    //     return view('livewire.daftar-rapat-edit');
    // }

    public $judul_rapat, $kategori_rapat, $topik_rapat,
    $bentuk_rapat, $lokasi_rapat, $waktu_mulai, $waktu_selesai,
    $notulis, $penanggung_jawab, $prioritas, $deskripsi, $old_judul_rapat,
    $status_rapat, $rapat_id, $team, $members = [];

protected $messages = [
    'judul_rapat.required' => 'Judul Rapat tidak boleh kosong!',
    'kategori_rapat.required' => 'Kategori Rapat tidak boleh kosong!',
    'topik_rapat.required' => 'Topik Rapat tidak boleh kosong!',
    'bentuk_rapat.required' => 'Bentuk Rapat tidak boleh kosong!',
    'lokasi_rapat.required' => 'Lokasi Rapat tidak boleh kosong!',
    'penanggung_jawab.required' => 'Penanggung Jawab Rapat tidak boleh kosong!',
    'notulis.required' => 'Notulis Rapat tidak boleh kosong!',
    'prioritas.required' => 'Prioritas Rapat tidak boleh kosong!',
    'status_rapat.required' => 'Status Rapat tidak boleh kosong!',
    'deskripsi.required' => 'Deskripsi Rapat tidak boleh kosong!',
    'waktu_mulai.required' => 'Waktu Mulai Rapat tidak boleh kosong!',
    'waktu_mulai.before' => 'Waktu Mulai Rapat Harus Sebelum Waktu Selesai',
    'waktu_selesai.required' => 'Waktu Selesai Rapat tidak boleh kosong!',
    'waktu_selesai.after' => 'Waktu Selesai Rapat Harus Setelah Waktu Mulai',

];
public function mount(Rapat $rapat)
{
    $this->rapat_id = $rapat->id;
    $this->judul_rapat = $rapat->judul_rapat;
    $this->kategori_rapat = $rapat->id_kategori_rapat;
    $this->topik_rapat = $rapat->id_topik;
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
    $this->members = Presensi::where('id_rapat', $rapat->id)->pluck('id_pegawai');

}
public function updated($fields)
{
$this->validateOnly($fields, [
    'judul_rapat' => 'required',
    'kategori_rapat' => 'required',
    'topik_rapat' => 'required',
    'bentuk_rapat' => 'required',
    'status_rapat' => 'required',
    'prioritas' => 'required',
    'deskripsi' => 'required',
    'penanggung_jawab' => 'required',
    'notulis' => 'required',
    'lokasi_rapat' => 'required',
    'waktu_mulai' => 'required|exclude_if:waktu_selesai,null|before:waktu_selesai',
    'waktu_selesai' => 'required|exclude_if:waktu_mulai,null|after:waktu_mulai',
]);
}
private function resetInput()
{
$this->old_judul_rapat = $this->judul_rapat;
$this->judul_rapat = '';
$this->kategori_rapat = '';
$this->topik_rapat = '';
$this->bentuk_rapat = '';
$this->lokasi_rapat = '';
$this->waktu_mulai = '';
$this->waktu_selesai = '';
$this->penanggung_jawab = '';
$this->notulis = '';
$this->prioritas = '';
$this->deskripsi = '';
$this->status_rapat = '';
}
public function updateRapat()
{
    $this->validate([
        'judul_rapat' => 'required',
        'kategori_rapat' => 'required',
        'topik_rapat' => 'required',
        'bentuk_rapat' => 'required',
        'lokasi_rapat' => 'required',
        'waktu_mulai' => 'required|exclude_if:waktu_selesai,null|before:waktu_selesai',
        'waktu_selesai' => 'required|exclude_if:waktu_mulai,null|after:waktu_mulai',
        'penanggung_jawab' => 'required',
        'notulis' => 'required',
        'prioritas' => 'required',
        'deskripsi' => 'required',
        'status_rapat' => 'required',
    ]);

    if($this->rapat_id){
        $this_rapat = Rapat::find($this->rapat_id);
        if($this->judul_rapat != $this_rapat->judul_rapat){
            $this_rapat->slug = null;
        }
        $this_rapat->update([
            'judul_rapat' => $this->judul_rapat,
            'id_kategori_rapat' => $this->kategori_rapat,
            'id_topik' => $this->topik_rapat,
            'bentuk_rapat' => $this->bentuk_rapat,
            'lokasi_rapat' => $this->lokasi_rapat,
            'waktu_mulai' => \Carbon\Carbon::createFromFormat('d-m-Y h:i', $this->waktu_mulai),
            'waktu_selesai' =>  \Carbon\Carbon::createFromFormat('d-m-Y h:i', $this->waktu_selesai),
            'id_penanggung_jawab' => $this->penanggung_jawab,
            'id_notulis' => $this->notulis,
            'prioritas' => $this->prioritas,
            'deskripsi' => $this->deskripsi,
            'status' => $this->status_rapat,
        ]);
    }
    $this->resetInput();
    $this->emit('rapatUpdated', $this_rapat);
    return redirect()->route('daftar-rapat', ['team' => $this->team])->with('message', 'Data Rapat ' . $this->old_judul_rapat . ' berhasil diubah!');
// $this->dispatchBrowserEvent('close-create-modal');
}

public function storeMembers()
{
    $members = $this->members;
    $rapat_presen = Rapat::findOrFail($this->rapat_id);
    if (!empty($this->members)) {
        $rapat_presen->pegawai()->sync($members);
    } else {
        $rapat_presen->pegawai()->detach();
    }
    $this->dispatchBrowserEvent('close-members-modal');
}

public function render()
    {
    return view('livewire.daftar-rapat-edit', [
            'categories' => KategoriRapat::whereIn('id_team', Team::where('name', 'like', Team::where('id', $this->team)->first()->name . '%')->pluck('id'))->get(),
            'topics' => Topik::whereIn('id_team', Team::where('name', 'like', Team::where('id', $this->team)->first()->name . '%')->pluck('id'))->get(),
            'many_notulis' => JabatanPegawai::whereIn('id_team', Team::where('name', 'like', Team::where('id', $this->team)->first()->name . '%')->pluck('id'))->get(),
            'many_penanggung_jawab' => JabatanPegawai::whereIn('id_team', Team::where('name', 'like', Team::where('id', $this->team)->first()->name . '%')->pluck('id'))->get(),
            'jabatans' => Jabatan::all(),
            'pegawais' => Pegawai::all(),
            'users' => User::all(),
            'presensis' => Presensi::all()
            // 'jabatans' => Jabatan::with('pegawai')->get(),
            // 'pegawais' => Pegawai::with('jabatan')->get(),
        ])->layout('layouts.dashboard');
    }

}
