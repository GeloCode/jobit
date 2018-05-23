<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')
        <title>Job IT</title>
    </head>
    <body>
        <div id="app" class="container">
            @yield('content')
        </div>
        @include('includes.scripts')
    </body>
</html>
