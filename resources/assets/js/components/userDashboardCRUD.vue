<template>
<div>
<div v-if="authid">
    <div>
        <form method="POST" v-on:submit.prevent="createPortfolio()">

                <label for="number">Id Perfil</label>
                <input type="text" name="number" maxlength="3" class="form-control" v-model="newPerfilId" disabled>
                <label for="number">Titulo</label>
                <input type="text" name="text" maxlength="45" class="form-control" v-model="newTitle">
                <!-- <input type="text" name="text" maxlength="9" class="form-control" v-model="newDescription">
                <input type="submit" class="btn btn-primary" value="Crear Portfolio"> -->
                <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripcion Portfolio</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" v-model="newDescription"></textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="Crear Portfolio">
        </form>
    </div>
</div>
<div v-else><h2>Inicia Sesion Primero!  <a class="btn btn-warning btn-sm" v-bind:href="'/login'">Log In</a></h2></div>
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