<?php

namespace App\Http\Livewire\Pages\Dashboard;

use App\Models\BaseFolders;
use App\Models\Content;
use Livewire\Component;
use Illuminate\Support\Str;


class CreateFolder extends Component
{
    public $name, $folderAccessType = "public", $slug = "";

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
                $this->resetModal();
                $this->emit('folderStored');
            };
        };



        // dd($this->name);

    }
}
