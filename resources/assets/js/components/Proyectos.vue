<template>
    <div class="container">
            <div class="row justify-content-between">
                        
                            <div v-for="portfolio in infoPortfolio" :key="portfolio.id" class="card col-md-12">
                                
                                        <div class="card-body">
                                            <center><h4>{{portfolio.titulo}}</h4></center>
                                            <center><p>{{portfolio.descripcion}}</p></center>
                                        </div>
                            </div>
                    </div>
            <center><h2>Proyectos</h2></center>
                <div class="row justify-content-between">
                        
                            <div v-for="proyecto in proyectos" :key="proyecto.id" class="card col-md-4">
                                <div v-if="proyecto.portfolio_id == portfid">
                               <!-- <p v-if="proyecto.portfolio_id == '3'">-->
                                        <div class="card-body">
                                            <h4>{{proyecto.titulo}}</h4>
                                            <center><p>{{proyecto.descripcion}}</p></center>
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
        }

    }
</script>