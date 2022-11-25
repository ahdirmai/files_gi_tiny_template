<?php

namespace App\Http\Livewire\Pages\Dashboard;

use App\Models\BaseFolders;
use Livewire\Component;
use Illuminate\Support\Str;


class CreateFolder extends Component
{
    public $name, $folderAccessType = "public";

    public function render()
    {
        return view('livewire.pages.dashboard.create-folder');
    }

    public function resetModal()
    {
        $this->name = "";
        $this->folderAccessType = "public";
        $this->emit('resetModal');
    }

    public function createFolder()
    {
        // dd($this->folderAccessType);
        $this->validate([
            'name' => 'required|min:3',
            'folderAccessType' => 'required'
        ]);



        // dd($this->name);
        $folder = BaseFolders::create([
            'name' => $this->name,
            'owner_id' => auth()->user()->id,
            'access_type' => $this->folderAccessType,
            'slug' => Str::random(32)
        ]);
        if ($folder) {
            $this->resetModal();
            $this->emit('folderStored');
        };
    }
}
