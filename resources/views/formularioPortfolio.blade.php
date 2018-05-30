<!doctype html>
<html lang="en">
    <head>
        <title>Crear un nuevo portfolio</title>
        @include('includes.head')
    </head>
    <body>
        <div class="container">
            <h1>FomularioPortfolio.blade!!!</h1>
                <div id="app">
                    <formul authid="{{Auth::id()}}"></formul>
                </div>
            </div>
            @include('includes.scripts')
    </body>
</html>
