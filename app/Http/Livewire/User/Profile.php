<?php

namespace App\Http\Livewire\User;

use App\Models\Division;
use App\Models\User;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Livewire\Component;

class Profile extends Component
{

    public $user_id, $name, $username, $division_id;

    protected $listeners = [
        'setProfile' => 'showProfile',
    ];

    public function render()
    {
        $divisi = Division::all();
        $data = [
            'divisions' => $divisi
        ];
        return view('livewire.user.profile', $data);
    }

    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->division_id = $user->division_id;
    }

    public function storeUpdateProfile()
    {

        $this->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:8',
            'division_id' => 'required'
        ]);

        if ($this->user_id) {
            $user = User::findOrFail($this->user_id);

            $user->update([
                'name' => $this->name,
                'username' => $this->username,
                'division_id' => $this->division_id
            ]);
            // dd($user);
            $this->emit('userProfileUpdated', $user);
        }
    }

    public function resetModal()
    {
        $this->user_id = "";
        $this->name = "";
        $this->username = "";
        $this->password = "";
        $this->division_id = "";
        $this->emit('resetModal');
    }
}
