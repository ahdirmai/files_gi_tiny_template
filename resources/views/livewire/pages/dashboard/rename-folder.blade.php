<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            Rename Folder
        </h5>
        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>
    <form>
        <x-slot name="content">
            <div class="form-group">
                <h6>Folder Name</h6>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span>
                                <x-heroicon-o-folder-plus style="height:15px ">
                                </x-heroicon-o-folder-plus>
                            </span>
                        </div>
                    </div>
                    <input type="text" wire:model="name" class="form-control" id="name" name="name">
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button type="button" class="btn text-primary" data-dismiss="modal">Close</button>
            <button type="submit" wire:click="renameFolder()" class="btn btn-primary">Rename</button>
        </x-slot>
    </form>

</x-modal.basic-modal>
