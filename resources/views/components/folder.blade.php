<div class="col-md-6 col-lg-4">
    <div class="card shadow mb-4 ">
        <div class="card-body file-list p-2">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center flex-column ml-2 mt-2">
                    <a href="@if($page=='dashboard')
                    {{ route('dashboard.inner') }}
                    @elseif($page=='trash')
                    {{ route('trash.inner') }}
                    @elseif($page=='shared')
                    {{ route('shared.inner') }}
                    @elseif($page=='myfiles')
                    {{ route('myfiles.inner') }}

                    @endif
                    ">
                        <div class="circle circle-md bg-secondary">
                            <x-heroicon-o-folder-open style="height: 30px" class="text-white mx-auto">
                            </x-heroicon-o-folder-open>
                        </div>
                    </a>
                    <div class="mt-2 font-weight-bold text-dark">
                        <strong>{{ $folder->user->name }} </strong>
                    </div>
                </div>
                <div class="flex-fill ml-4 fname">
                    <a href="{{ route('dashboard.inner',$folder->slug) }}">
                        <strong> {{ $folder->name }}</strong><br />
                        {{-- <span class="badge badge-light text-muted">Nama</span> --}}
                    </a>
                </div>
                <div class="mr-2 mt-5">
                    <strong>
                        @if($folder->access_type=="private")
                        <x-heroicon-s-lock-closed style="width:15px" />
                        @else
                        <x-heroicon-s-globe-americas style="width:15px" />
                        @endif
                    </strong>

                </div>
                <div class="file-action">
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted more-vertical pr-0" href="#"
                            id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                            <a class="dropdown-item pl-2" type="button" wire:click="getDetail('{{ $folder->slug }}')">
                                <x-heroicon-s-information-circle style="width:15px" class="ml-0 mr-2" />Detail
                            </a>


                            @if (auth()->user()->id == $folder->owner_id || auth()->user()->hasRole('admin'))
                            <a class="dropdown-item pl-2" type="button" wire:click="getRename('{{ $folder->slug }}')">
                                <x-heroicon-s-pencil-square style="width:15px" class="ml-0 mr-2" />Rename
                            </a>
                            <a class="dropdown-item pl-2" type="button" wire:click="getManage('{{ $folder->slug }}')">
                                <x-heroicon-s-cog-8-tooth style="width:15px" class="ml-0 mr-2" />Manage
                            </a>
                            <a class="dropdown-item pl-2" type="button" wire:click="getDelete('{{ $folder->slug }}')">
                                <x-heroicon-s-trash style="width:15px" class="ml-0 mr-2" />Delete
                            </a>
                            @elseif($folder->access_type=="private")
                            <?php $param = "" ?>
                            @foreach($folder->accesses as $haveAccess)
                            @if($haveAccess->user_id == auth()->user()->id && $haveAccess->status != 'reject')
                            <?php $param = "ada" ?>
                            @endif
                            @endforeach
                            @if(!$param)
                            <a class="dropdown-item pl-2" type="button" wire:click="getRequest('{{ $folder->slug }}')">
                                <x-heroicon-s-pencil-square style=" width:15px" class="ml-0" />
                                Ask Request
                            </a>
                            @endif
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .card-body -->
    </div>
    <!-- .card -->
</div>
