require('./bootstrap');

window.axios = require('axios');

window.Vue = require('vue');
Vue.component('login', require('./components/LoginComponent.vue'));
Vue.component('register', require('./components/Register.vue'));
Vue.component('example', require('./components/ExampleComponent.vue'));
const app = new Vue({
    el: '#app'
});
