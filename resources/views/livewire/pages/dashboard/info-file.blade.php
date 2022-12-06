<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            @if(!$url)
            Download File
            @else
            Copy Link
            @endif
        </h5>
        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>
    <form>
        <x-slot name="content">

            @if(!$url)
            <div class="text-center">
                <div class="text-bold">
                    {{-- <label for="url">Link to Download</label> --}}
                </div>
                <div class="input-group">
                    <input type="text" id="url" class="form-control" aria-label="Recipient's username"
                        value="{{ route('file.download',$slug) }}" disabled>
                    {{-- <span class="copied">Copied !</span> --}}
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-info" onclick="myFunction()">
                            <x-heroicon-s-document-duplicate style="width:17px" class="ml-0" /> Copy
                        </button>
                    </div>
                </div>

            </div>
            <hr>

            <div class="text-center">
                <div class="text-bold">
                    <label for="url">Click to Download</label>
                </div>
                <a href="{{ route('file.download',$slug) }}" class="btn btn-outline-secondary" type="button">
                    <x-heroicon-s-arrow-down-tray style="width:17px" class="ml-0" /> Download
                </a>
            </div>
            @else
            <div class="text-center">
                <div class="text-bold">
                    {{-- <label for="url">Link to Download</label> --}}
                </div>
                <div class="input-group">
                    <input type="text" id="url" class="form-control" aria-label="Recipient's username"
                        value="{{ $url }}" disabled>
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-info" onclick="myFunction()">
                            <x-heroicon-s-document-duplicate style="width:17px" class="ml-0" /> Copy
                        </button>
                    </div>
                </div>

            </div>
            @endif

    </form>
    </x-slot>

    <x-slot name="footer">

    </x-slot>

</x-modal.basic-modal>
