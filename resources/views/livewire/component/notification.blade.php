<x-modal.side-modal>
    <x-slot name="header">
        Notification
    </x-slot>
    <x-slot name="body">
        @if(count($BaseFolderRequest)>=1||count($FolderRequest) >=1||count($FileRequest)>=1)


        @if (count($BaseFolderRequest)>=1)
        <div class="text-dark font-weight-bold">
            Base Folder
        </div>
        <hr class="m-2">
        @foreach ($BaseFolderRequest as $item)
        <div class="d-flex">
            <div class="dropdown-item-desc">
                <p class="text-small">
                    <strong>{{ $item->user->name }}</strong> requesting access to {{
                    $item->permission->name }} a
                    Base folder named {{ $item->accessable->name }}
                </p>
                <div class="d-flex justify-content-between">
                    <div class="text-small px-auto">
                        <p class="text-small mb-0">
                            {{ $item->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="d-flex">

                        <input type="text" name="status" value="accept" hidden>
                        <button href="#" wire:click="accept('{{ $item->id }}')"
                            class="btn btn-icon btn-sm btn-success mr-2 p-auto text-small">
                            <x-heroicon-s-check style="width:13px" /> Accept
                        </button>

                        <input type="text" name="status" value="deciline" hidden>
                        <button href="#" wire:click="reject('{{ $item->id }}')"
                            class="btn btn-icon btn-sm btn-danger p-auto text-small">
                            <x-heroicon-s-x-mark style="width:13px" />Reject
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @endforeach
        @endif


        @if (count($FolderRequest) >=1)
        <div class="text-dark font-weight-bold">
            Folder
        </div>
        <hr class="m-2">
        @foreach ($FolderRequest as $item)
        <div class="d-flex">
            <div class="dropdown-item-desc">
                <p class="text-small">
                    <strong>{{ $item->user->name }}</strong> requesting access to {{
                    $item->permission->name }} a
                    folder named {{ $item->accessable->name }}
                </p>
                <div class="d-flex justify-content-between">
                    <div class="text-small px-auto">
                        <p class="text-small mb-0">
                            {{ $item->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="d-flex">

                        <button href="#" wire:click="accept('{{ $item->id }}')"
                            class="btn btn-icon btn-sm btn-success mr-2 p-auto text-small">
                            <x-heroicon-s-check style="width:13px" /> Accept
                        </button>

                        <input type="text" name="status" value="deciline" hidden>
                        <button href="#" wire:click="reject('{{ $item->id }}')"
                            class="btn btn-icon btn-sm btn-danger p-auto text-small">
                            <x-heroicon-s-x-mark style="width:13px" />Reject
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @endforeach
        @endif


        @if (count($FileRequest)>=1)
        <div class="text-dark font-weight-bold">
            Document
        </div>
        <hr class="m-2">
        @foreach ($FileRequest as $item)
        <div class="d-flex">
            <div class="dropdown-item-desc">
                <p class="text-small">
                    <strong>{{ $item->user->name }}</strong> requesting access to {{
                    $item->permission->name }} a
                    Document named {{ $item->accessable->name }}
                </p>
                <div class="d-flex justify-content-between">
                    <div class="text-small px-auto">
                        <p class="text-small mb-0">
                            {{ $item->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="d-flex">

                        <button href="#" wire:click="accept('{{ $item->id }}')"
                            class="btn btn-icon btn-sm btn-success mr-2 p-auto text-small">
                            <x-heroicon-s-check style="width:13px" /> Accept
                        </button>

                        <input type="text" name="status" value="deciline" hidden>
                        <button href="#" wire:click="reject('{{ $item->id }}')"
                            class="btn btn-icon btn-sm btn-danger p-auto text-small">
                            <x-heroicon-s-x-mark style="width:13px" />Reject
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @endforeach
        @endif
        @else
        <p class="text-center">Nothing Here</p>
        @endif



    </x-slot>
    <x-slot name="footer">
    </x-slot>
</x-modal.side-modal>
