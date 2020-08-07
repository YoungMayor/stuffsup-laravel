@extends('layouts.top_bar')

@section('menu')
<div class="d-none d-sm-block topbar-divider"></div>

<li class="nav-item" role="presentation">
    <div class="btn-group" role="group">
        <a
            class="btn btn-outline-success"
            role="button"
            href="{{ route('login') }}">
            <span>
                Login
            </span>
            <i class="fas fa-sign-in-alt p-1"></i>
        </a>

        <a
            class="btn btn-info"
            role="button"
            href="{{ route('register') }}">
            <span>
                Join
            </span>
            <i class="fas fa-user-plus p-1"></i>
        </a>
    </div>
</li>
@endsection
