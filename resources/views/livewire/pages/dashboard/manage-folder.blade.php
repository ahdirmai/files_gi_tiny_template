<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            Manage Folder {{ $name }}
        </h5>
        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>
    <form>
        <x-slot name="content">
            <div class="access-radio">
                <h6>General Access</h6>
                <div class="custom-control custom-radio">
                    <input type="radio" wire:model="folderAccessType" id="is-private1" name="folderAccessType"
                        class="custom-control-input" value="public" checked>
                    <label class="custom-control-label" for="is-private1">Public</label>
                    <p>This project would be available to anyone who has the link</p>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" wire:model="folderAccessType" id="is-private2" class="custom-control-input"
                        value="private" name="folderAccessType">
                    <label class="custom-control-label" for="is-private2">Privates</label>
                    <p>Only people with access can open with the link</p>
                </div>
            </div>
            @if($folderAccessType == "private")
            <div class="form-group" id="formPrivate">
                <h6>Invite User</h6>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <select class="form-control" name="invitedUser" id="invitedUser">
                            <option value="" hidden></option>
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                        </select>
                        <div class="input-group-append">
                            <select class="form-control bg-primary text-white" name="accessType" id="accessType">
                                <option value="">View</option>
                                <option value="">Manage</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <h6>Generate Password</h6>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="" aria-label="">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="button">Generate</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <button type="button" class="btn text-primary" data-dismiss="modal">Close</button>
            <button type="submit" wire:click="manageFolder()" class="btn btn-primary">Create</button>
        </x-slot>
    </form>

</x-modal.basic-modal>
