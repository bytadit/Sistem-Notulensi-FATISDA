<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Pegawai;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class ProfilEdit extends Component
{
    use WithFileUploads;

    public $nama_lengkap, $email, $username, $old_path,
    $nip, $alamat, $no_wa, $old_user, $user_id, $pegawai_id, $path_photo;

    public function render()
    {
        $pegawai = Pegawai::where('id_user', auth()->user()->id)->get();
        $old_path = $pegawai->first()->path_photo;
        return view('livewire.profil-edit', [
            'users' => User::latest()->get(),
            'pegawais' => Pegawai::latest()->get(),
            'user' => auth()->user(),
            'old_path' => $old_path,
            'pegawai' => Pegawai::where('id_user', auth()->user()->id)->get()
        ])->layout('layouts.dashboard');
    }

    protected $messages = [
        'nama_lengkap.required' => 'Nama Lengkap tidak boleh kosong!',
    ];
    public function mount()
    {
        $user = auth()->user();
        $this->nama_lengkap = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->user_id = $user->id;
        $pegawai = Pegawai::where('id_user', auth()->user()->id)->get();
        $this->pegawai_id =  $pegawai->first()->id;
        $this->nip = $pegawai->first()->nip;
        $this->old_path = $pegawai->first()->path_photo;
        $this->alamat = $pegawai->first()->alamat;
        $this->no_wa = $pegawai->first()->no_wa;
    }
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'nama_lengkap' => 'required',
        ]);
    }
    private function resetInput()
    {
        $this->old_user = $this->nama_lengkap;
        $this->nama_lengkap = '';
        $this->email = '';
        $this->username = '';
        $this->path_photo = '';
        $this->user_id = '';
        $this->nip = '';
        $this->alamat = '';
        $this->no_wa = '';
        $this->pegawai_id;
    }
    public function updateProfil(Request $request)
    {
        $this->validate([
            'nama_lengkap' => 'required',
        ]);

        // if ($this->user_id != null && $this->pegawai_id != null) {
            $this_user = User::find($this->user_id);
            // if ($this->email != $this_user->email) {
            //     $this_user->email = $this->email;
            // }
            // if ($this->username != $this_user->username) {
            //     $this_user->username = $this->username;
            // }
            $this_user->username = $this->username;
            $this_user->email = $this->email;
            $this_user->name = $this->nama_lengkap;
            $this_user->save();
            $this_pegawai = Pegawai::where('id_user', $this->user_id);
            $path_photo = $this->path_photo->store('public/profil');
            $this_pegawai->update([
                'nip' => $this->nip,
                'alamat' => $this->alamat,
                'no_wa' => $this->no_wa,
                'id_user' => $this->user_id,
                'path_photo' => $path_photo
            ]);
        // }

        // if($request->hasFile('path_photo')){
        //     $filename = $request->image->getClientOriginalName();
        //     $request->path_photo->storeAs('images',$filename,'public');
        //     $this_pegawai = Pegawai::where('id_user', $this->user_id);
        //     $this_pegawai->update(['path_photo'=>$filename]);
        // }

        // if($request->hasFile('path_photo')){
        //     $filename = $request->path_photo->getClientOriginalName();
        //     $request->path_photo->storeAs('images',$filename,'public');
        //     $this_pegawai = Pegawai::where('id_user', $this->user_id);
        //     $this_pegawai->update(['path_photo'=>$filename]);
        // }

        $this->resetInput();
        $this->emit('profilStored', $this_user);
        return redirect()->route('profil-saya')->with('message', 'Profil Anda Telah Diperbarui');
        // $this->dispatchBrowserEvent('close-create-modal');
    }
    public function batal()
    {
        $this->resetInput();
        return redirect()->route('profil-saya');
    }

}
