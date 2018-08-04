import Vue from 'vue'
import Vuex from 'vuex'
import mutations from './mutations.js'
import actions from './actions.js'
import getters from './getters.js'

import cart from './modules/cart'

Vue.use(Vuex)

/* 项目全局State */
const state = {
  token: '',
  reToken: '',
  count: 0,
  userId: 0
}

/* Store实例 */
export default new Vuex.Store({
  modules: {
    cart
  },
  state,
  getters,
  actions,
  mutations
})
