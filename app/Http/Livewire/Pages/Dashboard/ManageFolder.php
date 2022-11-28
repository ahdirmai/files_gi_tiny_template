<?php

namespace App\Http\Livewire\Pages\Dashboard;

use App\Models\BaseFolders;
use App\Models\Content;
use Livewire\Component;

class ManageFolder extends Component
{
    public $name, $folderAccessType, $slug, $invitedUsers, $invitedAccess;
    public $userHaveAccess;

    protected $listeners = [
        'setFolderManage' => 'showFolderManage'
    ];


    public function render()
    {

        return view('livewire..pages.dashboard.manage-folder');
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


        // foreach ($this->fols as $ss) {
        //     dd()
        // }

        // $this->userHaveAccess = $folder->accesses->toArray();
        // dd($folder->accesses->first()->user->name);

        // foreach ($folder->accesses-> as $access) {
        //     $i = 0;
        //     $haveAccess = [
        //         $i => [
        //             'user_id' => $access->id,
        //             'name' => $access->user->name,
        //             'permission_id' => $access->permission_id,
        //             'permission' => $access->permission->name
        //         ]
        //     ];
        //     $i++;
        // };
        // dd($this->userHaveAccess);


        // $fold = Content::where('slug', $this->slug)->first();
    }

    public function manageFolder()
    {
        // dd($this->slug);
        $this->validate([
            'folderAccessType' => 'required'
        ]);

        $folder = getFolder($this->slug);

        $done = $folder->update([
            'access_type' => $this->folderAccessType
        ]);

        if ($done) {
            if ($this->folderAccessType == "public") {
            }
            // if ($this->folderAccessType == 'private') {
            //     if ($invitedUser) {
            //         $data_access = [
            //             'content_id' => $doneCreate->id,
            //             'permission_id' => $request->accessType,
            //             'user_id' => $request->invitedUser,
            //             'status' => 'accept'
            //         ];
            //         $accessDone = ContentAccess::create($data_access);
            //         if ($accessDone) {
            //             activity()->causedBy(auth()->user())->performedOn($doneCreate)->log('Create Folder');
            //             $flasher->addSuccess('Folder has been Create successfully!');
            //             return redirect()->route('EnterFolder', $request->parentSlug);
            //         }
            //     }
            // }
            $this->resetModal();
            $this->emit('storeFolderManage');
            activity()
                ->causedBy(auth()->user())
                ->performedOn($folder)
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
