@extends('layouts.auth')

 @section('title')
     Login
 @endsection

 @section('content')
 <div class="row">
    <div class="col-lg-6 d-none d-lg-flex">
        <div class="flex-grow-1 bg-login-image" style="background-image: url('@imgURL(dogs/image3.jpeg)');"></div>
    </div>

    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h4 class="text-dark mb-4">
                    Welcome Back!
                </h4>
            </div>

            <form class="user" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input class="form-control form-control-user @error('email') is-invalid @enderror"
                        type="email"
                        id="email"
                        aria-describedby="emailHelp"
                        placeholder="Enter Email Address..."
                        name="email"
                        value="{{ old('email') }}"
                        required=""
                        autocomplete="email"
                        autofocus>
                </div>

                <div class="form-group">
                    <input class="form-control form-control-user @error('password') is-invalid @enderror"
                        id="password"
                        type="password"
                        placeholder="Password"
                        name="password"
                        required=""
                        autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                        <div class="form-check">
                            <input class="form-check-input custom-control-input"
                                type="checkbox"
                                id="remember"
                                name="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label custom-control-label"
                                for="remember_me_check">
                                {{ __('Remembe Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-block text-white btn-user" type="submit">
                    Login
                </button>

                {{-- <hr>
                <a class="btn btn-primary btn-block text-white btn-google btn-user" role="button">
                    <i class="fab fa-google"></i> Login with Google
                </a>

                <a class="btn btn-primary btn-block text-white btn-facebook btn-user" role="button">
                    <i class="fab fa-facebook-f"></i> Login with Facebook
                </a> --}}

                <hr>
            </form>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="small" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif

            <div class="text-center">
                <a class="small" href="{{ route('register') }}">
                    {{ __('Create an Account') }}
                </a>
            </div>
        </div>
    </div>
</div>
 @endsection
