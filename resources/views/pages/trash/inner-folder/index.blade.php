@extends('layouts.app-layout')

@section('title','Trash')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row align-items-center my-3">
                    <div class="col-md-8">
                        <h2 class="page-title">Folder Name</h2>
                    </div>
                    <div class="col-md-4 ">
                        <div class="my-auto mr-5 d-flex justify-content-end">
                            <div class="row section-header-breadcrumb">
                                <div class="breadcrumb-item"><a href="#">Trash</a></div>
                                <div class="breadcrumb-item"><a href="#">dua</a></div>
                                <div class="breadcrumb-item"><a href="#">tiga</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <x-search-bar></x-search-bar>
                    <div class="form-group col-md-1">
                        <button type="button" class="btn mb-2 btn-primary" data-toggle="dropdown"><span
                                class="fe fe-plus fe-16 mr-2"></span>Tambah</button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">
                                <span class="fe fe-folder mr-2"></span>
                                Folder
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="fe fe-file mr-2"></span>
                                File</a>
                            <a class="dropdown-item" href="#">
                                <span class="fe fe-link mr-2"></span>
                                URL</a>
                        </div>
                    </div>
                </div>

                <div class="file-container">
                    <div class="file-panel mt-2">
                        <h6 class="mb-3">Folder</h6>
                        <div class="row my-4">
                            <x-folder></x-folder>
                        </div>
                    </div>
                    {{-- content Detail Sidebar --}}
                    <x-detail-panel></x-detail-panel>
                    {{-- End Content Detail Sidebar --}}
                </div>


                <div class="file-container">
                    <div class="file-panel mt-4">
                        {{-- <h6 class="mb-3">File</h6> --}}
                        <table class="table table-borderless table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="w-50">Name</th>
                                    <th>Owner</th>
                                    <th>Last Update</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <div class="circle circle-sm bg-light">
                                            <span class="fe fe-folder fe-16 text-muted"></span>
                                        </div>
                                        <span class="dot dot-md bg-success mr-1"></span>
                                    </td>
                                    <th scope="row"> Admin Template Components<br />
                                        <span class="badge badge-light text-muted">Folder</span>
                                    </th>
                                    <td class="text-muted">Penelope Roy</td>
                                    <td class="text-muted">Mar 17, 2020</td>
                                    <td>
                                        <div class="file-action">
                                            <button type="button"
                                                class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu m-2">
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-chevrons-right fe-12 mr-4"></i>Move</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-copy fe-12 mr-4"></i>Copy</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-edit-3 fe-12 mr-4"></i>Rename</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-share fe-12 mr-4"></i>Share</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-download fe-12 mr-4"></i>Download</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="circle circle-sm bg-light">
                                            <span class="fe fe-archive fe-16 text-muted"></span>
                                        </div>
                                        <span class="dot dot-md bg-warning mr-1"></span>
                                    </td>
                                    <th scope="row"> Template<br />
                                        <span class="badge badge-light text-muted mr-2">2.2M</span>
                                        <span class="badge badge-light text-muted">Zip</span>
                                    </th>
                                    <td class="text-muted"> Cade Beard </td>
                                    <td class="text-muted">Aug 20, 2020</td>
                                    <td>
                                        <div class="file-action">
                                            <button type="button"
                                                class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu m-2">
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-chevrons-right fe-12 mr-4"></i>Move</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-copy fe-12 mr-4"></i>Copy</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-edit-3 fe-12 mr-4"></i>Rename</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-share fe-12 mr-4"></i>Share</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-download fe-12 mr-4"></i>Download</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="circle circle-sm bg-light">
                                            <span class="fe fe-film fe-16 text-muted"></span>
                                        </div>
                                        <span class="dot dot-md bg-success mr-1"></span>
                                    </td>
                                    <th scope="row"> Creative Logo<br />
                                        <span class="badge badge-light text-muted mr-2">1G</span>
                                        <span class="badge badge-light text-muted">Mp4</span>
                                    </th>
                                    <td class="text-muted">Whilemina Pate</td>
                                    <td class="text-muted">Oct 10, 2019</td>
                                    <td>
                                        <div class="file-action">
                                            <button type="button"
                                                class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu m-2">
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-chevrons-right fe-12 mr-4"></i>Move</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-copy fe-12 mr-4"></i>Copy</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-edit-3 fe-12 mr-4"></i>Rename</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-share fe-12 mr-4"></i>Share</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-download fe-12 mr-4"></i>Download</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="circle circle-sm bg-light">
                                            <span class="fe fe-folder fe-16 text-muted"></span>
                                        </div>
                                        <span class="dot dot-md bg-primary mr-1"></span>
                                    </td>
                                    <th scope="row"> Bootstrap<br />
                                        <span class="badge badge-light text-muted">Folder</span>
                                    </th>
                                    <td class="text-muted">Lionel Carney</td>
                                    <td class="text-muted">Jan 20, 2021</td>
                                    <td>
                                        <div class="file-action">
                                            <button type="button"
                                                class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu m-2">
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-chevrons-right fe-12 mr-4"></i>Move</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-copy fe-12 mr-4"></i>Copy</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-edit-3 fe-12 mr-4"></i>Rename</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-share fe-12 mr-4"></i>Share</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-download fe-12 mr-4"></i>Download</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">
                                        <span class="small text-muted text-uppercase">Yesterday</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="circle circle-sm bg-light">
                                            <span class="fe fe-file-text fe-16 text-muted"></span>
                                        </div>
                                        <span class="dot dot-md bg-secondary mr-1"></span>
                                    </td>
                                    <th scope="row"> Template<br />
                                        <span class="badge badge-light text-muted mr-2">120K</span>
                                        <span class="badge badge-light text-muted">Text</span>
                                    </th>
                                    <td class="text-muted">Nayda Delacruz</td>
                                    <td class="text-muted">Sep 19, 2020</td>
                                    <td>
                                        <div class="file-action">
                                            <button type="button"
                                                class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu m-2">
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-chevrons-right fe-12 mr-4"></i>Move</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-copy fe-12 mr-4"></i>Copy</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-edit-3 fe-12 mr-4"></i>Rename</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-share fe-12 mr-4"></i>Share</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-download fe-12 mr-4"></i>Download</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="circle circle-sm bg-light">
                                            <span class="fe fe-pen-tool fe-16 text-muted"></span>
                                        </div>
                                        <span class="dot dot-md bg-success mr-1"></span>
                                    </td>
                                    <th scope="row"> Tiny Admin Homepagge UI<br />
                                        <span class="badge badge-light text-muted mr-2">5M</span>
                                        <span class="badge badge-light text-muted">PSD</span>
                                    </th>
                                    <td class="text-muted">Leilani Larson</td>
                                    <td class="text-muted">Feb 5, 2020</td>
                                    <td>
                                        <div class="file-action">
                                            <button type="button"
                                                class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu m-2">
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-chevrons-right fe-12 mr-4"></i>Move</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-copy fe-12 mr-4"></i>Copy</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-edit-3 fe-12 mr-4"></i>Rename</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-share fe-12 mr-4"></i>Share</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-download fe-12 mr-4"></i>Download</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <div class="circle circle-sm bg-light">
                                            <span class="fe fe-file fe-16 text-muted"></span>
                                        </div>
                                        <span class="dot dot-md bg-warning mr-1"></span>
                                    </td>
                                    <th scope="row"> Index page convverted<br />
                                        <span class="badge badge-light text-muted mr-2">1M</span>
                                        <span class="badge badge-light text-muted">HTML</span>
                                    </th>
                                    <td class="text-muted">Dennis Pollard</td>
                                    <td class="text-muted">Oct 30, 2019</td>
                                    <td>
                                        <div class="file-action">
                                            <button type="button"
                                                class="btn btn-link dropdown-toggle more-vertical p-0 text-muted mx-auto"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted sr-only">Action</span>
                                            </button>
                                            <div class="dropdown-menu m-2">
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-chevrons-right fe-12 mr-4"></i>Move</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-copy fe-12 mr-4"></i>Copy</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-edit-3 fe-12 mr-4"></i>Rename</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-delete fe-12 mr-4"></i>Delete</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-share fe-12 mr-4"></i>Share</a>
                                                <a class="dropdown-item" href="#"><i
                                                        class="fe fe-download fe-12 mr-4"></i>Download</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection


@push('scripts')
<script src="{{ asset('js/select2.min.js') }}"></script>

<script>
    $('.select2').select2({
            theme: 'bootstrap4',
        });
</script>
@endpush
