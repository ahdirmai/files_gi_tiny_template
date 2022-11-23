<?php

namespace App\Http\Livewire\Admin;

use App\Models\Division;
use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $name, $username, $user_id, $division_id;

    protected $listeners = [
        'getUser' => 'showUser'
    ];

    public function render()
    {
        $data = [
            'divisions' => Division::all()
        ];
        return view('livewire.admin.edit-user', $data);
    }

    public function resetModal()
    {
        $this->name = "";
        $this->username = "";
        $this->password = "";
        $this->division_id = "";
        $this->emit('resetModal');
    }


    public function showUser($user)
    {
        $this->user_id = $user['id'];
        $this->name = $user['name'];
        $this->username = $user['username'];
        $this->division_id = $user['division_id'];
    }

    public function update()
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

            $this->resetModal();
            $this->emit('userUpdated');
        }
    }
}
