<template>
    <div class="container">
            <div class="row justify-content-between">
                        
                            <div v-for="portfolio in infoPortfolio" :key="portfolio.id" class="card col-md-12">
                                
                                        <div class="card-body">
                                            <center><h4>{{portfolio.titulo}}</h4></center>
                                            <center><p>{{portfolio.text}}</p></center>
                                        </div>
                            </div>
                    </div>
            <center><h2>Proyectosss</h2></center> 
                <div class="row justify-content-between">
                        
                            <div v-for="proyecto in proyectos" :key="proyecto.id" class="card col-md-4">
                                <div v-if="proyecto.portfolio_id == portfid">
                               <!-- <p v-if="proyecto.portfolio_id == '3'">-->
                                        <div class="card-body">
                                            <h5>{{proyecto.titulo}}</h5>
                                             <p>{{proyecto.imagen}}</p>
                                            <p>{{proyecto.descripcion}}</p>
                                            <a class="btn btn-success btn-sm" v-bind:href="'/detailProject?id=' + proyecto.id">Ver</a>
                                        </div>
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
        props: ['portfolios', 'portfid'],
        created: function () {
            this.getProyectos(this.portfid);
            this.getInfoPortfolio(this.portfid);
        },
        //end
        //aqui almacenamos datos
        data: function(){
            return {
                proyectos: [],
                infoPortfolio: []
            }
        }, 
        methods: {
            since: function (d) {
                return moment(d).fromNow();
            },
            getProyectos: function (portf_id) {
                var urlProyectos = 'projct/' +portf_id;
                axios.get(urlProyectos).then(response => {
                    this.proyectos = response.data;
                }).catch(error => {
                    proyectos = { 'id': 1 };
                });
            },
            getInfoPortfolio: function (portf_id) {
                var urlPortfolio = 'info/' +portf_id;
                axios.get(urlPortfolio).then(response => {
                    this.infoPortfolio = response.data;
                }).catch(error => {
                    proyectos = { 'id': 1 };
                });
            },
              deleteProyecto: function (proyecto) {
                var url = 'proyectos/' + proyecto.id;
                axios.delete(url).then(response => {
                    this.getProyectos();
                    toastr.error('Borrado Correctamente');
                });
            },
        }

    }
</script>