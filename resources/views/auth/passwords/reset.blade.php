
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
                    {{ __('Create New Password') }}
                </h4>

                <p class="mb-4">
                    {{ __('Just one more step, create a new secure yet memorable password.') }}
                </p>
            </div>

            <form class="user" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group">
                    <input
                        class="form-control form-control-user"
                        type="email"
                        id="email"
                        name="email"
                        value="{{ $email ?? old('email') }}"
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

                <div class="form-group">
                    <input
                        class="form-control form-control-user"
                        type="password"
                        id="password"
                        name="password"
                        aria-describedby="passwordHelp"
                        placeholder="Create new password..."
                        required
                        autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group">
                    <input
                        class="form-control form-control-user"
                        type="password"
                        id="password-confirm"
                        name="password_confirmation"
                        aria-describedby="passwordHelp"
                        placeholder="Create new password..."
                        required
                        autocomplete="new-password">

                        @error('password_confirmation')
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
        </div>
    </div>
</div>
@endsection
