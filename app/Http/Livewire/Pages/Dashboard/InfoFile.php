<?php

namespace App\Http\Livewire\Pages\Dashboard;

use Livewire\Component;

class InfoFile extends Component
{
    public $name, $slug = "", $url;

    protected $listeners = [
        'setFile' => 'showFileInfo'
    ];


    public function render()
    {
        return view('livewire..pages.dashboard.info-file');
    }

    public function showFileInfo($slug)
    {
        $folder = getFolder($slug);
        if ($folder->type == "url") {
            $this->url = $folder->url;
        } else {
            $this->url = "";
        }
        $this->slug = $slug;
    }
}
