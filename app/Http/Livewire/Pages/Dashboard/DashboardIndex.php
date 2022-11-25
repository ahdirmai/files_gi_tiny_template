<?php

namespace App\Http\Livewire\Pages\Dashboard;

use App\Models\BaseFolders;
use Flasher\SweetAlert\Prime\SweetAlertFactory;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $modal = "";
    public $ContainerDetailStatus = "";
    public $FolderSelected = "";

    protected $queryString = [
        'search'
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $listeners = [
        'resetModal' => 'handleResetModal',
        'folderStored' => 'handleStored',
        'folderRenamed' => 'handleRenamed',
        'storeFolderManage' => 'handleManaged',
        'folderDeleted' => 'handleFolderDeleted'
    ];

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


    public function getRename($slug)
    {
        // dd('masuk');
        $folder = BaseFolders::where('slug', $slug)->first();
        $this->emit('setFolderName', $folder);
        $this->renameFolder();
    }


    public function getManage($slug)
    {
        // dd('Masuk');
        $folder = BaseFolders::where('slug', $slug)->first();
        $this->emit('setFolderManage', $folder);
        $this->manageFolder();
    }

    public function getDetail($slug)
    {
        $folder = BaseFolders::where('slug', $slug)->first();
        $this->emit('resetDetailFolder', $folder);
        $this->FolderSelected = $slug;
        $this->emit('setDetailFolder', $folder);
        $this->FolderSelected = $slug;
        $this->ContainerDetailStatus = 'collapsed';
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

    public function render()
    {
        if ($this->search) {
            $baseFolders = BaseFolders::where('name', 'like', '%' . $this->search . '%')->latest();
        } else {
            $baseFolders = BaseFolders::latest();
        }
        $data = [
            'baseFolders' => $baseFolders->paginate(6)
        ];
        return view('livewire.pages.dashboard.dashboard-index', $data);
    }
}
