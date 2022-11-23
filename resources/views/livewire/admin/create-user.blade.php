<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            Add user data
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
                    <input type="name" class="form-control  @error('name') is-invalid @enderror" wire:model="name"
                        name="name" id="name" placeholder="Name">
                </div>
                @error('name')
                <small class="col text-danger"> {{ $message }} </small>
                @enderror
            </div>
            <div class="form-group">
                <label for="username" class="col-sm-3 col-form-label">Username</label>
                <div class="col">
                    <input type="username" class="form-control @error('username') is-invalid @enderror"
                        wire:model="username" name="username" id="username" placeholder="username">
                </div>
                @error('username')
                <small class="col text-danger"> {{ $message }} </small>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col">
                    <input type="password" class="form-control" wire:model="password" name="password" id="password"
                        placeholder="password">
                </div>
                @error('password')
                <small class="col text-danger"> {{ $message }} </small>
                @enderror

            </div>

            <div class="form-group">
                <label for="divisi" class="col-sm-3 col-form-label">Divisi</label>
                <div class="form-group col mr-1 mb-0">
                    <select name="division_id" wire:model="division_id" class="form-control">
                        <option value="" selected disabled>Choose Division</option>
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

            {{-- {{ $name }} | {{ $username }} | {{ $password }} | {{ $division_id }}
            <br>
            {{ $status }} --}}
            <button type="button" class="btn text-primary" data-dismiss="modal">Close</button>
            <button type="submit" wire:click="create()" class="btn btn-primary">Create</button>
        </x-slot>
    </form>
</x-modal.basic-modal>
