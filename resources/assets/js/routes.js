import Vue from 'Vue'
import VueRouter from 'vue-router'

import Proyectos from './components/Proyectos.vue'
import Portfolio from './components/Portfolio.vue'

Vue.use(VueRouter)

const router = new VueRouter ({
    routes: [
        { path: '/proyectos', component: Proyectos},
        { path: '/portfolio', component: Portfolio}
    ]
})
export default router