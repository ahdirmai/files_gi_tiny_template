<div>
    <div class="d-flex justify-content-between">
        <div class="col-md-8 d-flex justify-content-start p-0">
            <div class="form-group col-md-3 p-0 mr-1">
                <select wire:model="divisi" class="form-control">
                    <option value='0'>Show All</option>
                    @foreach ( $divisions as $division )
                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group col-md-4 p-0">
                <button type="button" class="btn mb-2 btn-light border rounded" wire:click.prevent="addUser">
                    <x-heroicon-o-plus style="height: 15px" class="mr-1"></x-heroicon-o-plus>
                    Add Data User
                </button>
            </div>
            {{-- {{ $divisi }} --}}
        </div>
        <div class="form-group col-md-4 mr-4 text-right">
            <div class="form-group row">
                <label for="Search" class="col-sm-3 col-form-label px-0">Search :
                </label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <input type="text" wire:model="search" class="form-control" id="search" placeholder="Search">
                        <div class="input-group-append">
                            <div class="input-group-text" id="button-addon-date">
                                <x-heroicon-o-magnifying-glass style="height: 15px" class="mr-1">
                                </x-heroicon-o-magnifying-glass>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>

        <table class="table table-hover">
            {{-- {{ $selectDivisi }} --}}
            <thead class="text-center">
                <tr>
                    <th class="text-dark font-weigh-bold">No</th>
                    <th class="text-dark font-weigh-bold">Nama</th>
                    <th class="text-dark font-weigh-bold">Username</th>
                    <th class="text-dark font-weigh-bold">Divisi</th>
                    <th class="text-dark font-weigh-bold">Role</th>
                    <th class="text-dark font-weigh-bold text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach ( $users as $user )
                <tr>
                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ @$user->division->name }}</td>
                    <td>{{ @$user->getRoleNames()[0] }}</td>
                    <td class="text-center">
                        <a type="button" wire:click.prevent="getUser({{ $user->id }})" class="text-success mx-1">
                            <x-heroicon-s-pencil-square style="width:15px" />
                        </a>
                        |
                        <a type="button" href="" class="text-primary mx-1">
                            <x-heroicon-s-key style="width:15px" />
                        </a>
                        |
                        <a type="button" wire:click.prevent="deleteUser({{ $user->id }})" class="text-danger mx-1">
                            <x-heroicon-s-trash style="width:15px " />
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>

    @if($modal == 'create')
    <livewire:admin.create-user></livewire:admin.create-user>

    @elseif($modal=='edit')
    <livewire:admin.edit-user></livewire:admin.edit-user>

    @elseif($modal=='delete')
    <livewire:admin.delete-user></livewire:admin.delete-user>

    @endif



</div>
