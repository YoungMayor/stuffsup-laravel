@extends('layouts.main')

@section('title')
    Welcome Page
@endsection

@section('content')
<div class="text-center mt-5">
    <div
        class="error mx-auto"
        data-text="404"
        style="background-image: url('@imgURL(error.png)');
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                height: 112px;">
        <p class="m-0 d-none">404</p>
    </div>

    <p class="text-dark mb-5 lead">
        Page Not Found
    </p>

    <p class="text-black-50 mb-0">
        It looks like you found a glitch in the matrix...
    </p>

    <a href="{{ route('index') }}">
        ← Back to Store Place
    </a>
</div>
@endsection
