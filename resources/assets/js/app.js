require('./bootstrap');

window.axios = require('axios');

window.Vue = require('vue');

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
