<x-modal.side-modal>
    @if($name == null)
    <div class="text-center">
        <div class="spinner-border mr-3 text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    @endif

    <x-slot name="header">
        <h5 class="modal-title d-flex align-items-center" id="defaultModalLabel">
            @if($type == "file")
            <x-heroicon-o-document style="height: 15px" class="mr-3">
            </x-heroicon-o-document>
            @elseif($type =="url")
            <x-heroicon-o-link style="height: 15px" class="mr-3">
            </x-heroicon-o-link>
            @else
            <x-heroicon-o-folder-open style="height: 15px" class="mr-3">
            </x-heroicon-o-folder-open>
            @endif
            {{-- {{ $type }} --}}
            <span>
                {{ $name }}
            </span>

        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </x-slot>

    <x-slot name="body">
        <div class="info-content p-3">
            <ul class="nav nav-tabs nav-fill mb-3" id="file-detail" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ $tab == 'detail' ? 'active' : '' }}" wire:click="$set('tab', 'detail')"
                        type="button">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $tab == 'activity' ? 'active' : '' }}" wire:click="setAct('activity')"
                        type="button">Activities</a>
                </li>
            </ul>
            <div class="tab-content" id="file-tabs">
                <div class="d-flex align-items-center my-1 text-center ">
                    <div class="flex-fill">
                        <span class="circle circle-sm bg-white">
                            @if($type == "file")
                            <x-heroicon-o-document style="height: 15px" class="mr-3">
                            </x-heroicon-o-document>
                            @elseif($type =="url")
                            <x-heroicon-o-link style="height: 15px" class="mr-3">
                            </x-heroicon-o-link>
                            @else
                            <x-heroicon-o-folder-open style="height: 15px" class="mr-3">
                            </x-heroicon-o-folder-open>
                            @endif
                        </span>
                        <span class="h6 m-0">{{ $name }}</span>

                    </div>

                </div>
                <div class="text-center">
                    @if ($type == 'file')
                    <small>{{ $filename}}</small>
                    @endif
                </div>
                <hr>
                @if($tab == 'detail')

                <div class="my-2">
                    {{$type}} Properties
                </div>
                <dl class="row mb-4 small">
                    <dt class="col-6 text-muted">Owner</dt>
                    <dd class="col-6">{{ $owner }}</dd>
                    <dt class="col-6 text-muted">Type</dt>
                    <dd class="col-6">{{ $type ?$type:"Folder" }}</dd>

                    <dt class="col-6 text-muted">Access Type</dt>
                    <dd class="col-6">{{ $access_type }}</dd>
                    <dt class="col-6 text-muted">Created at</dt>
                    <dd class="col-6">{{ date('d M Y h:i A', strtotime($created_at))}}</dd>
                    <dt class="col-6 text-muted">Last update</dt>
                    <dd class="col-6">{{ date('d M Y h:i A', strtotime($updated_at))}}</dd>
                    @if ($type == 'file')
                    <dt class="col-6 text-muted">Last update</dt>
                    <dd class="col-6">{{ date('d M Y h:i A', strtotime($updated_at))}}</dd>
                    @endif

                </dl>
                @if ($access_type =="private")
                People with access
                <ul class="avatars-list mx-0">
                    @foreach($haveAccess as $people)
                    <li>
                        <div class="circle circle-md bg-{{ $loop->iteration%2==0 ?'warning':'primary'}}"
                            data-toggle="tooltip" title="{{ $people->user->name }} ">
                            <p class="text-white mx-auto my-auto">
                                {{ $people->user->initials() }}
                            </p>
                        </div>
                    </li>

                    @endforeach
                </ul>
                @endif

                @else
                <div class="form-group col-md-6 p-0 mr-1 border-0">
                    <select class="form-control" wire:click="changeEvent($event.target.value)">
                        <option value='0'>All Time</option>
                        <option value="1">Today</option>
                        <option value="2">Yesterday</option>
                    </select>
                </div>
                @if ($activity)

                @foreach ($activity as $activity)

                <div class="d-flex flex-column">
                    <div class="d-flex justify-content-between">
                        <div>{{
                            date('g:i a', strtotime($activity->created_at)); }}
                        </div>
                        <div>{{ $activity->description }}</div>
                    </div>
                    <div class="text-small"> {{ $activity->causer->name }}</div>
                    <div class="d-flex">
                        <div>
                            @if($type == "file")
                            <x-heroicon-o-document style="height: 15px" class="mr-3">
                            </x-heroicon-o-document>
                            @elseif($type =="url")

                            <x-heroicon-o-link style="height: 15px" class="mr-3">
                            </x-heroicon-o-link>
                            @else
                            <x-heroicon-o-folder-open style="height: 15px" class="mr-3">
                            </x-heroicon-o-folder-open>
                            @endif
                        </div>
                        <div class="text-dark font-weigth-bold"><b>{{ $activity->subject->name }}</b></div>
                    </div>
                </div>
                <hr>
                @endforeach
                @endif

                @endif

            </div>
            <!-- .tab-content -->
        </div>


    </x-slot>
    <x-slot name="footer">
    </x-slot>

    <script>
        $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</x-modal.side-modal>
