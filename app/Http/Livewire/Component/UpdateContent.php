<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateContent extends Component
{

    use WithFileUploads;
    public $slug, $name, $url, $type, $content, $newFile, $oldFile;

    protected $listeners = [
        'setContent' => 'showUpdateContent'
    ];
    public function render()
    {
        return view('livewire..component.update-content');
    }

    public function showUpdateContent($slug)
    {
        $content = getFolder($slug);
        $this->content = $content;
        $this->slug = $slug;
        $this->name = $content->name;
        $this->url = $content->url;
        $this->type = $content->type;
        // dd($content->getMedia($content->contentable->slug)->first());
        if ($this->type == "file") {
            $this->oldFile =  $content->getMedia($content->contentable->slug)->first();
            // dd($this->oldFile->file_name);
        }
    }

    public function updateURL()
    {
        $this->validate([
            'url' => 'required|min:3'
        ]);
        $content = getFolder($this->slug);
        $doneUpdate =  $content->update([
            'url' => $this->url
        ]);

        if ($doneUpdate) {
            $this->resetModal();
            $this->emit('URLUpdated');
            activity()
                ->causedBy(auth()->user())
                ->performedOn($content)
                ->withProperties(['slug' => $content->slug])
                ->log('Update URL');
        }
    }

    public function resetModal()
    {
        $this->name = "";
        $this->emit('resetModal');
    }
}
