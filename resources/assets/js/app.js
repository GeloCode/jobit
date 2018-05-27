require('./bootstrap');

window.axios = require('axios');

window.Vue = require('vue');

Vue.component('login', require('./components/Login.vue'));
Vue.component('register', require('./components/Register.vue'));


Vue.component('oferta-solicitante', require('./components/OfertaSolicitante.vue'));
Vue.component('oferta-empresa', require('./components/OfertaEmpresa.vue'));
Vue.component('inscripcion', require('./components/InscripcionComponent.vue'));
const app = new Vue({
    el: '#app',
});

