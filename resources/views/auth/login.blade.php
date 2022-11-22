@extends('layouts.auth-layout')

@section('title','Login')
@section('content')
<div class="row align-items-center h-100">
    <div class="col-lg-4 col-md-6 col-12 mx-auto ">

        <div class="text-center">
            <a class="navbar-brand mx-auto mt-5 flex-fill text-center" href="/">
                <img src="{{ asset('assets/icon/gi-icon.png') }}" alt="" class="img">
            </a>
        </div>
        <form class="border shadow p-3" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="text-center my-4">
                <h2>Login ke Akun Anda</h2>
                <p>Masukkan username dan password untuk login!</p>
            </div>

            <div class="form-group mb-4 mt-4">
                <label for="username">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    aria-describedby="username" name="username">

                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group mb-4 mt-4">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                    name="password">
                @error('password')
                <span class=" invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="checkbox mb-4 mt-4">
                <input type="checkbox" id="remember-me" value="remember-me" class="mr-2" "><label
                    for=" remember-me">Remember me </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
            <div class="text-center">
                <p class="mt-5 mb-3 text-muted">Digitaliz © 2022</p>
            </div>
        </form>
    </div>

</div>

@endsection
@push('script')
<script>
    (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
</script>
@endpush
