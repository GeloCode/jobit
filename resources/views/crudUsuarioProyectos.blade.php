<!doctype html>
<html lang="en">
    <head>
        @include('includes.head')
        <title></title>
    </head>
    <body>
        <div class="container">
        <h1>portfolio.blade!!!</h1>
            <div id="app">
                <dashboardUser hashid="{{ $id=app('request')->input('id') }}"></dashboardUser>
            </div>
        </div>
        @include('includes.scripts')
    </body>
</html>
