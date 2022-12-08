<?php

namespace App\Http\Livewire\Component;

use App\Models\BaseFolders;
use App\Models\Content;
use Livewire\Component;

class DetailPanel extends Component
{
    public $name, $owner, $access_type, $created_at, $updated_at, $type, $filename, $haveAccess;

    protected $listeners = [
        'setDetailFolder' => 'showDetailFolder'
    ];
    public function render()
    {
        return view('livewire.component.detail-panel');
    }

    public function showDetailFolder($slug)
    {
        $content = getFolder($slug);
        $this->name = $content->name;
        $this->owner = $content->user->name;
        $this->type = $content->type;
        $this->access_type = $content->access_type;
        $this->created_at = $content->created_at;
        $this->updated_at = $content->updated_at;
        $this->haveAccess = $content->accesses;

        // dd($this->haveAccess);
        if ($this->type == 'file') {
            $this->filename = $content->getMedia($content->contentable->slug)->first()->file_name;
        }
    }
}
