<div>
    <div class="form-row">
        <div class="form-group col-md-1">
            <select class="form-control select2" id="simple-select2" wire:model="filter">
                <option value="file">Private</option>
                <option value="folder">Public</option>
            </select>
        </div>
        <div class="form-group col-md-10">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                    aria-describedby="Searh">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                </div>
            </div>
        </div>

        <div class="form-group col-md-1">
            <button type="button" wire:click="createFolder('folder')" class="btn mb-2 btn-primary"><span
                    class="fe fe-plus fe-16 mr-2"></span>Tambah</button>
        </div>
    </div>


    <div class="file-container">
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
        {{-- <x-modal.side-modal></x-modal.side-modal> --}}
        <livewire:component.detail-panel></livewire:component.detail-panel>

        {{-- <livewire:component.detail-panel></livewire:component.detail-panel> --}}
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
