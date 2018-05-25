<template>
    <div class="container">
            <center><h2>Los proyectos {{myProp}}</h2></center>
            <div class="row">
                <div v-for="proyecto in proyectos" :key="proyecto.id" class="col-md-4 offset-3"> 
                    <p>{{proyecto.titulo}}</p>
                    <p>{{proyecto.descripcion}}</p>
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
        props: {
            myProp: String
        },
        //llamada a la funcion
        //en cuanto se cree! (created), que se haga la funcion
        created: function () {
            this.getProyectos();
          
        },
        //end
        //aqui almacenamos datos
        data: function(){
            return {
                proyectos: []
            }
        }, 
        methods: {
            since: function (d) {
                return moment(d).fromNow();
            },
            getProyectos: function () {
                var urlProyectos = 'proyectos/1';
                axios.get(urlProyectos).then(response => {
                    this.proyectos = response.data;
                }).catch(error => {
                    proyectos = { 'id': 1 };
                });
            },
        }

    }
</script>