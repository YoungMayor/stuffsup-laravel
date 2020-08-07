@extends('layouts.auth')

@section('title')
    Password Recovery
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6 d-none d-lg-flex">
        <div class="flex-grow-1 bg-password-image" style="background-image: url('@imgURL(dogs/image1.jpeg)');"></div>
    </div>

    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h4 class="text-dark mb-2">
                    {{ __('Forgot Your Password?') }}
                </h4>

                <p class="mb-4">
                    {{ __('We get it, stuff happens. Just enter your email address below and we\'ll send you a link to reset your password!') }}
                </p>
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form class="user" method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <input
                        class="form-control form-control-user"
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        aria-describedby="emailHelp"
                        placeholder="Enter Email Address..."
                        required
                        autocomplete="email"
                        autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <button
                    class="btn btn-primary btn-block text-white btn-user"
                    type="submit">
                    {{ __('Reset Password') }}
                </button>
            </form>

            <hr>

            <div class="text-center">
                <a class="small" href="{{ route('register') }}">
                    {{ __('Create an Account!') }}
                </a>
            </div>

            <div class="text-center">
                <a class="small" href="{{ route('login') }}">
                    {{ __('Already have an account? Login!') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
