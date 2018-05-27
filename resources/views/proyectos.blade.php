<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Proyectos</title>
        <h1>proyectos.blade!!!</h1>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="container">
            <div id="app">
           <!-- {{ $id = app('request')->input('id') }}-->
                <detail hashid="{{ $id=app('request')->input('id') }}"></detail>
            </div>
            
        </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
