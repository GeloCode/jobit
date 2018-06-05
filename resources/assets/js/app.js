require('./bootstrap');
window.Vue = require('vue');

//HTTP REQUESTS
import VueResource from 'vue-resource'
Vue.use(VueResource);

//Componentes Illya
Vue.component('project', require('./components/ProjectDetailComponent.vue'));
Vue.component('portfolios', require('./components/ListaPortfolios.vue'));
Vue.component('detail', require('./components/Proyectos.vue'));
Vue.component('formul', require('./components/formularioCrearPortfolio.vue'));
// Fin componentes Illya

Vue.component('login', require('./components/Login.vue'));
Vue.component('register', require('./components/Register.vue'));

Vue.component('oferta-empresa', require('./components/OfertaEmpresa.vue'));
Vue.component('oferta-solicitante', require('./components/OfertaSolicitante.vue'));
Vue.component('inscripcion-solicitante', require('./components/InscripcionSolicitante.vue'));
Vue.component('inscripcion-empresa', require('./components/InscripcionEmpresa.vue'));

Vue.component('perfil', require('./components/Perfil.vue'));
Vue.component('perfil-solicitante', require('./components/perfilSolicitante.vue'));
Vue.component('dashboardUser', require('./components/userDashboardCRUD.vue'));
Vue.component('enlaces', require('./components/Enlaces.vue'));

Vue.component('home', require('./components/Home.vue'));

const app = new Vue({
    el: '#app',
});
