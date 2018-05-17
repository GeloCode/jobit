require('./bootstrap');

window.axios = require('axios');

window.Vue = require('vue');
Vue.component('login', require('./components/LoginComponent.vue'));
Vue.component('register', require('./components/Register.vue'));
const app = new Vue({
    el: '#app',
    created: function(){

    },
    methods: {
        click: function(){
            alert('click');
        }
    }
});
