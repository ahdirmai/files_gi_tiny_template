<?php

namespace App\Http\Livewire\Component;

use App\Models\Access;
use App\Models\Permission;
use Livewire\Component;

class RequestAccess extends Component
{
    public $slug, $name;
    public $permission_id = "1";
    protected $listeners = [
        'setRequestAccess' => 'showRequestAccess'
    ];
    public function render()
    {

        $data = [
            'permissions' => Permission::all()
        ];
        return view('livewire.component.request-access', $data);
    }

    public function resetModal()
    {
        $this->emit('resetModal');
    }

    public function showRequestAccess($slug)
    {
        $folder = getFolder($slug);
        $this->slug = $slug;
        $this->name = $folder->name;
    }

    public function requestAccess()
    {
        $param = "";
        $folder = getFolder($this->slug);
        $dataInvited = new Access();
        $dataInvited->permission_id = $this->permission_id;
        $dataInvited->user_id = auth()->user()->id;

        $isRejected = $folder->accesses->where('permission_id', $this->permission_id)->where('user_id', auth()->user()->id)->first();
        if ($isRejected) {

            Access::findOrFail($isRejected->id)->update([
                'status' => 'pending'
            ]);
            $this->resetModal();
            $this->emit('storeRequestAccess');
        } else {
            $dataInvited->status = 'pending';
            $done = $folder->accesses()->save($dataInvited);

            $this->resetModal();
            $this->emit('storeRequestAccess');
        }
    }
}
