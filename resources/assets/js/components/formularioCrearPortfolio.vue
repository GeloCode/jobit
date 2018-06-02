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
        props: ['authid'],
        created: function () {
            this.getIdPortfolio(this.authid);
        },
        //end
        //aqui almacenamos datos
        data: function(){
            return {
                proyectos: [],
                infoPortfolio: [],
                idPortfolio: '',
                newPerfilId: this.authid,
                newTitle: '',
                newDescription: ''
            }
        }, 
        methods: {
            since: function (d) {
                return moment(d).fromNow();
            },
            getIdPortfolio: function (id_perfil){
                var url = 'pillaridportf/' + id_perfil;
                    axios.get(url).then(response =>{
                    this.idPortfolio = response.data.id;
                }).catch(error => {
                    portfolios = {'id':1};
                })
            },
            createPortfolio: function () {
                var url = 'portfolios';
                axios.post(url, {
                    perfil_id: this.newPerfilId,
                    titulo: this.newTitle,
                    text: this.newDescription
                }).then(response => {
                    this.newPerfilId = '';
                    this.newTitle = '';
                    this.newDescription = '';
                    this.errors = [];
                    //$('#create').modal('hide');
                    toastr.success('Success');
                    window.location.href = "/projects?id=" +this.idPortfolio;
                }).catch(error => {
                    this.errors = error.response.data
                    //toastr.danger('Hay algun error');
                });
            }
        }

    }
</script>