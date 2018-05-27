<template>

    <div class="container"> 
                <proyectos :portfid="hashid"></proyectos>

    </div>
   
</template>

<script>
    import axios from 'axios'
    import moment from 'moment'
    import toastr from 'toastr'
    import Proyectos from './Proyectos.vue';
    moment.locale('es');
    export default {
        props: ['hashid'], //hashid es el id del porfolio poviniente del proyectos.blade
        data: function () {
            return {
                 portfolios: [],
               }
        },
        created: function () {
            this.getPortfolios();
        },
        components: {
            proyectos: Proyectos
        },
        //end
        //funcionalidad. aqui se llama a laravel y que te pase datos.
        methods: {
             getPortfolios: function () {
                    var urlPortfolios = 'portfolios';
                    axios.get(urlPortfolios).then(response => {
                        this.portfolios = response.data;
                    }).catch(error => {
                        portfolios = { 'id': 1 };
                    });
            },
            getProyectos: function (){
                
            }
        }
    }
</script>