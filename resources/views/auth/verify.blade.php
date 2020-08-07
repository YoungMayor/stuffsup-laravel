@extends('layouts.auth')

@section('title')
    Email Cerification Required
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
                    {{ __('Please Verify your Email Address') }}
                </h4>

                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <p class="mb-4">
                    Before proceeding, please check your email for a verification link.
                    <br>
                    If you did not receive the email
                </p>
            </div>

            <form class="user" method="POST" action="{{ route('verification.resend') }}">
                @csrf

                <button
                    class="btn btn-primary btn-block text-white btn-user"
                    type="submit">
                    {{ __('click here to request another') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
