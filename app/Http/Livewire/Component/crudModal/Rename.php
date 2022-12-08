<?php

namespace App\Http\Livewire\Component\crudModal;

use App\Models\BaseFolders;
use App\Models\Content;
use Livewire\Component;

class Rename extends Component
{

    public $name, $slug;

    protected $listeners = [
        'setFolderName' => 'showFolderName'
    ];
    public function render()
    {
        return view('livewire.component.crud-modal.rename');
    }
    public function showFolderName($folder)
    {
        $this->name = $folder['name'];
        $this->slug = $folder['slug'];
    }

    public function renameFolder()
    {
        $folder = BaseFolders::where('slug', $this->slug)->first();
        if (!$folder) {
            $folder = Content::where('slug', $this->slug)->first();
        };
        $this->validate([
            'name' => 'required|min:3',
        ]);

        $done = $folder->update([
            'name' => $this->name,
        ]);

        if ($done) {
            $this->resetModal();
            $this->emit('folderRenamed');
            activity()
                ->causedBy(auth()->user())
                ->performedOn($folder)
                ->withProperties(['slug' => $folder->slug])
                ->log('Rename Content');
        };
    }

    public function resetModal()
    {
        $this->name = "";
        $this->emit('resetModal');
    }
}
