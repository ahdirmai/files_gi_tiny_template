<?php

namespace App\Http\Livewire\Component\crudModal;

use App\Models\Access;
use App\Models\BaseFolders;
use App\Models\Content;
use App\Models\Permission;
use App\Models\User;
use Livewire\Component;

class Manage extends Component
{
    public $name, $folderAccessType, $slug, $invitedUsers, $invitedAccess = "1", $users;
    public $userHaveAccess, $idUserHaveAccess;

    protected $listeners = [
        'setFolderManage' => 'showFolderManage'
    ];


    public function render()
    {

        $permission = Permission::all();
        $data = [
            'permission' => $permission,
            // 'users' => $users
        ];

        return view('livewire.component.crud-modal.manage', $data);
    }

    public function showFolderManage($slug)
    {
        $folder = BaseFolders::where('slug', $slug)->first();
        if (!$folder) {
            $folder = Content::where('slug', $slug)->first();
        }

        $this->name = $folder->name;
        $this->slug = $folder->slug;
        $this->folderAccessType = $folder->access_type;
        $this->userHaveAccess = $folder->accesses->where('status', 'accept');
        $this->idUserHaveAccess = $folder->accesses->where('status', 'accept')->pluck('user_id');


        $this->users = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->where('id', '!=', auth()->user()->id)
            ->where(function ($q) {
                $q->whereNotIn('id', $this->idUserHaveAccess);
            })->get();
    }

    public function manageFolder()
    {
        $this->validate([
            'folderAccessType' => 'required'
        ]);

        $folder = getFolder($this->slug);

        $done = $folder->update([
            'access_type' => $this->folderAccessType
        ]);

        if ($done) {
            if ($this->folderAccessType == "public") {
                foreach ($folder->accesses as $access) {
                    $access->forceDelete();
                }
            } else {
                if ($this->invitedUsers) {
                    $dataInvited = new Access();
                    $dataInvited->permission_id = $this->invitedAccess;
                    $dataInvited->user_id = $this->invitedUsers;
                    $dataInvited->status = 'accept';
                    $done = $folder->accesses()->save($dataInvited);
                }
            }
            $this->resetModal();
            $this->emit('storeFolderManage');
            activity()
                ->causedBy(auth()->user())
                ->performedOn($folder)
                ->withProperties(['slug' => $folder->slug])
                ->log('Manage Content');
        }
    }


    public function resetModal()
    {
        $this->name = "";
        $this->slug = "";
        $this->folderAccessType = "";
        $this->emit('resetModal');
    }
}
