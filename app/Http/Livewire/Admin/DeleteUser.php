<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class DeleteUser extends Component
{

    public $user_id, $username;
    protected $listeners = [
        'destroy' => 'setDestroy'
    ];

    public function render()
    {
        return view('livewire.admin.delete-user');
    }


    public function resetModal()
    {
        $this->emit('resetModal');
    }

    public function setDestroy($id)
    {
        $this->user_id = $id;
    }

    public function delete()
    {
        $user = User::findOrFail($this->user_id);
        $this->username = $user->name;
        $user->delete();
        $this->resetModal();
        $this->emit('userDeleted');
    }
}
