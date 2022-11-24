<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <ul class="nav">
        <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                <span class="fe fe-bell fe-16"></span>
            </a>
        </li>
        <li class="nav-item ml-2">
            <div class="d-flex flex-column">
                <div class="pt-1"> <strong>{{ $name }}</strong></div>
                <div class="">{{ @$division }}</div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                {{-- <a class="dropdown-item" href="#">Profile</a> --}}
                <a class="dropdown-item mx-auto" type="button" wire:click="getProfile">
                    <x-heroicon-o-pencil-square style="height: 15px" class="mr-1"></x-heroicon-o-pencil-square> Edit
                    Profile
                </a>

                <a class="dropdown-item mx-auto" type="button" wire:click="getPassword">
                    <x-heroicon-o-shield-exclamation style="height: 15px" class="mr-1">
                    </x-heroicon-o-shield-exclamation> Change
                    Password
                </a>
                <a class="dropdown-item bg-danger text-white" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <x-heroicon-o-arrow-left-on-rectangle style="height: 15px" class="mr-1">
                    </x-heroicon-o-arrow-left-on-rectangle>
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>

    @if($modalProfile=="set-profile")
    <livewire:user.profile></livewire:user.profile>
    @elseif($modalProfile=="set-password")
    <livewire:user.change-password></livewire:user.change-password>
    @endif

</nav>
