require('./bootstrap');

window.Vue = require('vue');

//window.axios = require('axios');

Vue.component('portf', require('./components/Portfolio.vue'));
Vue.component('detalle', require('./components/Detalleportf.vue'));

const app = new Vue({
    el: '#app',
    //el: '#det'
});
