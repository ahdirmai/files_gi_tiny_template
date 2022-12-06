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
    public $search;
    public $type;

    protected $queryString = [
        'search', 'type'
    ];


    public function mount()
    {
        $this->search = request()->query('search', $this->search);
        $this->type = request()->query('type', $this->type);
    }


    public function checkSearch()
    {
        if ($this->search == "") {
            $this->search = null;
        }

        if ($this->type == "") {
            $this->type = null;
        }
    }

    protected $listeners = [
        'resetModal' => 'handleResetModal',
        'folderStored' => 'handleStored',
        'fileStored' => 'handleFileStored',
        'urlStored' => 'handleURLStored',
        'folderRenamed' => 'handleRenamed',
        'storeFolderManage' => 'handleManaged',
        'folderDeleted' => 'handleFolderDeleted',
        'storeRequestAccess' => 'handleRequestAccess',

    ];

    // Call the Modall
    public function createFolder($type)
    {
        $this->modal = "create";
        $this->emit('setUploadType', $type);
        $this->dispatchBrowserEvent('show-form');
    }

    public function requestAccess()
    {
        $this->modal = "request";
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

    public function fileInfo()
    {
        $this->modal = "fileInfo";
        $this->dispatchBrowserEvent('show-form');
    }
    // End call Modal


    // Get The Data
    public function getDetail($slug)
    {
        $this->modal = "detail";
        $this->dispatchBrowserEvent('show-side');
        $this->emit('setDetailFolder', $slug);
    }

    public function getFile($slug)
    {
        $this->emit('setFile', $slug);
        $this->fileInfo();
    }



    public function getRename($slug)
    {
        $folder = getFolder($slug);
        $this->emit('setFolderName', $folder);
        $this->renameFolder();
    }

    public function getManage($slug)
    {

        $this->emit('setFolderManage', $slug);
        $this->manageFolder();
    }

    public function getDelete($slug)
    {
        $this->emit('deleteFolder', $slug);
        $this->deleteFolder();
    }

    public function getRequest($slug)
    {
        $this->emit('setRequestAccess', $slug);
        $this->requestAccess();
    }

    // End get Data


    // Handle

    public function handleRequestAccess(SweetAlertFactory $flasher)
    {
        $this->handleResetModal();
        $flasher->addSuccess('You have successfully Request Access', '<h4> <b> Request Send!</b></h4>');
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

    public function handleFileStored(SweetAlertFactory $flasher)
    {
        $this->handleResetModal();
        $flasher->addSuccess('You have successfully Added File', '<h4> <b>  File Added!</b></h4>');
    }

    public function handleURLStored(SweetAlertFactory $flasher)
    {
        $this->handleResetModal();
        $flasher->addSuccess('You have successfully Added URL', '<h4> <b>  URL Added!</b></h4>');
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
    // End Handle

    public function render()
    {

        $parent = getFolder($this->slug);
        $result = $parent->contentable;
        if ($result == null) {
            $parents[0] =  array(
                'slug' => $parent->slug,
                'name' => $parent->name
            );
        } else {
            $count = 0;
            do {
                $parents[$count] = array(
                    'slug'  => $result->slug,
                    'name'  => $result->name,
                );
                $result = $result->contentable;
                $count++;
            } while ($result != null);
        }

        $this->checkSearch();

        $folders = $parent->contents()->where('type', 'folder');
        $file = $parent->contents()->where('type', '!=', 'folder');

        if ($this->search) {
            if ($this->type) {
                if ($this->type == 'url') {
                    $file = $parent->contents()->where('type', 'url')->where('name', 'like', '%' . $this->search . '%');
                } elseif ($this->type == 'file') {
                    $file = $parent->contents()->where('type', 'file')->where('name', 'like', '%' . $this->search . '%');
                } elseif ($this->type == 'folder') {
                    $folders = $parent->contents()->where('type', 'folder')->where('name', 'like', '%' . $this->search . '%');
                }
            } else {
                $folders = $parent->contents()->where('type', 'folder')->where('name', 'like', '%' . $this->search . '%');
                $file = $parent->contents()->where('type', '!=', 'folder')->where('name', 'like', '%' . $this->search . '%');
            }
        } elseif ($this->type) {
            if ($this->type == 'url') {
                $file = $parent->contents()->where('type', 'url');
            } elseif ($this->type == 'file') {
                $file = $parent->contents()->where('type', 'file');
            } elseif ($this->type == 'folder') {
                $folders = $parent->contents()->where('type', 'folder');
            }
        } else {
            $folders = $parent->contents()->where('type', 'folder');
            $file = $parent->contents()->where('type', '!=', 'folder');
        }


        $data = [
            'content_folder' => $folders->latest()->paginate(6, '*', 'folderPage'),
            'content_file' => $file->latest()->paginate(6, '*', 'filePage'),
            'folder' => $parent,
            'breadcrumbs' => array_reverse($parents)
        ];

        return view('livewire..pages.dashboard.inner-dashboard-index', $data);
    }
}
