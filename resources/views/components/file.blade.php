<table class="table table-borderless table-striped">
    <thead>
        <tr>
            <th></th>
            <th class="w-40 text-dark font-weight-bold">Name</th>
            <th class="text-dark font-weight-bold">Owner</th>
            <th class="text-dark font-weight-bold">Last Update</th>
            <th class="text-dark font-weight-bold">Access</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($content_file as $file)
        <tr>
            <td class="text-center">
                <div class="circle circle-sm bg-light">
                    @if($file->type=='file')

                    <x-heroicon-s-document style="width:15px" class="text-secondary mx-auto" />
                    @else
                    <x-heroicon-s-link style="width:15px" class="text-secondary mx-auto" />

                    @endif
                </div>
            </td>
            <th scope="row">{{$file->name}}<br />
                <span class="badge badge-light ">{{ $file->type }}</span>
            </th>
            <td class="">{{ $file->user->name }}</td>
            <td class="">{{ $file->updated_at }}</td>
            <td class="">{{ $file->access_type }}</td>
            {{-- <td> {{ $file->slug }}</td> --}}
            <td>
                <div class="file-action">
                    <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-muted sr-only">Action</span>
                    </button>
                    <div class="dropdown-menu m-2">
                        <a class="dropdown-item pl-2" type="button" wire:click="getDetail('{{ $file->slug }}')">
                            <x-heroicon-s-information-circle style="width:15px" class="ml-0 mr-2" />Detail
                        </a>
                        <a class="dropdown-item pl-2" type="button" wire:click="getRename('{{ $file->slug }}')">
                            <x-heroicon-s-pencil-square style="width:15px" class="ml-0 mr-2" />Rename
                        </a>
                        <a class="dropdown-item pl-2" type="button" wire:click="getManage('{{ $file->slug }}')">
                            <x-heroicon-s-cog-8-tooth style="width:15px" class="ml-0 mr-2" />Manage
                        </a>
                        <a class="dropdown-item pl-2" type="button" wire:click="getDelete('{{ $file->slug }}')">
                            <x-heroicon-s-trash style="width:15px" class="ml-0 mr-2" />Delete
                        </a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
