<?php

namespace App\Http\Livewire\Pages\Dashboard;

use App\Models\BaseFolders;
use App\Models\Content;
use Livewire\Component;

class DeleteFolder extends Component
{

    public $slug;
    protected $listeners = [
        'deleteFolder' => 'setDeleteFolder'
    ];

    public function render()
    {
        return view('livewire..pages.dashboard.delete-folder');
    }

    public function resetModal()
    {
        $this->emit('resetModal');
    }

    public function setDeleteFolder($slug)
    {
        $this->slug = $slug;
    }

    public function deleteFolder()
    {
        $folder = BaseFolders::where('slug', $this->slug)->first();

        if (!$folder) {
            $folder = Content::where('slug', $this->slug)->first();
        }

        $deleted = $folder->delete();
        $this->resetModal();
        $this->emit('folderDeleted');
        activity()
            ->causedBy(auth()->user())
            ->performedOn($deleted)
            ->log('Delete Content');
    }
}
