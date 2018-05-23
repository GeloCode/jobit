
<template>
<div>
    <router-view></router-view>
<div id="detalle">
           </div>
           <div class="col-sm-7">
           <h2>Portfolio</h2>
        
           <div class="card">
                <div class="card-header">
                    <h3>Detalle</h3>
                </div>
               
        </div>
    </div>
</div>

</template>

<script>
    export default {
            /*
            //llamada a la funcion
            //en cuanto se cree! (created), que se haga la funcion
            created: function(){
                this.getPortfolios();
            },
            //end
            //aqui almacenamos datos
            data: function (){
                return{
                      portfolios: []
                }
            },
            //end
            //funcionalidad. aqui se llama a laravel y que te pase datos.
            methods: {
                getPortfolios: function(){
                    var urlPortfolios = 'portfolios';
                    axios.get(urlPortfolios).then(response =>{
                        this.portfolios = response.data;
                    } ).catch(error => {
                        portfolios = {'id': 1};
                    });
                }
            }
     */       
    }
</script>