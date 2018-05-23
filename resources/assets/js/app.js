require('./bootstrap');

window.axios = require('axios');

window.Vue = require('vue');

Vue.component('example', require('./components/ExampleComponent.vue'));
Vue.component('oferta', require('./components/OfertaComponent.vue'));

const app = new Vue({
    el: '#app',
});

