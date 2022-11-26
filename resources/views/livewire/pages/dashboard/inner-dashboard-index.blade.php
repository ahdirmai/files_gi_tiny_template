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
        <x-search-bar></x-search-bar>
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

    <div class="file-container">
        <div class="file-panel mt-4">
            @include('components.file')

        </div>
        {{ $content_file->links() }}
    </div>

    <livewire:component.detail-panel></livewire:component.detail-panel>


    @if($modal =="create")
    <livewire:pages.dashboard.create-folder :slug='$slug'></livewire:pages.dashboard.create-folder>

    @elseif($modal=="rename")
    <livewire:pages.dashboard.rename-folder></livewire:pages.dashboard.rename-folder>

    @elseif($modal =="manage")
    <livewire:pages.dashboard.manage-folder :slug='$slug'></livewire:pages.dashboard.manage-folder>

    @elseif($modal =="delete")
    <livewire:pages.dashboard.delete-folder></livewire:pages.dashboard.delete-folder>
    @endif
</div>
