<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class ShowVersion extends Component
{
    public $slug, $content, $versions, $url;
    protected $listeners = [
        'showVersion' => 'showVersion'
    ];
    public function render()
    {
        return view('livewire..component.show-version');
    }

    public function showVersion($slug)
    {
        $this->slug = $slug;
        $this->content = getFolder($slug);
        $this->url = $this->content->url;
        $this->versions = Activity::where('properties->slug', $this->slug)->where('description', 'like', '%Update%')->latest()->get();
    }
}
