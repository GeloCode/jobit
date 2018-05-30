<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('includes.head')
        <title>Job IT</title>
    </head>
    <body>
        <ul>
            <li><a href="/vofertas">Ofertas Solicitante</a></li>
            <li><a href="/vofertasempresa">Ofertas Empresa (Entrar solo con usuario empresa)</a></li>
            <li><a href="/vinscripcionesolicitante">Inscripciones Solicitante</a></li>
            <li><a href="/vinscripcionesempresa">Inscripciones Empresa (Entrar solo con un usuario de empresa)</a></li>
            <li><a href="/portf">Portfolios usuarios</a></li>
            <li><a href="/dash">User Dashboard (proyectos CRUD)</a></li>
            <li><a href="/formulario">Crear Portfolio(primera vez logueado)</a></li>
            <li><a href="/home">Login/Register</a></li>
        </ul>
        <div id="app" class="container">
            @yield('content')
        </div>
        @include('includes.scripts')
    </body>
</html>
