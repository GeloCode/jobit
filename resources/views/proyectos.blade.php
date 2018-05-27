<!doctype html>
<html lang="en">
    <head>
        <title>Proyectos</title>
        @include('includes.head')
    </head>
    <body>
        <div class="container">
            <div id="app">
           <!-- {{ $id = app('request')->input('id') }}-->
                <detail hashid="{{ $id=app('request')->input('id') }}"></detail>
            </div>
        </div>
        @include('includes.scripts')
    </body>
</html>
