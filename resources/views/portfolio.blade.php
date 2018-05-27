<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Portfolios</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body>
        <div class="container">
        <h1>portfolio.blade!!!</h1>
            <div id="app">
                <portfolios></portfolios>
                
            </div>
            
        </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
