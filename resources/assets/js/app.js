require('./bootstrap');

window.axios = require('axios');

window.Vue = require('vue');

Vue.prototype.$http = window.axios;

const app = new Vue({
    el: '#app'
});
