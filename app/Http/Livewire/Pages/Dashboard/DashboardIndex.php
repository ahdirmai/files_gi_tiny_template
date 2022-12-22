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
    public $filter;
    public $paginate = 5;

    // public $page = 'dashboard';

    protected $queryString = [
        'search', 'filter'
    ];

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
        $this->filter = request()->query('filter', $this->filter);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function checkSearch()
    {
        if ($this->search == "") {
            $this->search = null;
        }

        if ($this->filter == '0') {
            $this->filter = null;
        }
    }

    protected $listeners = [
        'resetModal' => 'handleResetModal',
        'folderStored' => 'handleStored',
        'folderRenamed' => 'handleRenamed',
        'storeFolderManage' => 'handleManaged',
        'folderDeleted' => 'handleFolderDeleted',
        'storeRequestAccess' => 'handleRequestAccess',
        // 'hideDashboard' => 'handleHideDashboard'
    ];

    public function handleHideDashboard()
    {
        // $this->handleResetModal();
        $this->modal = "";
    }

    public function createFolder($type)
    {
        $this->modal = "create";
        $this->emit('setUploadType', $type);
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

    public function requestAccess()
    {
        $this->modal = "request";
        $this->dispatchBrowserEvent('show-form');
    }


    public function getRename($slug)
    {
        // $folder = BaseFolders::where('slug', $slug)->first();
        $this->emit('setFolderName', $slug);
        $this->renameFolder();
    }

    public function getRequest($slug)
    {
        $this->emit('setRequestAccess', $slug);
        $this->requestAccess();
    }


    public function getManage($slug)
    {
        $this->emit('setFolderManage', $slug);
        $this->manageFolder();
    }

    public function getDetail($slug)
    {
        $this->modal = "detail";
        $this->dispatchBrowserEvent('show-side');

        $this->emit('setDetailFolder', $slug);
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

    public function handleRequestAccess(SweetAlertFactory $flasher)
    {
        $this->handleResetModal();
        $flasher->addSuccess('You have successfully Request Access', '<h4> <b> Request Send!</b></h4>');
    }

    public function render()
    {
        $this->checkSearch();

        if ($this->search) {
            $baseFolders = BaseFolders::where('name', 'like', '%' . $this->search . '%')->latest();
        } elseif ($this->filter) {
            $baseFolders = BaseFolders::where('access_type', 'like', '%' . $this->filter . '%')->latest();
        } elseif ($this->search && $this->filter) {
            $baseFolders = BaseFolders::latest()->where('name', 'like', '%' . $this->search . '%')
                ->where('access_type', $this->filter);
        } else {
            $baseFolders = BaseFolders::latest();
        }
        $data = [
            'baseFolders' => $baseFolders->paginate(6)
        ];
        return view('livewire.pages.dashboard.dashboard-index', $data);
    }
}
