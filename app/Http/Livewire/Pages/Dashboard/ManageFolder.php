<?php

namespace App\Http\Livewire\Pages\Dashboard;

use App\Models\BaseFolders;
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
        // dd($folder['slug']);
        // $folder = BaseFolders::where('slug', $slug)->first();
        $this->slug = $folder['slug'];
        $this->name = $folder['name'];
        $this->folderAccessType = $folder['access_type'];
    }

    public function manageFolder()
    {
        $this->validate([
            'folderAccessType' => 'required'
        ]);

        $folder = BaseFolders::where('slug', $this->slug);

        $done = $folder->update([
            'access_type' => $this->folderAccessType
        ]);

        if ($done) {
            $this->resetModal();
            $this->emit('storeFolderManage');
        }
        // dd('masuk');
    }


    public function resetModal()
    {
        $this->name = "";
        $this->slug = "";
        $this->folderAccessType = "";
        $this->emit('resetModal');
    }
}
