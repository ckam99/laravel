import {createRouter, createWebHistory} from 'vue-router'
import Home from '../views/Home.vue'

const router = createRouter({
    history: createWebHistory(__dirname),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },{
            path: '/about',
            name: 'about',
            component: () => import('../views/About.vue')
        },{
            path: '/:pathMatch(.*)*',
            name: 'e404',
            component: () => import('../views/404.vue')
        }
    ]
})

export default router