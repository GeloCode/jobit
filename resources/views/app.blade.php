<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
    <title>Job IT</title>
</head>

<body>

    @include('includes.navbar')
    
   
    <div id="app">
        @yield('content')
    </div>
    @include('includes.scripts')
</body>

</html>