<?php

namespace App\Http\Livewire\Admin;

use App\Models\Division;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Flasher\SweetAlert\Prime\SweetAlertFactory;

class UserIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $search;
    public $divisi;
    public $modal = "";

    protected $listeners = [
        'resetModal' => 'handleResetModal',
        'userStored' => 'handleStored',
        'userUpdated' => 'handleUpdated',
        'userDeleted' => 'handleDeleted'

    ];

    protected $queryString = [
        'search', 'divisi'
    ];


    public function mount()
    {
        $this->search = request()->query('search', $this->search);
        $this->divisi = request()->query('divisi', $this->divisi);
    }


    public function checkSearch()
    {
        if ($this->search == "") {
            $this->search = null;
        }

        if ($this->divisi == '0') {
            $this->divisi = null;
        }
    }


    public function addUser()
    {
        $this->modal = "create";
        $this->dispatchBrowserEvent('show-form');
    }


    public function editUser()
    {
        $this->modal = "edit";
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteUser($id)
    {
        $this->modal = "delete";
        $this->dispatchBrowserEvent('show-form');
        $this->emit('destroy', $id);
    }

    // public function getUserDelete($id)
    // {
    //     $this->deleteUser();
    // }

    public function getUser($id)
    {
        // $this->statusUpdate = true;
        $user = User::findOrFail($id);
        $this->editUser();
        $this->emit('getUser', $user);
    }


    public function handleResetModal()
    {
        $this->dispatchBrowserEvent('hide-form');
        $this->modal = "";
    }

    public function handleStored(SweetAlertFactory $flasher)
    {
        $this->handleResetModal();
        $flasher->addSuccess('You have successfully Added your User Data', '<h4> <b>  User Data Added</b></h4>');
    }

    public function handleUpdated(SweetAlertFactory $flasher)
    {
        $this->handleResetModal();
        $flasher->addSuccess('You have successfully updated your profile data', '<h4> <b>  Profile Updated!</b></h4>');
    }

    public function handleDeleted(SweetAlertFactory $flasher)
    {
        $this->handleResetModal();
        $flasher->addSuccess('You have successfully Delete the User', '<h4> <b>  User Deleted</b></h4>');
    }


    public function render()
    {

        $this->checkSearch();
        $data = [
            'users' => $this->search === null && $this->divisi === null ?
                User::latest()->paginate($this->paginate) :
                User::latest()->where('name', 'like', '%' . $this->search . '%')
                ->where('division_id', $this->divisi)
                ->paginate($this->paginate),
            'divisions' => Division::all()
        ];
        // dd   ($data);
        return view('livewire.admin.user-index', $data);
    }
}
