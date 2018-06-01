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

     <ul>
        <li>
            <a href="/vofertasempresa">Ofertas Empresa (Entrar solo con usuario empresa)</a>
        </li>
        <li>
            <a href="/vinscripcionesempresa">Inscripciones Empresa (Entrar solo con un usuario de empresa)</a>
        </li>
        <li>
            <a href="/portf">Portfolios usuarios</a>
        </li>
        <li>
            <a href="/dash">User Dashboard (proyectos CRUD)</a>
        </li>
        <li>
            <a href="/formulario">Crear Portfolio(primera vez logueado)</a>
        </li>
    </ul>
</body>

</html>