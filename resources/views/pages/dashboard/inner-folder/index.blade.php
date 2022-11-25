@extends('layouts.app-layout')

@section('title', $name )

@push('styles')
<link rel="stylesheet" href="{{ asset('css/select2.css') }}">
@endpush

@section('content')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <livewire:pages.dashboard.inner-dashboard-index :slug='$slug'>
                </livewire:pages.dashboard.inner-dashboard-index>
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
