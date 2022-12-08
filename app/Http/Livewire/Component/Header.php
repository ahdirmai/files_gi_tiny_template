<?php

namespace App\Http\Livewire\Component;

use App\Models\Access;
use App\Models\BaseFolders;
use App\Models\Content;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Livewire\Component;

class Header extends Component
{
    public $name;
    public $user_id;
    public $modalProfile;
    public $passwordError;
    public $isNotification = false;

    protected $listeners = [
        'userProfileUpdated' => 'handleProfileUpdated',
        'userPassswordChanged' => 'handlePasswordChanged',
        'wrongOldPassword' => 'handleWrongOldPassword',
        'passwordChanged' => 'handlePasswordChanged',
        'resetModal' => 'handleResetModal',
        'hideHeader' => 'handleHideHeader',
        'requestAccept' => 'handleRequestAccept',
        'requestReject' => 'handleRequestReject'

    ];



    public function render()
    {
        $this->checkNotif();
        $this->name = auth()->user()->name;
        $data = [
            'name' => $this->name,
            'division' => (auth()->user()->division_id == null) ?
                '' : auth()->user()->division->name
        ];
        return view('livewire.component.header', $data);
    }

    public function handleHideHeader()
    {
        // $this->handleResetModal();
        // $this->modalProfile = "";
    }

    public function handleProfileUpdated($user, SweetAlertFactory $flasher)
    {
        $this->dispatchBrowserEvent('hide-form');
        $this->name = $user['name'];
        $flasher->addSuccess('You have successfully update your profile', '<h4> <b>  Profile Updated</b></h4>');
    }

    public function handleWrongOldPassword(SweetAlertFactory $flasher)
    {
        $this->dispatchBrowserEvent('hide-form');
        $flasher->addError('You have Failed changed your password', '<h4> <b> Password Failed Changed!</b></h4>');
    }

    public function handlePasswordChanged(SweetAlertFactory $flasher)
    {
        $this->dispatchBrowserEvent('hide-form');
        $flasher->addSuccess('You have successfully changed your password', '<h4> <b> Password Changed!</b></h4>');
    }


    public function handleResetModal()
    {
        $this->modalProfile = "";
        $this->dispatchBrowserEvent('hide-form');
    }

    public function handleRequestAccept(SweetAlertFactory $flasher)
    {
        // $this->dispatchBrowserEvent('hide-side');
        $this->checkNotif();
        $flasher->addSuccess('You have successfully Accept the request', '<h4> <b> Access Accepted!</b></h4>');
    }

    public function handleRequestReject(SweetAlertFactory $flasher)
    {
        // $this->dispatchBrowserEvent('hide-side');
        // $this->mount();
        $this->checkNotif();
        $flasher->addSuccess('You have successfully rejected the request', '<h4> <b> Access rejected!</b></h4>');
    }

    public function getProfile()
    {
        dd($this->isNotification);
        $this->modalProfile = "set-profile";
        $this->user_id = auth()->user()->id;
        $this->dispatchBrowserEvent('show-form');
        $this->emit('setProfile', $this->user_id);
    }

    public function getPassword()
    {
        $this->modalProfile = "set-password";
        $this->user_id = auth()->user()->id;
        $this->dispatchBrowserEvent('show-form');
        $this->emit('setPassword', $this->user_id);
    }

    public function getNotificaiton()
    {
        $this->modalProfile = "set-notification";
        $this->dispatchBrowserEvent('show-side');
        $this->user_id = auth()->user()->id;
        $this->emit('setNotification', $this->user_id);
    }

    public function checkNotif()
    {
        $baseFolder = Access::where('accessable_type', 'App\Models\BaseFolders')->whereIn('accessable_id', function ($query) {
            $query->select('id')
                ->from(with(new BaseFolders())->getTable())
                ->where('owner_id', auth()->user()->id);
        })->where('status', 'pending')->get();

        // $baseFolder->count();

        $folder = Access::where('accessable_type', 'App\Models\Content')->whereIn('accessable_id', function ($query) {
            $query->select('id')
                ->from(with(new Content())->getTable())
                ->where('owner_id',  auth()->user()->id)
                ->where('type', 'folder');
        })->where('status', 'pending')->get();

        $file = Access::where('accessable_type', 'App\Models\Content')->whereIn('accessable_id', function ($query) {
            $query->select('id')
                ->from(with(new Content())->getTable())
                ->where('owner_id',  auth()->user()->id)
                ->where('type', '!=', 'folder');
        })->where('status', 'pending')->get();


        if (count($baseFolder) >= 1 || count($folder) >= 1 || count($file) >= 1) {
            $this->isNotification = true;
        } else {
            $this->isNotification = false;
        }
    }
}
