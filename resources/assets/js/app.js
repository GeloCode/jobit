require('./bootstrap');
window.Vue = require('vue');

//HTTP REQUESTS
import VueResource from 'vue-resource'
Vue.use(VueResource);

/////////////////////////
//los imports del ROUTING
//import VueResource from 'vue-resource' 
//import VueRouter from 'vue-router' 
//importamos el routes.js
//import Routes from './routes'
//Vue.use(VueResource);
//Vue.use(VueRouter);
//fin
//window.axios = require('axios');

Vue.component('portfolios', require('./components/ListaPortfolios.vue'));
Vue.component('detail', require('./components/RootComponent.vue'));
//Vue.component('detalle', require('./components/Detalleportf.vue'));


const app = new Vue({
    el: '#app'
});