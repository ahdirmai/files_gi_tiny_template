<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ResetPassword extends Component
{
    public $user_id;
    protected $listeners = [
        'reset' => 'setReset'
    ];
    public function render()
    {
        return view('livewire.admin.reset-password');
    }

    public function resetModal()
    {
        $this->emit('resetModal');
    }

    public function setReset($id)
    {
        $this->user_id = $id;
    }

    public function resetPassword()
    {
        $user = User::findOrFail($this->user_id);
        // $this->username = $user->name;
        // $user->delete();

        $user->update([
            'password' => Hash::make('password')
        ]);
        $this->resetModal();
        $this->emit('passwordReseted');
    }
}
