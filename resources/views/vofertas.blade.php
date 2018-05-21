<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
    <title>Job IT</title>
</head>

<body>
    <div class="container mx-auto">
        <div id="ofertas" class="row">
            <div class="col-sm-12">
                <h1 class="page-header">CRUD Laravel & VUE</h1>
            </div>
            <div class="col-sm-7">
                <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create">
                Nueva Tarea
            </a>
                <table class="table table-hover table-striped" v-if="!esEmpresa">
                    <thead>
                        <tr>
                        <th>ID</th>
                            <th>Titulo</th>
                            <th colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="oferta in ofertas">
                            <td width="10px"> @{{oferta.id}} </td>
                            <td> @{{oferta.titulo}} </td>
                            <td width="10px">
                                <a href="#" class="btn btn-info btn-sm">Ver Oferta</a>
                            </td>
                            <td width="10px">
                                <a href="#" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                            <td width="10px">
                                <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-5">
                <pre>@{{ $data }}</pre>
            </div>
        </div>
    </div>
    @include('ofertas.create')
    @include('includes.scripts')
</body>