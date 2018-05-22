require('./bootstrap');

window.axios = require('axios');

window.Vue = require('vue');

Vue.component('example', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
});


const ofertas = new Vue({
    el: '#ofertas',
    created: function(){
        this.getOfertas();
        this.isEmpresa();
        this.getProvincias();
    },
    data: {
        ofertas : [],
        oferta: {
            id: '',
            provincia_id: 0,
            titulo: '',
            descripcion: '',
            vacantes: ''
        },
        provincias: [],
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
        deleteOferta: function(oferta){
            if(confirm('Estas Seguro?')){
                var url = 'ofertas/' + oferta.id;
                axios.delete(url).then(response => {
                    this.getOfertas();
                });
            }
        },
        addOferta: function(oferta){
            var url = 'oferta';
            axios.post(url, {
                user_id: 2,  //TODO Cambiarlo por el id de usuario real
                provincia_id: this.oferta.provincia_id,            
                titulo: this.oferta.titulo,
                descripcion: this.oferta.titulo,
                vacantes: this.oferta.vacantes,
            }).then(response => {
                this.getOfertas();
                this.oferta = {};
                toastr.success('Nueva oferta insertada correctamente!');
            }).catch(error => {
                this.errors = error.response.data;
            });
        },
        isEmpresa: function(id){
            var url = 'isEmpleado/' + 2; //TODO Cambairlo por el id del usuario
            axios.get(url).then(response => {
                var role = response.data;
                this.esEmpresa = role == 'Empresa' ? true : false;
            })
        },
        getProvincias: function(){
            var url = 'provincias';
            axios.get(url).then(response => {
                this.provincias = response.data;
            });
        }
    }
});
