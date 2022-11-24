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
                    <input type="name" class="form-control" wire:model="name" name="name" id="name" placeholder="Name">
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
            <div class="form-group">
                <label for="divisi" class="col-sm-3 col-form-label">Divisi</label>
                <div class="form-group col mr-1 mb-0">
                    <select name="division_id" wire:model="division_id" class="form-control" disabled>
                        <option value="" {{ $division_id==null ? 'selected' :"" }}>Choose Division</option>
                        @foreach ( $divisions as $division )
                        <option value="{{ $division->id }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('division_id')
                <small class="col text-danger mt-0"> {{ $message }} </small>
                @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <button type="button" class="btn text-primary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" wire:click="storeUpdateProfile()">Update</button>
        </x-slot>
    </form>

</x-modal.basic-modal>
