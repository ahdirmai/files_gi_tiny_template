<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            Change Password
        </h5>
        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>

    <form>
        <x-slot name="content">
            <div class="form-group">
                <label for="password" class="col col-form-label">Current password</label>
                <div class="col">
                    <div class="input-group" id="oldPassword">
                        <input type="password" wire:model="old_password" class="form-control" name="old_password"
                            id="old_password" placeholder="Old Password">
                        <div class="input-group-append">
                            <div class="input-group-text" id="button-addon-date">
                                <a type="button" class="text-decoration-none">
                                    <i class="fe fe-12 fe-eye-off" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @error('old_password')
                <small class="col text-danger"> {{ $message }} </small>
                @enderror
                {{ $old_password }}
            </div>
            <div class="form-group">
                <label for="password" class="col col-form-label">New Password</label>
                <div class="col">
                    <div class="input-group">
                        <input type="password" wire:model="new_password" class="form-control" name="new_password"
                            id="new_password" placeholder="New Password">
                        <div class="input-group-append">
                            <div class="input-group-text" id="button-addon-date">
                                <a type="button" id="toggleNewPassword">
                                    <span class="fe fe-12 fe-eye-off mx-auto" id="toggleNewPassword"></span>
                                    {{-- <x-heroicon-o-eye-slash style="height:10px"></x-heroicon-o-eye-slash> --}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @error('new_password')
                <small class="col text-danger"> {{ $message }} </small>
                @enderror

            </div>
            <div class="form-group">
                <label for="password" class="col col-form-label">Confirm New Password</label>
                <div class="col">
                    <div class="input-group">
                        <input type="password" wire:model="new_password_confirmation" class="form-control"
                            name="new_password_confirmation" id="new_password_confirmation"
                            placeholder="Confirm New Password">
                        <div class="input-group-append">
                            <div class="input-group-text" id="button-addon-date">
                                <a type="button" id="toggleConfirmPassword">
                                    <span class="fe fe-12 fe-eye-off mx-auto" id="toggleConfirmPassword"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button type="button" class="btn text-primary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" wire:click="storeChangePassword()">Change Password</button>
        </x-slot>
    </form>
</x-modal.basic-modal>
