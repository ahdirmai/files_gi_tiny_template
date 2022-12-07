<div>
    <div class="row align-items-center my-3">
        <div class="col-md-8">
            <h2 class="page-title">{{ $folder->name }}</h2>
        </div>
        <div class="col-md-4 ">
            <div class="my-auto mr-5 d-flex justify-content-end">

                <div class="row section-header-breadcrumb">
                    @foreach ($breadcrumbs as $breadcrumb )
                    @if($folder->slug != $breadcrumb['slug'])
                    <div class="breadcrumb-item"><a href="{{ route('dashboard.inner',$breadcrumb['slug']) }}">{{
                            $breadcrumb['name']
                            }}</a>
                    </div>
                    @endif
                    @endforeach
                    <div class="breadcrumb-item"><a href="{{ route('dashboard.inner', $folder->slug) }}">{{
                            $folder->name
                            }}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <div class="form-row">
        <div class="form-group col-md-1">
            <select class="form-control" wire:model="type">
                <option value="" selected>All</option>
                <option value="file">File</option>
                <option value="folder">Folder</option>
                <option value="url">Url</option>
            </select>
        </div>
        <div class="form-group col-md-10">
            <div class="input-group mb-3">
                <input type="text" class="form-control" wire:model="search" placeholder="Search" aria-label="Search"
                    aria-describedby="Searh">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
        </div>
        <div class="form-group col-md-1">
            <button type="button" class="btn mb-2 btn-primary" data-toggle="dropdown"><span
                    class="fe fe-plus fe-16 mr-2"></span>Tambah</button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#" wire:click="createFolder('folder')">
                    <span class="fe fe-folder mr-2"></span>
                    Folder
                </a>
                <a class="dropdown-item" href="#" wire:click="createFolder('file')">
                    <span class="fe fe-file mr-2"></span>
                    File</a>
                <a class="dropdown-item" href="#" wire:click="createFolder('url')">
                    <span class="fe fe-link mr-2"></span>
                    URL</a>
            </div>
        </div>
    </div>


    {{-- {{ $type }} --}}
    @if((count($content_folder) >= 1) || (count($content_file) >= 1) )
    @if((count($content_folder) >= 1))
    @if($type == "" || $type =='folder')
    <div class="file-container">
        <div class="file-panel mt-2">
            <h6 class="mb-3">Folder</h6>
            <div class="row my-4">
                @foreach ($content_folder as $folder)
                {{-- <x-folder></x-folder> --}}
                @include('components.folder')
                @endforeach
            </div>
            {{ $content_folder->links() }}
        </div>
    </div>
    @endif

    @else
    <div class="text-center">
        <p class="text-dark">There are no folder </p>
    </div>
    @endif

    <hr>
    @if((count($content_file) >= 1))
    @if($type == "" || $type =='file'||$type=='url')
    <div class="file-container">
        <div class="file-panel mt-4">
            @include('components.file')
        </div>
        {{ $content_file->links() }}
    </div>
    @endif


    @else
    <div class="text-center">
        <p class="text-dark">There are no files </p>
    </div>
    @endif
    @else
    <div class="text-center">
        <p class="text-dark">There are nothing </p>
    </div>
    @endif

    @if($modal =="create")
    <livewire:component.crud-modal.create :slug='$slug'></livewire:component.crud-modal.create>

    @elseif($modal=="rename")
    <livewire:component.crud-modal.rename></livewire:component.crud-modal.rename>

    @elseif($modal =="manage")
    <livewire:component.crud-modal.manage></livewire:component.crud-modal.manage>

    @elseif($modal =="delete")
    <livewire:component.crud-modal.delete></livewire:component.crud-modal.delete>

    @elseif($modal =="detail")
    <livewire:component.detail-panel></livewire:component.detail-panel>

    @elseif($modal =="request")
    <livewire:component.request-access></livewire:component.request-access>

    @elseif($modal=="fileInfo")
    <livewire:pages.dashboard.info-file></livewire:pages.dashboard.info-file>
    @endif
</div>
