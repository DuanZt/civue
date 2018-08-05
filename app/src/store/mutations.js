export default {
  increment (state) {
    // 变更状态
    state.count++
  },
  setToken (state, flag) {
    state.token = flag
  },
  setReToken (state, flag) {
    state.reToken = flag
  }
}
