<?php

namespace App\Http\Livewire\Component;

use App\Models\BaseFolders;
use App\Models\Content;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\Activitylog\Models\Activity;

class DetailPanel extends Component
{
    public $name, $owner, $access_type, $created_at, $updated_at, $type, $filename, $haveAccess, $slug, $activity, $timeFilter = 0;

    // public $text = '';

    public $tab = 'detail';
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
        $this->slug = $slug;

        $this->getActivity();

        if ($this->type == 'file') {
            $this->filename = $content->getMedia($content->contentable->slug)->first()->file_name;
        }
    }

    public function getActivity()
    {
        if ($this->timeFilter == '0') {
            $this->activity = Activity::where('properties->slug', $this->slug)->latest()->get();
        } elseif ($this->timeFilter == '1') {
            $this->activity = Activity::where('properties->slug', $this->slug)->whereDate('created_at', Carbon::today())->latest()->get();
        } else {
            $this->activity = Activity::where('properties->slug', $this->slug)->whereDate('created_at', Carbon::yesterday())->latest()->get();
        }
    }
    public function changeEvent($value)
    {
        $this->timeFilter = $value;
        $this->getActivity();
    }

    public function setAct($value)
    {
        $this->tab = $value;
        $this->timeFilter = "0";
        $this->getActivity();
    }
}
