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
    public $name, $contentAccessType, $slug, $invitedUsers, $invitedAccess = "1", $users, $type;
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
        $content = BaseFolders::where('slug', $slug)->first();

        // dd($)
        if (!$content) {
            $content = Content::where('slug', $slug)->first();
            $this->type = $content->type;
        } else {
            $this->type = "folder";
        }

        $this->name = $content->name;
        $this->slug = $content->slug;
        $this->contentAccessType = $content->access_type;
        $this->userHaveAccess = $content->accesses->where('status', 'accept');
        $this->idUserHaveAccess = $content->accesses->where('status', 'accept')->pluck('user_id');
        // $this->type = $content->type;
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
            'contentAccessType' => 'required'
        ]);

        $content = getFolder($this->slug);

        $done = $content->update([
            'access_type' => $this->contentAccessType
        ]);

        if ($done) {
            if ($this->contentAccessType == "public") {
                foreach ($content->accesses as $access) {
                    $access->forceDelete();
                }
            } else {
                if ($this->invitedUsers) {
                    $dataInvited = new Access();
                    $dataInvited->permission_id = $this->invitedAccess;
                    $dataInvited->user_id = $this->invitedUsers;
                    $dataInvited->status = 'accept';
                    $done = $content->accesses()->save($dataInvited);
                }
            }
            $this->resetModal();
            $this->emit('storeFolderManage', $this->type);
            activity()
                ->causedBy(auth()->user())
                ->performedOn($content)
                ->withProperties(['slug' => $content->slug])
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
