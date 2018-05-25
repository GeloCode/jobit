require('./bootstrap');
window.Vue = require('vue');

//los imports del ROUTING
//import VueResource from 'vue-resource' 
//import VueRouter from 'vue-router' 
//importamos el routes.js
//import Routes from './routes'
//Vue.use(VueResource);
//Vue.use(VueRouter);
//fin
//window.axios = require('axios');

Vue.component('portf', require('./components/Portfolio.vue'));
Vue.component('detail', require('./components/Proyectos.vue'));
//Vue.component('detalle', require('./components/Detalleportf.vue'));


const app = new Vue({
    el: '#app'
});