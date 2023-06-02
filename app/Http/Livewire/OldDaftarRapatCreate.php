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

class OldDaftarRapatCreate extends Component
{
    public $judul_rapat, $kategori_rapat, $topik_rapat,
            $bentuk_rapat, $lokasi_rapat, $waktu_mulai, $waktu_selesai,
            $notulis, $penanggung_jawab;
    protected $messages = [
        'judul_rapat.required' => 'Input Judul Rapat tidak boleh kosong!',
        'kategori_rapat.required' => 'Input Kategori Rapat tidak boleh kosong!',
        'topik_rapat.required' => 'Input Topik Rapat tidak boleh kosong!',
        'bentuk_rapat.required' => 'Input Bentuk Rapat tidak boleh kosong!',
        'lokasi_rapat.required' => 'Input Lokasi Rapat tidak boleh kosong!',
        'penanggung_jawab.required' => 'Input Penanggung Jawab Rapat tidak boleh kosong!',
        'notulis.required' => 'Input Notulis Rapat tidak boleh kosong!',
        'waktu_mulai.required' => 'Input Waktu Mulai Rapat tidak boleh kosong!',
        'waktu_mulai.before' => 'Waktu Mulai Rapat Harus Sebelum Waktu Selesai',
        'waktu_selesai.required' => 'Input Waktu Selesai Rapat tidak boleh kosong!',
        'waktu_selesai.after' => 'Waktu Selesai Rapat Harus Setelah Waktu Mulai',

    ];
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'judul_rapat' => 'required',
            'kategori_rapat' => 'required',
            'topik_rapat' => 'required',
            'bentuk_rapat' => 'required',
            'penanggung_jawab' => 'required',
            'notulis' => 'required',
            'lokasi_rapat' => 'required',
            'waktu_mulai' => 'required|exclude_if:waktu_selesai,null|before:waktu_selesai',
            'waktu_selesai' => 'required|exclude_if:waktu_mulai,null|after:waktu_mulai',
        ]);
    }
    private function resetInput()
    {
        $this->judul_rapat = '';
        $this->kategori_rapat = '';
        $this->topik_rapat = '';
        $this->bentuk_rapat = '';
        $this->lokasi_rapat = '';
        $this->waktu_mulai = '';
        $this->waktu_selesai = '';
        $this->penanggung_jawab = '';
        $this->notulis = '';
    }
    public function storeRapat()
    {
        $this->validate([
            'judul_rapat' => 'required',
            'kategori_rapat' => 'required',
            'topik_rapat' => 'required',
            'bentuk_rapat' => 'required',
            'lokasi_rapat' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'penanggung_jawab' => 'required',
            'notulis' => 'required',
        ]);
        $daftar_rapat = Rapat::create([
            'judul_rapat' => $this->judul_rapat,
            'id_kategori_rapat' => $this->kategori_rapat,
            'id_topik' => $this->topik_rapat,
            'bentuk_rapat' => $this->bentuk_rapat,
            'lokasi_rapat' => $this->lokasi_rapat,
            'waktu_mulai' => \Carbon\Carbon::createFromFormat('d-m-Y h:i', $this->waktu_mulai),
            'waktu_selesai' =>  \Carbon\Carbon::createFromFormat('d-m-Y h:i', $this->waktu_selesai),
            'id_penanggung_jawab' => $this->penanggung_jawab,
            'id_notulis' => $this->notulis,
        ]);
        $this->resetInput();
        $this->emit('rapatStored', $daftar_rapat);
        $this->dispatchBrowserEvent('close-create-modal');
    }
    public function render()
    {
        return view('livewire.old_daftar-rapat-create', [
            'categories' => KategoriRapat::latest()->get(),
            'topics' => Topik::latest()->get(),
            'many_notulis' => JabatanPegawai::all(),
            'many_penanggung_jawab' => JabatanPegawai::all(),
            'jabatans' => Jabatan::all(),
            'pegawais' => Pegawai::all(),
            'users' => User::all()
            // 'jabatans' => Jabatan::with('pegawai')->get(),
            // 'pegawais' => Pegawai::with('jabatan')->get(),
        ]);
    }
}
