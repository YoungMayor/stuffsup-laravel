{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}

 @extends('layouts.auth')

 @section('title')
     Registration
 @endsection

 @section('content')
 <div class="row">
    <div class="col-lg-5 d-none d-lg-flex">
        <div class="flex-grow-1 bg-register-image" style="background-image: url('@imgURL(dogs/image2.jpeg)');"></div>
    </div>

    <div class="col-lg-7">
        <div class="p-5">
            <div class="text-center">
                <h4 class="text-dark mb-4">
                    Create an Account!
                </h4>
            </div>

            <form class="user" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input
                            class="form-control form-control-user @error('first_name') is-invalid @enderror"
                            type="text"
                            id="first_name"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            placeholder="First Name"
                            required="">
                    </div>

                    <div class="col-sm-6">
                        <input
                            class="form-control form-control-user @error('last_name') is-invalid @enderror"
                            type="text"
                            id="last_name"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            placeholder="Last Name"
                            required="">
                    </div>
                </div>

                <div class="form-group">
                    <input
                        class="form-control form-control-user @error('email') is-invalid @enderror"
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Email Address"
                        required="">
                </div>

                <div class="form-group">
                    <select
                        class="custom-select rounded-pill"
                        id="state"
                        name="state"
                        required="">
                        <optgroup label="Select State of Residence">
                            @foreach ($___state_map as $id => $details)
                                <option value="{{ $id }}">
                                    {{ $details['name'] }}
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input
                            class="form-control form-control-user @error('password') is-invalid @enderror"
                            type="password"
                            placeholder="Password"
                            id="password"
                            name="password"
                            required=""
                            autocomplete="new-password">
                    </div>

                    <div class="col-sm-6">
                        <input
                            class="form-control form-control-user"
                            type="password"
                            placeholder="Repeat Password"
                            name="password_confirmation"
                            required=""
                            autocomplete="new-password">
                    </div>
                </div>

                <button class="btn btn-primary btn-block text-white btn-user" type="submit">
                    {{ __('Register') }}
                </button>

                {{-- <hr>
                <a class="btn btn-primary btn-block text-white btn-google btn-user" role="button">
                    <i class="fab fa-google"></i> Register with Google
                </a>

                <a class="btn btn-primary btn-block text-white btn-facebook btn-user" role="button">
                    <i class="fab fa-facebook-f"></i> Register with Facebook
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
            <a class="small" href="{{ route('login') }}">
                Already have an account? Login!
            </a>
        </div>
    </div>
</div>
 @endsection
