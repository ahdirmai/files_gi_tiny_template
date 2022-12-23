<x-modal.basic-modal>
    <x-slot name="header">
        <h5 class="modal-title">
            Content Version of {{ @$content->name }}
        </h5>
        <button type="button" wire:click="resetModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>
    <form>
        <x-slot name="content">


            {{-- {{ $versions }} --}}
            @if ($versions && @count($versions)>=1)
            @foreach ($versions as $key=>$version )
            @if ($key == 0)
            <div class="d-flex p-1 m-1">
                <div class="p-1 my-auto mr-2">
                    <x-heroicon-o-link style="height: 25px" class="m-auto"></x-heroicon-o-link>
                </div>
                <div>
                    <div>Current Version</div>
                    <div> <b> URL : {{@$version->getExtraProperty('newUrl')}} </b></div>
                    <div class="d-flex">
                        <div class="mr-2"> {{ date('D g:i a', strtotime($version->created_at)); }}</div>
                        <div class="mr-2">last edit by : {{ $version->causer->name }} | </div>
                        <div> created by : {{ $content->user->name }}</div>
                    </div>
                </div>
            </div>
            <hr>
            @else
            <div class="d-flex p-1 m-1">
                <div class="p-1 my-auto mr-2">
                    <x-heroicon-o-link style="height: 25px" class="m-auto"></x-heroicon-o-link>
                </div>
                <div>
                    <div>Version {{ (abs($loop->iteration -= (count($versions)))) + 1 }}</div>
                    <div> <b>URL : {{ @$version->getExtraProperty('newUrl') }} </b></div>
                    <div class="d-flex">
                        <div class="mr-2"> {{ date('D g:i a', strtotime($version->created_at)); }}</div>
                        <div> edit by : {{ $version->causer->name }}</div>
                    </div>
                </div>
            </div>
            @endif

            <br>
            @endforeach
            <div class="d-flex p-1 m-1">
                <div class="p-1 my-auto mr-2">
                    <x-heroicon-o-link style="height: 25px" class="m-auto"></x-heroicon-o-link>
                </div>
                <div>
                    <div>Version 0</div>
                    <div> <b>URL : {{@$versions->reverse()->first()->getExtraProperty('oldUrl')}} </b></div>
                    <div class="d-flex">
                        <div class="mr-2"> {{ date('D g:i a', strtotime(@$content->created_at)); }}</div>
                        <div>Created By : {{ @$content->user->name }}</div>
                    </div>
                </div>
            </div>
            @else
            <div class="d-flex p-1 m-1">
                <div class="p-1 my-auto mr-2">
                    <x-heroicon-o-link style="height: 25px" class="m-auto"></x-heroicon-o-link>
                </div>
                <div>
                    <div>Current Version</div>
                    <div> <b>URL : {{@$content->url}} </b></div>
                    <div class="d-flex">
                        <div class="mr-2"> {{ date('D g:i a', strtotime(@$content->created_at)); }}</div>
                        <div>Created By : {{ @$content->user->name }}</div>
                    </div>
                </div>
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <button type="button" class="btn text-primary" data-dismiss="modal">Close</button>
        </x-slot>
    </form>
</x-modal.basic-modal>
