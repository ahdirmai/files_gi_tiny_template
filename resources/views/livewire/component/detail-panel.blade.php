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
                    <a class="nav-link active" id="tab-detail" data-toggle="tab" href="#detail" role="tab"
                        aria-controls="detail" aria-selected="true">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-activity" data-toggle="tab" href="#activity" role="tab"
                        aria-controls="activity" aria-selected="false">Activities</a>
                </li>
            </ul>
            <div class="tab-content" id="file-tabs">
                <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="tab-detail">
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
                </div>
                <!-- .tab-pane -->
                <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="tab-activity">
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

                    <div class="form-group col-md-6 p-0 mr-1 border-0">
                        <select class="form-control">
                            <option value='0'>Show All</option>
                            <option value="">1</option>
                            <option value="">2</option>
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

                    {{-- <div class="timeline">
                        <div class="pb-3 timeline-item item-primary">
                            <div class="pl-5 small">
                                <div class="mb-1"><strong>@Brown Asher</strong><span class="text-muted mx-1">have
                                        uploaded</span><strong>Tinydash</strong></div>
                                <span class="badge badge-pill badge-dark">1h ago</span>
                            </div>
                        </div>
                        <div class="pb-3 timeline-item item-warning">
                            <div class="pl-5 small">
                                <div class="mb-3"><strong>@Fletcher</strong><span
                                        class="text-muted mx-1">shared</span><strong>Tiny
                                        Admin</strong></div>
                                <ul class="avatars-list mb-2">
                                    <li>
                                        <a href="#!" class="avatar avatar-sm">
                                            <img alt="..." class="avatar-img rounded-circle"
                                                src="{{asset('assets/avatars/face-1.jpg') }}">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#!" class="avatar avatar-sm">
                                            <img alt="..." class="avatar-img rounded-circle"
                                                src="{{asset('assets/avatars/face-4.jpg') }}">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#!" class="avatar avatar-sm">
                                            <img alt="..." class="avatar-img rounded-circle"
                                                src="{{asset('assets/avatars/face-3.jpg') }}">
                                        </a>
                                    </li>
                                </ul>
                                <span class="badge badge-pill badge-dark">1h ago</span>
                            </div>
                        </div>
                        <div class="pb-3 timeline-item item-success">
                            <div class="pl-5 small">
                                <div class="mb-2"><strong>@Kelley Sonya</strong><span class="text-muted small mx-1">has
                                        commented
                                        on</span><strong>Advanced table</strong></div>
                                <div class="card d-inline-flex mb-2">
                                    <div class="card-body bg-light py-2 px-3"> Lorem ipsum dolor
                                        sit
                                        amet, consectetur adipiscing elit. </div>
                                </div>
                                <span class="badge badge-pill badge-dark">1h ago</span>
                            </div>
                        </div>
                    </div> --}}
                    <!-- / .timeline -->
                </div>
                <!-- .tab-pane -->
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
