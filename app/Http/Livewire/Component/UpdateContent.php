<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class UpdateContent extends Component
{

    public $slug, $name, $url, $type;

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
        $this->slug = $slug;

        $this->name = $content->name;
        $this->url = $content->url;
        $this->type = $content->type;
        // dd($slug);
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
