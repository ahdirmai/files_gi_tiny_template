<?php

namespace App\Http\Livewire\Pages\Dashboard;

use App\Models\BaseFolders;
use Livewire\Component;

class RenameFolder extends Component
{

    public $name, $slug;

    protected $listeners = [
        'setFolderName' => 'showFolderName'
    ];
    public function render()
    {
        return view('livewire.pages.dashboard.rename-folder');
    }
    public function showFolderName($folder)
    {
        $this->name = $folder['name'];
        $this->slug = $folder['slug'];
    }

    public function renameFolder()
    {
        $folder = BaseFolders::where('slug', $this->slug);
        $this->validate([
            'name' => 'required|min:3',
        ]);

        $done = $folder->update([
            'name' => $this->name,
        ]);
        if ($done) {
            $this->resetModal();
            $this->emit('folderRenamed');
        };
    }

    public function resetModal()
    {
        $this->name = "";
        $this->emit('resetModal');
    }
}
