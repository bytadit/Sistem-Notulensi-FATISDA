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
use Illuminate\Http\Request;
use App\Models\Presensi;
use App\Models\Team;

class DaftarRapatCreate extends Component
{
    public $judul_rapat, $kategori_rapat, $topik_rapat,
            $bentuk_rapat, $lokasi_rapat, $waktu_mulai, $waktu_selesai,
            $notulis, $penanggung_jawab, $prioritas, $deskripsi, $old_judul_rapat,
            $status_rapat, $team;

    public function mount()
    {
        $this->team = request()->team;
    }

    protected $messages = [
        'judul_rapat.required' => 'Judul Rapat tidak boleh kosong!',
        'kategori_rapat.required' => 'Kategori Rapat tidak boleh kosong!',
        'topik_rapat.required' => 'Topik Rapat tidak boleh kosong!',
        'lokasi_rapat.required' => 'Lokasi Rapat tidak boleh kosong!',
        'penanggung_jawab.required' => 'Penanggung Jawab Rapat tidak boleh kosong!',
        'notulis.required' => 'Notulis Rapat tidak boleh kosong!',
        'deskripsi.required' => 'Deskripsi Rapat tidak boleh kosong!',
        'waktu_mulai.required' => 'Waktu Mulai Rapat tidak boleh kosong!',
        'waktu_mulai.before' => 'Waktu Mulai Rapat Harus Sebelum Waktu Selesai',
        'waktu_selesai.required' => 'Waktu Selesai Rapat tidak boleh kosong!',
        'waktu_selesai.after' => 'Waktu Selesai Rapat Harus Setelah Waktu Mulai',
        'status_rapat.required' => 'Status Rapat tidak boleh kosong!',
        'prioritas.required' => 'Prioritas Rapat tidak boleh kosong!',
        'bentuk_rapat.required' => 'Bentuk Rapat tidak boleh kosong!',

    ];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'bentuk_rapat' => 'required',
            'prioritas' => 'required',
            'status_rapat' => 'required',
            'judul_rapat' => 'required',
            'kategori_rapat' => 'required',
            'topik_rapat' => 'required',
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
        $this->lokasi_rapat = '';
        $this->waktu_mulai = '';
        $this->waktu_selesai = '';
        $this->penanggung_jawab = '';
        $this->notulis = '';
        $this->deskripsi = '';
        $this->prioritas = '';
        $this->bentuk_rapat = '';
        $this->status_rapat = '';
    }
    public function storeRapat(Request $request)
    {
        $this->validate([
            'bentuk_rapat' => 'required',
            'prioritas' => 'required',
            'status_rapat' => 'required',
            'judul_rapat' => 'required',
            'kategori_rapat' => 'required',
            'topik_rapat' => 'required',
            'lokasi_rapat' => 'required',
            'waktu_mulai' => 'required|exclude_if:waktu_selesai,null|before:waktu_selesai',
            'waktu_selesai' => 'required|exclude_if:waktu_mulai,null|after:waktu_mulai',
            'penanggung_jawab' => 'required',
            'notulis' => 'required',
            'deskripsi' => 'required',
        ]);
        $daftar_rapat = Rapat::create([
            'bentuk_rapat' => $this->bentuk_rapat,
            'prioritas' => $this->prioritas,
            'status' => $this->status_rapat,
            'judul_rapat' => $this->judul_rapat,
            'id_kategori_rapat' => $this->kategori_rapat,
            'id_topik' => $this->topik_rapat,
            'lokasi_rapat' => $this->lokasi_rapat,
            'waktu_mulai' => \Carbon\Carbon::createFromFormat('d-m-Y h:i', $this->waktu_mulai),
            'waktu_selesai' =>  \Carbon\Carbon::createFromFormat('d-m-Y h:i', $this->waktu_selesai),
            'id_penanggung_jawab' => $this->penanggung_jawab,
            'id_notulis' => $this->notulis,
            'deskripsi' => $this->deskripsi,
            'id_team' => $this->team

        ]);
        $this->resetInput();
        $this->emit('rapatStored', $daftar_rapat);
        return redirect()->route('daftar-rapat', ['team' => $this->team])->with('message', 'Rapat ' . $this->old_judul_rapat . ' telah ditambahkan !');
        // $this->dispatchBrowserEvent('close-create-modal');
    }
    public function render()
    {
        return view('livewire.daftar-rapat-create', [
            'categories' => KategoriRapat::whereIn('id_team', Team::where('name', 'like', Team::where('id', $this->team)->first()->name . '%')->pluck('id'))->get(),
            'topics' => Topik::whereIn('id_team', Team::where('name', 'like', Team::where('id', $this->team)->first()->name . '%')->pluck('id'))->get(),
            'many_notulis' => JabatanPegawai::whereIn('id_team', Team::where('name', 'like', Team::where('id', $this->team)->first()->name . '%')->pluck('id'))->get(),
            'many_penanggung_jawab' => JabatanPegawai::whereIn('id_team', Team::where('name', 'like', Team::where('id', $this->team)->first()->name . '%')->pluck('id'))->get(),
            'jabatans' => Jabatan::all(),
            'pegawais' => Pegawai::all(),
            'users' => User::all()
            // 'jabatans' => Jabatan::with('pegawai')->get(),
            // 'pegawais' => Pegawai::with('jabatan')->get(),
        ])->layout('layouts.dashboard');
    }
}
