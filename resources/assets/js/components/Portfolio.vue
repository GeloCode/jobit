
<template>
<div>
           <div class="col-sm-7">
           <h2>Los portfolios</h2>

                <div class="card">
                        <div class="card-header">
                            Crear Portfolio
                        </div>
                        <form v-on:submit.prevent="createPortfolio()">
                            <label for="titulo">Titulo</label>
                            <input type="text" v-model="newPortfolioTitulo" class="form-control input-sm" name="titulo">
                            <label for="descripcion">Id usuario</label>
                            <input type="text" v-model="newUser_id" class="form-control" name="user_id">
                            <label for="descripcion">Descripcion</label>
                            <textarea v-model="newPortfolioDescripcion" class="form-control" rows="5" name="descripcion"></textarea>
                            <hr>
                            <button type="submit" class="btn btn-success btn-sm">Crear</button>
                        </form>
                        </div>    
                        <div><hr>
                </div>
                <div class="card">
                        <div class="card-header">
                            Featured
                        </div>
                        <div v-for="portfolio in portfolios" :key="portfolio.id" class="card-body">
                            <h5 class="card-title" v-text="portfolio.titulo"> </h5>
                            <p class="card-text" v-text="portfolio.descripcion"> </p>
                            <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deletePortfolio(portfolio)">Borrar</a>
                            <a href="#" class="btn btn-warning">Editar</a>
                            <div class="col-md-3 offset-md-9"> <small><b>{{ since(portfolio.created_at)}} </b></small></div>
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

    moment.lang('es');
    export default {
            //llamada a la funcion
            //en cuanto se cree! (created), que se haga la funcion
            created: function(){
                this.getPortfolios();
            },
            //end
            //aqui almacenamos datos
            data: function (){
                return{
                      portfolios: [],
                      newUser_id: '',
                      newPortfolioTitulo: '',
                      newPortfolioDescripcion: ''

                }
            },
            //end
            //funcionalidad. aqui se llama a laravel y que te pase datos.
            methods: {
                since: function (d){
                    return moment(d).fromNow();
                },
                getPortfolios: function(){
                    var urlPortfolios = 'portfolios';
                    axios.get(urlPortfolios).then(response =>{
                        this.portfolios = response.data;
                    } ).catch(error => {
                        portfolios = {'id': 1};
                    });
                }, 
                createPortfolio: function(){
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
                deletePortfolio: function(portfolio){
                    var url = 'portfolios/'+portfolio.id;
                    axios.delete(url).then(response=>{
                        this.getPortfolios();
                        toastr.error('Borrado Correctamente');
                    });
                }
            }
            
    }
</script>
