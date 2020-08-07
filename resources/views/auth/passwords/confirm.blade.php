@extends('layouts.auth')

@section('title')
    Confirmation
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
                    {{ __('Confirm it is you') }}
                </h4>

                <p class="mb-4">
                    oh please pardon us.
                    <br>
                    We're just performing a simple account verification test to ensure this account has not been hijacked. Enter your password to proceed
                </p>
            </div>

            <form class="user" method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="form-group">
                    <input
                        class="form-control form-control-user"
                        type="password"
                        id="password"
                        name="password"
                        aria-describedby="passwordHelp"
                        placeholder="Your Password is..."
                        required
                        autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <button
                    class="btn btn-primary btn-block text-white btn-user"
                    type="submit">
                    {{ __('Confirm Password') }}
                </button>
            </form>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="small" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
