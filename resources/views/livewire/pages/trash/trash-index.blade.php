<div>
    <div class="form-row">
        <x-search-bar></x-search-bar>

        <div class="form-group col-md-1">
            <button type="button" wire:click="createFolder()" class="btn mb-2 btn-primary"><span
                    class="fe fe-plus fe-16 mr-2"></span>Tambah</button>
        </div>
    </div>


    <div class="file-container {{ $ContainerDetailStatus }}">
        <div class="file-panel mt-4">
            <h6 class="mb-3">Base Folder</h6>
            <div class="row my-4">
                @foreach ($baseFolders as $folder)
                {{-- <x-folder></x-folder> --}}
                @include('components.folder')
                @endforeach

            </div>
            {{ $baseFolders->links() }}
        </div>

        <livewire:component.detail-panel></livewire:component.detail-panel>
    </div>

    @if($modal =="create")
    <livewire:pages.dashboard.create-folder></livewire:pages.dashboard.create-folder>

    @elseif($modal=="rename")
    <livewire:pages.dashboard.rename-folder></livewire:pages.dashboard.rename-folder>

    @elseif($modal =="manage")
    <livewire:pages.dashboard.manage-folder></livewire:pages.dashboard.manage-folder>

    @elseif($modal =="delete")
    <livewire:pages.dashboard.delete-folder></livewire:pages.dashboard.delete-folder>


    @endif

</div>
