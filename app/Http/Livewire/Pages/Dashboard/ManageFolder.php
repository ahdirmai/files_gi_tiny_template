<?php

namespace App\Http\Livewire\Pages\Dashboard;

use App\Models\BaseFolders;
use App\Models\Content;
use Livewire\Component;

class ManageFolder extends Component
{
    public $name, $folderAccessType, $slug;

    protected $listeners = [
        'setFolderManage' => 'showFolderManage'
    ];

    public function render()
    {
        return view('livewire..pages.dashboard.manage-folder');
    }

    public function showFolderManage($folder)
    {
        $this->slug = $folder['slug'];
        $this->name = $folder['name'];
        $this->folderAccessType = $folder['access_type'];
    }

    public function manageFolder()
    {
        $this->validate([
            'folderAccessType' => 'required'
        ]);

        $folder = BaseFolders::where('slug', $this->slug)->first();
        if (!$folder) {
            $folder = Content::where('slug', $this->slug)->first();
        }

        // dd($folder);

        $done = $folder->update([
            'access_type' => $this->folderAccessType
        ]);

        if ($done) {
            $this->resetModal();
            $this->emit('storeFolderManage');
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
