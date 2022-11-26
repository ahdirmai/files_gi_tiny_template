<?php

namespace App\Http\Livewire\Pages\Dashboard;

use App\Models\Access;
use App\Models\BaseFolders;
use App\Models\Content;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class CreateFolder extends Component
{
    public $name, $folderAccessType = "public", $slug = "", $createType = "", $invitedUsers, $invitedAccess, $url;

    protected $listeners = [
        'setUploadType' => 'setCreateType'
    ];

    public function render()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->where('id', '!=', auth()->user()->id)->get();
        $permissions = Permission::all();

        $data = [
            'users' => $users,
            'permissions' => $permissions
        ];
        return view('livewire.pages.dashboard.create-folder', $data);
    }

    public function resetModal()
    {
        $this->name = "";
        $this->folderAccessType = "public";
        $this->emit('resetModal');
    }

    public function setCreateType($type)
    {
        if ($type == "file") {
            $this->createType = "file";
        } elseif ($type == 'folder') {
            $this->createType = "folder";
        } else {
            $this->createType = "url";
        };
    }

    public function createFolder($slug)
    {
        $this->validate([
            'name' => 'required|min:3',
            'folderAccessType' => 'required'
        ]);

        if ($slug) {
            $parent = BaseFolders::where('slug', $slug)->first();
            if (!$parent) {
                $parent = Content::where('slug', $slug)->first();
                $baseFolder_id = $parent->basefolder_id;
            } else {
                $baseFolder_id = $parent->id;
            }


            $content = new Content();
            $content->name = $this->name;
            $content->type = 'folder';
            $content->owner_id = auth()->user()->id;
            $content->slug = Str::random(32);
            $content->basefolder_id = $baseFolder_id;
            $content->access_type = $this->folderAccessType;
            $doneCreate = $parent->contents()->save($content);
            if ($doneCreate) {
                if ($this->invitedUsers != "") {
                    $newContent = Content::where('slug', $content->slug)->first();
                    $access = new Access();
                    $access->permission_id = $this->invitedAccess;
                    $access->user_id = $this->invitedUsers;
                    $this->status = 'accept';
                    $done = $newContent->accesses()->save($access);
                }
                $this->resetModal();
                $this->emit('folderStored');
            }
        } else {
            $folder = BaseFolders::create([
                'name' => $this->name,
                'owner_id' => auth()->user()->id,
                'access_type' => $this->folderAccessType,
                'slug' => Str::random(32)
            ]);
            if ($folder) {
                if ($this->invitedUsers != "") {
                    $access = new Access();
                    $access->permission_id = $this->invitedAccess;
                    $access->user_id = $this->invitedUsers;
                    $this->status = 'accept';
                    $done = $folder->accesses()->save($access);
                }

                $this->resetModal();
                $this->emit('folderStored');
            };
        };
    }

    public function createFile($slug)
    {
        $this->validate([
            'name' => 'required|min:3',
            'folderAccessType' => 'required'
        ]);

        $parent = BaseFolders::where('slug', $slug)->first();
        if (!$parent) {
            $parent = Content::where('slug', $slug)->first();
            $baseFolder_id = $parent->basefolder_id;
        } else {
            $baseFolder_id = $parent->id;
        }

        $content = new Content(); //bikin object content
        $content->name = $this->name; // mengisi content->name dengan request name
        $content->type = 'file'; //mengisi content->type dengan file
        $content->owner_id = auth()->user()->id; //mengisi owner_id dengan user yang login
        $content->slug = Str::random(32); //mengisi slug dengan $slugContent
        $content->url = $this->url;
        $content->basefolder_id = $baseFolder_id; //mengisi basefolder_id dengan $baseFolder
        $content->access_type = $this->folderAccessType;
        $doneUploadFile = $parent->contents()->save($content);
        if ($doneUploadFile) {
            if ($this->invitedUsers != "") {
                $newContent = Content::where('slug', $content->slug)->first();
                $access = new Access();
                $access->permission_id = $this->invitedAccess;
                $access->user_id = $this->invitedUsers;
                $this->status = 'accept';
                $done = $newContent->accesses()->save($access);
            }
            $this->resetModal();
            $this->emit('fileStored');

            // if ($request->hasFile('file')) {
            //     $done = $doneUploadFile->addMediaFromRequest('file')->toMediaCollection('file');
            //     if ($done) {
            //         if ($request->FileisPrivate == 'private') {
            //             if ($request->invitedUser) {
            //                 $data_access = [
            //                     'content_id' => $doneUploadFile->id,
            //                     'permission_id' => $request->accessType,
            //                     'user_id' => $request->invitedUser,
            //                     'status' => 'accept'
            //                 ];
            //                 $accessDone = ContentAccess::create($data_access);
            //                 if ($accessDone) {
            //                     activity()->causedBy(auth()->user())->performedOn($doneUploadFile)->log('Upload File');
            //                     $flasher->addSuccess('File has been Uploaded successfully!');
            //                     return redirect()->route('EnterFolder', $request->parentSlug);
            //                 }
            //             }
            //         }

            //         activity()->causedBy(auth()->user())->performedOn($doneUploadFile)->log('Upload File');
            //         $flasher->addSuccess('File has been Uploaded successfully!');
            //         return redirect()->route('EnterFolder', $request->parentSlug);
            //     }
            // }
        }
    }

    public function createURL($slug)
    {
        $this->validate([
            'name' => 'required|min:3',
            'folderAccessType' => 'required'
        ]);

        $parent = BaseFolders::where('slug', $slug)->first();
        if (!$parent) {
            $parent = Content::where('slug', $slug)->first();
            $baseFolder_id = $parent->basefolder_id;
        } else {
            $baseFolder_id = $parent->id;
        }
        $content = new Content();
        $content->name = $this->name;
        $content->type = 'url';
        $content->owner_id = auth()->user()->id;
        $content->slug = Str::random(32);
        $content->basefolder_id = $baseFolder_id;
        $content->access_type = $this->folderAccessType;
        $doneUploadFile = $parent->contents()->save($content);
        if ($doneUploadFile) {
            if ($this->invitedUsers != "") {
                $newContent = Content::where('slug', $content->slug)->first();
                $access = new Access();
                $access->permission_id = $this->invitedAccess;
                $access->user_id = $this->invitedUsers;
                $this->status = 'accept';
                $done = $newContent->accesses()->save($access);
            }
            $this->resetModal();
            $this->emit('urlStored');
        }
    }
}
