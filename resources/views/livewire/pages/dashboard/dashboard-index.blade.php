<div>
    <div class="form-row">
        <div class="form-group col-md-1">
            <select class="form-control" wire:model="filter">
                <option value='0'>Show All</option>
                <option value="private">Private</option>
                <option value="public">Public</option>
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

    </div>

    @if($modal =="create")
    <livewire:component.crud-modal.create></livewire:component.crud-modal.create>

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

    @endif

</div>
