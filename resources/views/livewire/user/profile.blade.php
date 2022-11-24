<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            Edit Profile
        </h5>

        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>

    <form>
        <x-slot name="content">
            <div class="form-group">
                <label for="name" class="col-sm-3 col-form-label">Name</label>
                <div class="col">
                    <input type="name" class="form-control" name="name" id="name" placeholder="Name">
                </div>
                @error('name')
                <small class="col text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-3 col-form-label">Username</label>
                <div class="col">
                    <input type="username" class="form-control" wire:model="username" name="username" id="username"
                        placeholder="username">
                </div>
                @error('username')
                <small class="col text-danger"> {{ $message }} </small>
                @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <button type="button" class="btn text-primary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" wire:click="update()">Update</button>
        </x-slot>
    </form>

</x-modal.basic-modal>
