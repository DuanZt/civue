// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import App from './App'
import router from './router'
import store from './store/'
import VueLazyLoad from 'vue-lazyload'

import './assets/css/fonts.css'

// 懒加载的默认图片
import defLazyImg from './assets/images/loading.gif'
const whiteList = ['/login', '/authredirect']

// 使用懒加载组件
Vue.use(VueLazyLoad, {
  loading: defLazyImg
})

Vue.use(ElementUI)

Vue.config.productionTip = false

router.beforeEach((to, from, next) => {
  if (store.state.token) { // 判断是否有token
    if (to.path === '/') {
      next({
        path: '/home' // 以登录， 跳转到home
      })
    } else {
      // if (store.getters.roles.length === 0) { // 判断当前用户是否已拉取完user_info信息
      //   store.dispatch('GetInfo').then(res => { // 拉取info
      //     const roles = res.data.role
      //     store.dispatch('GenerateRoutes', {
      //       roles
      //     }).then(() => { // 生成可访问的路由表
      //       router.addRoutes(store.getters.addRouters) // 动态添加可访问路由表
      //       next({ ...to,
      //         replace: true
      //       }) // hack方法 确保addRoutes已完成 ,set the replace: true so the navigation will not leave a history record
      //     })
      //   }).catch(err => {
      //     console.log(err)
      //   })
      // } else {
      //   next() // 当有用户权限的时候，说明所有可访问路由已生成 如访问没权限的全面会自动进入404页面
      // }
      next()
    }
  } else {
    if (whiteList.indexOf(to.path) !== -1) { // 在免登录白名单，直接进入
      next()
    } else {
      next() // 否则全部重定向到登录页
    }
  }
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: {
    App
  }
})
