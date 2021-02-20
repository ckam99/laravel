import {createRouter, createWebHistory} from 'vue-router'
import Home from '../views/Home.vue'

const router = createRouter({
    history: createWebHistory(__dirname),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home, alias: '/home'
        },
        // { path: '/home', redirect: '/' },
        {
            path: '/about',
            name: 'about',
            meta: {
                auth: true,
            },
            component: () => import('../views/About.vue')
        },
        {
            path: '/login',
            name: 'login',
            meta: {
                layout: 'blank'
            },
            component: () => import('../views/auth/Login.vue')
        },
        {
            path: '/:pathMatch(.*)*',
            name: 'e404',
            component: () => import('../views/404.vue')
        }
    ]
})

router.beforeEach((to, from) => {
    // instead of having to check every route record with
    // to.matched.some(record => record.meta.requiresAuth)
    if (to.meta.auth && to.name !== 'login' && !localStorage.getItem('token')) {
      // this route requires auth, check if logged in
      // if not, redirect to login page.
      return {
        path: '/login',
        query: { redirect: to.fullPath },
      }
    }
    if (to.name == 'login' && localStorage.getItem('token')) {
        return to.redirectedFrom
      }
  })

export default router