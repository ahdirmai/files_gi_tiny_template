<?php

namespace App\Http\Livewire\Pages\Trash;

use App\Models\BaseFolders;
use Livewire\Component;
use Livewire\WithPagination;

class TrashIndex extends Component
{

    use WithPagination;
    public $ContainerDetailStatus = "";
    public $FolderSelected = "";
    public $modal = "";
    // public $page = 'trash';


    public function render()
    {
        $trashBase = BaseFolders::where('owner_id', auth()->user()->id)->onlyTrashed()->latest()->paginate(4);
        $data = [
            'baseFolders' => $trashBase
        ];
        return view('livewire..pages.trash.trash-index', $data);
    }
}
