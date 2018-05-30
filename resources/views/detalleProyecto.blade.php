<!doctype html>
<html lang="en">
    <head>
        <title>Detalle Proyecto!</title>
        @include('includes.head')
    </head>
    <body>
        <div class="container">
            <h1>detalleProyecto.blade!!!</h1>
                <div id="app">
                    <project idproyecto="{{ $id=app('request')->input('id') }}"></project>
                </div>
            </div>
            @include('includes.scripts')
    </body>
</html>
