export default {
  increment (state) {
    // 变更状态
    state.count++
  },
  setToken (state, token) {
    state.token = token
  },
  setReToken (state, token) {
    state.reToken = token
  }
}
