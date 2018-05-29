<template>

    <div class="container">
            <center><h2>Proyecto Vista</h2></center>
             <div class="row">
                <div class="card-body col-md-6 offset-md-3">
                      <div v-for="detalle in proyecto" :key="detalle.id"> 
                          <p>{{detalle.titulo}}</p>
                          <p>IMAGEN: ----{{detalle.imagen}}</p>
                          <p>{{detalle.descripcion}}</p>
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