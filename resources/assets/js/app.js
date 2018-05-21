require('./bootstrap');

window.axios = require('axios');

window.Vue = require('vue');

Vue.component('example', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});


const ofertas = new Vue({
    el: '#ofertas',
    created: function(){
        this.getOfertas();
        this.isEmpresa();
    },
    data: {
        ofertas : [],
        esEmpresa : '',
        errors: []
    },
    methods: {
        getOfertas: function(){
            var url = 'ofertas';
            axios.get(url).then(response => {
                this.ofertas = response.data;
            });
        },
        isEmpresa: function($id){
            var url = 'isEmpleado/' + 2;
            axios.get(url).then(response => {
                var role = response.data;
                this.esEmpresa = role == 'Empresa' ? true : false;
            })
        }
    }
});
