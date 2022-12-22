<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            Delete {{ $type }} {{ $name }}
        </h5>
        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>
    <form>
        <x-slot name="content">
            Are you sure delete the entire data?
        </x-slot>

        <x-slot name="footer">
            <button type="button" class="btn text-primary" data-dismiss="modal">Close</button>
            <button type="submit" wire:click="deleteFolder()" class="btn btn-primary">Delete</button>
        </x-slot>
    </form>

</x-modal.basic-modal>
