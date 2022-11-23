<?php

namespace App\Http\Livewire\Admin;

use App\Models\Division;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    public $name = "", $username = "", $password = "", $division_id = "";
    public $status = "";
    public $data;

    public function render()
    {

        $data = [
            'divisions' => Division::all()
        ];
        return view('livewire.admin.create-user', $data);
    }

    public function resetModal()
    {
        $this->name = "";
        $this->username = "";
        $this->password = "";
        $this->division_id = "";
        $this->emit('resetModal');
    }

    public function create()
    {
        $this->validate([
            'name' => 'required|min:3',
            'username' => 'required|min:8',
            'password' => 'required',
            'division_id' => 'required|'
        ]);

        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'division_id' => $this->division_id
        ]);

        if ($user) {
            $user->assignRole('user');
            // $this->status = "Masuk di Create";
            $this->emit('userStored');
            $this->resetModal();
        }
    }
}
