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

    <body class="page-top">
        @include('layouts.plugins.filter_modal')

        <div id="wrapper">
            @include('layouts.plugins.side_nav')

            @auth
                @include('layouts.plugins.top_bar_user')
            @else
                @include('layouts.plugins.top_bar_guest')
            @endauth

            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <div class="container-fluid" id="pageBody">
                        @yield('content')
                    </div>
                </div>

                <footer class="bg-white sticky-footer">
                    <div class="container my-auto">
                        <div class="text-center my-auto copyright">
                            <span>Copyright © StuffsUp 2019</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <a class="border rounded d-inline scroll-to-top" id="scroll-to-top" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

    </body>

    @include('layouts.mixins.scripts')
    @js(theme)
</html>
