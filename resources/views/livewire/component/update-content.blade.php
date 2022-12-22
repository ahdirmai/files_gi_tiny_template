<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            Update Content
        </h5>
        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>
    <form>
        <x-slot name="content">
            @if ($type == "url")

            <div class="form-group">
                <h6>Insert Updated URL of {{ $name }} </h6>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span>
                                <x-heroicon-o-link style="height:15px ">
                                </x-heroicon-o-link>
                            </span>
                        </div>
                    </div>
                    <input type="text" class="form-control" wire:model="url">
                </div>
            </div>

            @elseif($type =="file")
            <div class="form-group">
                <div class="text-center">
                    <p>Upload new version of {{$name }} ({{ $oldFile->file_name }})
                    </p>
                </div>
                <div class="form-group">
                    <div x-data="{ isUploading: false, progress: 0, hasUploaded:false }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="{isUploading = false, hasUploaded = true}"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="form-control" style="border: 0" wire:model="newFile">
                            </div>
                        </div>
                        {{-- {{ $oldFile }} --}}

                        <!-- Progress Bar -->
                        <div x-show="isUploading">
                            <div class="mb-3 text-center">
                                <div class="spinner-border mr-3 text-success" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>

                        <div x-show="hasUploaded" class="text-center">
                            <div class="mb-3">
                                <div class="mr-3 text-success" role="status">
                                    <x-heroicon-o-check style="height: 30px"></x-heroicon-o-check>Success
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






            @endif

        </x-slot>

        <x-slot name="footer">
            <button type="button" class="btn text-primary" data-dismiss="modal">Close</button>
            @if ($type == "url")

            <button type="submit" wire:click="updateURL()" class="btn btn-primary">Update</button>
            @else
            File
            @endif
        </x-slot>
    </form>

</x-modal.basic-modal>
