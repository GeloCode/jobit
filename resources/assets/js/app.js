require('./bootstrap');

window.axios = require('axios');

window.Vue = require('vue');

Vue.component('login', require('./components/Login.vue'));
Vue.component('register', require('./components/Register.vue'));


Vue.component('example', require('./components/ExampleComponent.vue'));
Vue.component('oferta', require('./components/OfertaComponent.vue'));
const app = new Vue({
    el: '#app',
});

