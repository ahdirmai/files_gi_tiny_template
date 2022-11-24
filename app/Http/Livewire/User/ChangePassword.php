<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $user_id;
    public $old_password, $new_password, $new_password_confirmation;

    protected $listeners = [
        'setPassword' => 'getPassword',
    ];

    public function render()
    {
        return view('livewire.user.change-password');
    }

    public function getPassword($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
    }

    public function storeChangePassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($this->old_password, auth()->user()->password)) {
            $this->emit('wrongOldPassword');
        } else {
            User::whereId($this->user_id)->update([
                'password' => Hash::make($this->new_password)
            ]);
            $this->emit('passwordChanged');
        }
    }
}
