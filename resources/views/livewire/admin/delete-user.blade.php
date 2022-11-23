<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            Edit Profile
        </h5>

        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>

    <x-slot name="content">
        Are you sure delete the entire data?
    </x-slot>

    <x-slot name="footer">
        <button type="button" class="btn text-primary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" wire:click="delete()">Delete</button>
    </x-slot>

</x-modal.basic-modal>
