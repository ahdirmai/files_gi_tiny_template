<?php

namespace App\Http\Livewire\Component;

use App\Models\Access;
use App\Models\BaseFolders;
use App\Models\Content;
use Livewire\Component;

class Notification extends Component
{
    public $user_id;

    protected $listeners = [
        'setNotification' => 'showNotificaiton'
    ];
    public function render()
    {
        $baseFolder = Access::where('accessable_type', 'App\Models\BaseFolders')->whereIn('accessable_id', function ($query) {
            $query->select('id')
                ->from(with(new BaseFolders())->getTable())
                ->where('owner_id', $this->user_id);
        })->where('status', 'pending')->get();

        $folder = Access::where('accessable_type', 'App\Models\Content')->whereIn('accessable_id', function ($query) {
            $query->select('id')
                ->from(with(new Content())->getTable())
                ->where('owner_id', $this->user_id)
                ->where('type', 'folder');
        })->where('status', 'pending')->get();

        $file = Access::where('accessable_type', 'App\Models\Content')->whereIn('accessable_id', function ($query) {
            $query->select('id')
                ->from(with(new Content())->getTable())
                ->where('owner_id', $this->user_id)
                ->where('type', '!=', 'folder');
        })->where('status', 'pending')->get();

        $data = [
            'BaseFolderRequest' => $baseFolder,
            'FolderRequest' => $folder,
            'FileRequest' => $file
        ];

        return view('livewire.component.notification', $data);
    }

    public function showNotificaiton($user_id)
    {
        $this->user_id = $user_id;
        // $folder = Access::where('accessable_type', 'App\Models\Content')->whereIn('accessable_id', function ($query) {
        //     $query->select('id')
        //         ->from(with(new Content())->getTable())
        //         ->where('owner_id', $this->user_id)
        //         ->where('type', 'folder');
        // })->where('status', 'pending')->get();
        // dd($folder->first()->accessable);
    }

    public function accept($id)
    {
        $access = Access::findOrFail($id);
        $done = $access->update([
            'status' => 'accept'
        ]);
        if ($done) {
            $this->emit('requestAccept');
        }
    }

    public function reject($id)
    {
        $access = Access::findOrFail($id);
        $done = $access->update([
            'status' => 'reject'
        ]);
        if ($done) {
            $this->emit('requestReject');
        }
    }
}
