@extends('layouts.app-layout')

@section('title','Dashboard')

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
                        <h2 class="page-title">Dashboard</h2>
                    </div>
                    <div class="col-md-4 ">
                        <div class="my-auto mr-5 d-flex justify-content-end">
                            <div class="row section-header-breadcrumb">
                                <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <livewire:pages.dashboard.dashboard-index></livewire:pages.dashboard.dashboard-index>
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
