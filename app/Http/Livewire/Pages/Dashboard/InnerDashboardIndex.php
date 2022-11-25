<?php

namespace App\Http\Livewire\Pages\Dashboard;

use App\Models\BaseFolders;
use App\Models\Content;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Livewire\Component;
use Livewire\WithPagination;

class InnerDashboardIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $slug, $modal;

    protected $listeners = [
        'resetModal' => 'handleResetModal',
        'folderStored' => 'handleStored',
        'folderRenamed' => 'handleRenamed',
        'storeFolderManage' => 'handleManaged',
        'folderDeleted' => 'handleFolderDeleted'
    ];

    public function render()
    {
        $parent = BaseFolders::where('slug', $this->slug)->first();
        if (!$parent) {
            $parent = Content::where('slug', $this->slug)->first();
        }
        $folders = $parent->contents();

        $data = [
            'content' => $folders->latest()->paginate(6, '*', 'folderPage'),
            'folder' => $parent,
        ];
        return view('livewire..pages.dashboard.inner-dashboard-index', $data);
    }

    public function createFolder()
    {
        $this->modal = "create";
        $this->dispatchBrowserEvent('show-form');
    }

    public function renameFolder()
    {
        $this->modal = "rename";
        $this->dispatchBrowserEvent('show-form');
    }

    public function manageFolder()
    {
        $this->modal = "manage";
        $this->dispatchBrowserEvent('show-form');
    }

    public function deleteFolder()
    {
        $this->modal = "delete";
        $this->dispatchBrowserEvent('show-form');
    }


    public function getDetail($slug)
    {
        $this->dispatchBrowserEvent('show-side');
        $this->emit('setDetailFolder', $slug);
    }

    public function getRename($slug)
    {
        $folder = BaseFolders::where('slug', $slug)->first();

        if (!$folder) {
            $folder = Content::where('slug', $slug)->first();
        }
        $this->emit('setFolderName', $folder);
        $this->renameFolder();
    }

    public function getManage($slug)
    {
        $folder = BaseFolders::where('slug', $slug)->first();

        if (!$folder) {
            $folder = Content::where('slug', $slug)->first();
        }
        $this->emit('setFolderManage', $folder);
        $this->manageFolder();
    }

    public function getDelete($slug)
    {
        $this->emit('deleteFolder', $slug);
        $this->deleteFolder();
    }

    public function handleResetModal()
    {
        $this->dispatchBrowserEvent('hide-form');
        $this->modal = "";
    }

    public function handleStored(SweetAlertFactory $flasher)
    {
        $this->handleResetModal();
        $flasher->addSuccess('You have successfully Added Folder', '<h4> <b>  Folder Added!</b></h4>');
    }

    public function handleRenamed(SweetAlertFactory $flasher)
    {
        $this->handleResetModal();
        $flasher->addSuccess('You have successfully Rename Folder', '<h4> <b>  Rename Folder Success!!</b></h4>');
    }

    public function handleManaged(SweetAlertFactory $flasher)
    {
        $this->handleResetModal();
        $flasher->addSuccess('You have successfully updated your Folder', '<h4> <b>  Folder Updated!!</b></h4>');
    }

    public function handleFolderDeleted(SweetAlertFactory $flasher)
    {
        $this->handleResetModal();
        $flasher->addSuccess('You have successfully Delete your Folder', '<h4> <b> Folder Deleted!</b></h4>');
    }
}
