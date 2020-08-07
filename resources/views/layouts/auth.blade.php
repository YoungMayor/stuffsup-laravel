<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

        @include('layouts.mixins.styles')
    </head>

    <body class="{{ [
        'bg-gradient-primary',
        'bg-gradient-secondary',
        'bg-gradient-success',
        'bg-gradient-danger',
        'bg-gradient-warning',
        'bg-gradient-info',
        'bg-gradient-dark',
        'bg-gradient-light',
    ][rand(0, 7)] }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 col-lg-12 col-xl-10">
                    <div class="card shadow-lg o-hidden border-0 my-5">
                        <div class="card-body p-0">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    @include('layouts.mixins.scripts')

</html>
