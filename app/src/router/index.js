import Vue from 'vue'
import Router from 'vue-router'
import Error from '../components/404.vue'
import Home from '@/pages/home/home.vue'
import Login from '@/pages/login.vue'
import Signup from '@/pages/signup.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  linkActiveClass: 'active',
  routes: [{
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path: '/home',
    name: 'Home',
    component: Home,
    meta: {
      auth: true // 这里设置，当前路由需要校验
    }
  },
  {
    path: '/signup',
    name: 'Signup',
    component: Signup
  },
  {
    path: '/404',
    name: 'Error',
    component: Error
  },
  {
    path: '*',
    redirect: '/404'
  }
  ]
})
