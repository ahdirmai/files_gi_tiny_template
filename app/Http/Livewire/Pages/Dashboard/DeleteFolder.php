<?php

namespace App\Http\Livewire\Pages\Dashboard;

use App\Models\BaseFolders;
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
        $folder = BaseFolders::where('slug', $this->slug);
        // $this->username = $user->name;
        // $user->delete();

        $folder->delete();
        $this->resetModal();
        $this->emit('folderDeleted');
    }
}
