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

        // dd($slug);
        $folder = getFolder($slug);
        // dd($folder->type);
        if ($folder->type == "url") {
            $this->url = $folder->url;
        } else {
            $this->url = "";
        }
        // dd($this->url);
        $this->slug = $slug;
    }
}
