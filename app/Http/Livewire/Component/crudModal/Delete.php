<?php

namespace App\Http\Livewire\Component\crudModal;

use App\Models\BaseFolders;
use App\Models\Content;
use Livewire\Component;

class Delete extends Component
{

    public $slug, $name, $type;
    protected $listeners = [
        'deleteFolder' => 'setDeleteFolder'
    ];

    public function render()
    {
        return view('livewire.component.crud-modal.delete');
    }

    public function resetModal()
    {
        $this->emit('resetModal');
    }

    public function setDeleteFolder($slug)
    {
        $content = BaseFolders::where('slug', $slug)->first();

        if (!$content) {
            $content = Content::where('slug', $slug)->first();
            $this->type = $content->type;
        } else {
            $this->type = "folder";
        }
        $this->name = $content->name;
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
            ->performedOn($folder)
            ->withProperties(['slug' => $folder->slug])
            ->log('Delete Content');
    }
}
