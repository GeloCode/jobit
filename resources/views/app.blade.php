<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')
        <title>Job IT</title>
    </head>
    <body>
        <ul>
            <li><a href="/vofertas">Ofertas</a></li>
            <li><a href="/vofertasempresa">Ofertas Empresa (Entrar solo con usuario empresa)</a></li>
            <li><a href="/vinscripcionesempresa">Inscripciones Empresa (Entrar solo con un usuario de empresa)</a></li>
            <li><a href="/home">Login/Register</a></li>
        </ul>
        <div id="app" class="container">
            @yield('content')
        </div>
        @include('includes.scripts')
    </body>
</html>
