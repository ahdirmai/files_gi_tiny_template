@extends('layouts.app-layout')

@section('title','Shared')

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
                        <h2 class="page-title">Shared</h2>
                    </div>
                    <div class="col-md-4 ">
                        <div class="my-auto mr-5 d-flex justify-content-end">
                            <div class="row section-header-breadcrumb">
                                <div class="breadcrumb-item"><a href="#">Shared</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <x-search-bar></x-search-bar>
                </div>

                <div class="file-container">
                    <div class="file-panel mt-4">
                        <h6 class="mb-3">Base Folder</h6>
                        <div class="row my-4">
                            <x-folder></x-folder>
                        </div>
                    </div>
                    {{-- content Detail Sidebar --}}
                    <x-detail-panel></x-detail-panel>
                    {{-- End Content Detail Sidebar --}}
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
