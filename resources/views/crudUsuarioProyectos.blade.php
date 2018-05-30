<!doctype html>
<html lang="en">
    <head>
        @include('includes.head')
        <title></title>
    </head>
    <body>
        <div class="container">
        <h1>crudUsuarioProyectos.blade!!!</h1>
            <div id="app">
                <dash hashid="{{ $id=app('request')->input('id') }}"></dash>
            </div>
        </div>
        @include('includes.scripts')
    </body>
</html>
