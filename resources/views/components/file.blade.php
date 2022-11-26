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
            <td>
                <div class="file-action">
                    <button type="button" class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-muted sr-only">Action</span>
                    </button>
                    <div class="dropdown-menu m-2">
                        <a class="dropdown-item" href="#"><i class="fe fe-chevrons-right fe-12 mr-4"></i>Move</a>
                        <a class="dropdown-item" href="#"><i class="fe fe-copy fe-12 mr-4"></i>Copy</a>
                        <a class="dropdown-item" href="#"><i class="fe fe-edit-3 fe-12 mr-4"></i>Rename</a>
                        <a class="dropdown-item" href="#"><i class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                        <a class="dropdown-item" href="#"><i class="fe fe-share fe-12 mr-4"></i>Share</a>
                        <a class="dropdown-item" href="#"><i class="fe fe-download fe-12 mr-4"></i>Download</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
