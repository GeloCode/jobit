<template>

    <div id="project-detail">
                <div>
                      <div v-for="detalle in proyecto" :key="detalle.id"> 
                          <header class="header container-fluid" v-bind:style="{'background-image': 'url('+detalle.imagen+')'}">
                            <div class="header-img row" >
                            <h2>{{detalle.titulo}}</h2>
                            </div>
                        </header>
                        <div class="container ">
                            <div class="row project">
                                <h2>{{detalle.titulo}}</h2>
                                <div class="card">
                                    <div class="card-body">{{detalle.descripcion}}</div>
                                </div>
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
        props: ['idproyecto'],
        //llamada a la funcion
        //en cuanto se cree! (created), que se haga la funcion
        created: function () {
            this.getProyecto(this.idproyecto);
        },
        //end
        //aqui almacenamos datos
        data: function () {
            return {
                proyecto: []
            }
        },
        methods: {
            since: function (d) {
                return moment(d).fromNow();
            },
            getProyecto: function (detailId) {
                var urlPortfolios = 'detail/' + detailId;
                axios.get(urlPortfolios).then(response => {
                    this.proyecto = response.data;
                }).catch(error => {
                    portfolios = { 'id': 1 };
                });
            },
            
        }

    }
</script>