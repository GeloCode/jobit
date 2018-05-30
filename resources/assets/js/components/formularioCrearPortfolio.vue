<template>
<div>
<form method="POST" v-on:submit.prevent="createPortfolio()">

          <label for="number">Id Perfil {{authid}}</label>
          <input type="text" name="number" maxlength="9" class="form-control"> 
          <label for="number">Titulo</label>
          <input type="text" name="text" maxlength="25" class="form-control">
          <label for="number">Descripcion</label>
          <input type="text" name="text" maxlength="9" class="form-control">
          <input type="submit" class="btn btn-primary" value="Crear Portfolio">
</form>
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
            createMobile: function () {
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
                }).catch(error => {
                    this.errors = error.response.data
                });
            }
        }

    }
</script>