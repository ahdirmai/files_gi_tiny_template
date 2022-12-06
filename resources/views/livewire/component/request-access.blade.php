<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            Request Access to {{ $name }}
        </h5>
        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>
    <form>
        <x-slot name="content">
            <div class="d-flex justify-items-between">
                <div class="d-flex flex-column">
                    <div class="text-dark">
                        <h4>
                            You Need Access
                        </h4>
                    </div>
                    <div>Request acces, or switch to an account with acces</div>
                    <div class="form-group row">
                        <label for="access" class="col-sm-5 col-form-label pr-0">Select Access</label>
                        <div class="col-sm-4 px-0">
                            <select class="form-control" id="example-select" wire:model="permission_id">
                                @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div></div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button type="button" class="btn text-primary" data-dismiss="modal">Close</button>
            <button type="submit" wire:click="requestAccess()" class="btn btn-primary">Request Acces</button>
        </x-slot>
    </form>

</x-modal.basic-modal>
