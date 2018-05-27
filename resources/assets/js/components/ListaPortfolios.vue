<template>

    <div class="container">
            <center><h2>Los portfolios</h2></center>
            <div class="row">
               
                <div class="card-body col-md-6 offset-md-3">
                <form v-on:submit.prevent="createPortfolio()">
                    <label for="titulo">Titulo</label>
                    <input type="text" v-model="newPortfolioTitulo" class="form-control" name="titulo">
                    <label for="descripcion">Id usuario</label>
                    <input type="text" v-model="newUser_id" class="form-control" name="user_id">
                    <label for="descripcion">Descripcion</label>
                    <textarea v-model="newPortfolioDescripcion" class="form-control" rows="5" name="descripcion"></textarea>
                    <hr>
                    <button type="submit" class="btn btn-success btn-sm col-md-2 offset-md-5">Crear</button>
                </form>
                </div>
            </div>


            <div class="row justify-content-between">
                <div v-for="portfolio in portfolios" :key="portfolio.id" class="card col-md-4">
                     <div v-for="nombre in nameUser" :key="nombre.id">
                                        <small><p v-if="portfolio.user_id === nombre.id">Por: <b>{{nombre.name}}</b></p></small> 
                        </div>
                    <div class="card-body">
                        {{nameUser.name}}
                        <h5 class="card-title" v-text="portfolio.titulo"> </h5>
                        <p class="card-text" v-text="portfolio.descripcion"> </p>
                        <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deletePortfolio(portfolio)">Borrar</a>
                        <a class="btn btn-success btn-sm" v-bind:href="'/projects?id=' +portfolio.id">Ver</a>
                        <div class="col-md-5 offset-md-7">
                            <small>
                                {{ since(portfolio.created_at)}}
                            </small>
                        </div>
                        <hr>
                    </div>
                    
                </div>
        </div>
    </div>

</template>

<script>
    import axios from 'axios'
    import moment from 'moment'
    import toastr from 'toastr'
    moment.locale('es');
    export default {
        //llamada a la funcion
        //en cuanto se cree! (created), que se haga la funcion
        created: function () {
            this.getPortfolios();
            this.getNames();
        },
        //end
        //aqui almacenamos datos
        data: function () {
            return {
                portfolios: [],
                newUser_id: '',
                newPortfolioTitulo: '',
                newPortfolioDescripcion: '',
                nameUser: []

            }
        },
        components: {
            //'proyectos' :Proyectos
        },
        //end
        //funcionalidad. aqui se llama a laravel y que te pase datos.
        methods: {
            since: function (d) {
                return moment(d).fromNow();
            },
            getPortfolios: function () {
                var urlPortfolios = 'portfolios';
                axios.get(urlPortfolios).then(response => {
                    this.portfolios = response.data;
                }).catch(error => {
                    portfolios = { 'id': 1 };
                });
            },
            showPortfolio: function(portfolio) {
                var urlPortfolio = 'portfolio'+portfolio.id;
                axios.get(urlPortfolio).then(response =>{
                    this.portfolio = response.data;
                }).catch(error => {
                     portfolios = { 'id': 1 };
                });
            },
            getNames: function(){
                var url = 'selectName';
                axios.get(url).then(response =>{
                    this.nameUser = response.data;
                }).catch(error => {
                    portfolios = {'id':1};
                })
            },
            createPortfolio: function () {
                var urlportf = 'crearPortfolio';
                axios.post(urlportf, {
                    user_id: this.newUser_id,
                    titulo: this.newPortfolioTitulo,
                    descripcion: this.newPortfolioDescripcion
                }).then(response => {
                    this.getPortfolios();
                    this.newUser_id = '';
                    this.newPortfolioTitulo = '';
                    this.newPortfolioDescripcion = '';
                    toastr.success('Portfolio creado con exito');
                }).catch(error => {
                    toastr.error('Error al crear el portfolio');
                });
            },
            deletePortfolio: function (portfolio) {
                var url = 'portfolios/' + portfolio.id;
                axios.delete(url).then(response => {
                    this.getPortfolios();
                    toastr.error('Borrado Correctamente');
                });
            },
            getPortfolioById: function(portfolio){
                let url=window.location.href="/portfolio/"+portfolio.id;
                axios.get(url);
            }
        }

    }
</script>