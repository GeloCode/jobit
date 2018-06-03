<template>
    <div class="container"> 
        <proyectos :auth="userid" :portfid="hashid" :idperfil="perfil"></proyectos>
    </div>
</template>
<script>
    import axios from 'axios'
    import moment from 'moment'
    import toastr from 'toastr'
    import Proyectos from './Proyectos.vue';
    moment.locale('es');
    export default {
        props: ['hashid', 'userid', 'perfil'], //hashid es el id del porfolio poviniente del proyectos.blade
        data: function () {
            return {
               }
        },
        created: function () {
            
        },
        components: {
            proyectos: Proyectos
        },
        //end
        //funcionalidad. aqui se llama a laravel y que te pase datos.
        methods: {
        }
    }
</script>