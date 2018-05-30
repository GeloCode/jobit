require('./bootstrap');
window.Vue = require('vue');

//HTTP REQUESTS
import VueResource from 'vue-resource'
Vue.use(VueResource);

Vue.component('portfolios', require('./components/ListaPortfolios.vue'));
Vue.component('detail', require('./components/RootComponent.vue'));
//Vue.component('detalle', require('./components/Detalleportf.vue'));
Vue.component('login', require('./components/Login.vue'));
Vue.component('register', require('./components/Register.vue'));
//Vue.component('oferta', require('./components/OfertaComponent.vue'));
Vue.component('perfil', require('./components/Perfil.vue'));
const app = new Vue({
    el: '#app',
});
