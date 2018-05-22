<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('includes.head')
    <title>Job IT</title>
</head>

<body>
    <div class="container mx-auto">
        <div id="ofertas">
            <h1>Ofertas</h1>
            <form @submit.prevent="addOferta">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Título" v-model="oferta.titulo">
                </div>
                <div class="form-group">
                        <textarea class="form-control" placeholder="Descripción" v-model="oferta.descripcion"></textarea>
                </div>
                <div class="form-group">
                    <select class="custom-select" name="selectProvincia" v-model="oferta.provincia_id">
                        <option v-for="provincia in provincias" v-bind:value="provincia.id">@{{ provincia.nombre }}</option>
                    </select>
                </div>
                <div class="form-group">
                        <input type="number" class="form-control" placeholder="Vacantes" v-model="oferta.vacantes">
                </div>
                <button type="submit" class="btn btn-dark btn-block mb-4">Guardar</button>
            </form>
            <div class="card card-body mb-2" v-for="oferta in ofertas">
                <h3 class="card-title">@{{ oferta.titulo }}</h3>
                <p class="card-text">@{{ oferta.descripcion }}</p>
                <button class="btn btn-block btn-primary">Ver</button>                
                <button class="btn btn-block btn-alert">Editar</button>                
                <button class="btn btn-block btn-danger" v-on:click="deleteOferta(oferta)">Eliminar</button>                
            </div>
            <div class="col-sm-5">
                <pre>@{{ $data }}</pre>
            </div>
        </div>
    </div>
    @include('includes.scripts')
</body>