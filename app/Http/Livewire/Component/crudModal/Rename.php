<?php

namespace App\Http\Livewire\Component\crudModal;

use App\Models\BaseFolders;
use App\Models\Content;
use Livewire\Component;

class Rename extends Component
{

    public $name, $slug, $type = "";

    protected $listeners = [
        'setContentName' => 'showContentName'
    ];
    public function render()
    {
        return view('livewire.component.crud-modal.rename');
    }

    public function showContentName($slug)
    {

        $content = BaseFolders::where('slug', $slug)->first();
        // dd($content);
        if (!$content) {
            $content = Content::where('slug', $slug)->first();
            // dd($content->type);
            $this->type = $content->type;
        };
        $this->name = $content->name;
        $this->slug = $content->slug;
    }



    public function renameFolder()
    {
        $content = BaseFolders::where('slug', $this->slug)->first();
        if (!$content) {
            $content = Content::where('slug', $this->slug)->first();
        };

        $this->validate([
            'name' => 'required|min:3',
        ]);

        $done = $content->update([
            'name' => $this->name,
        ]);

        if ($done) {
            $this->resetModal();
            $this->emit('contentRenamed', $this->type);
            activity()
                ->causedBy(auth()->user())
                ->performedOn($content)
                ->withProperties(['slug' => $content->slug])
                ->log('Rename ' . $this->type);
        };
    }

    public function resetModal()
    {
        $this->name = "";
        $this->emit('resetModal');
    }
}
