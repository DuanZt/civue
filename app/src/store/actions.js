import req from '../lib/req'

/* 异步操作 */
export default {
  increment (ctx) {
    ctx.commit('increment')
  },
  signup (ctx, data) {
    // 因为是异步操作，所以必须返回一个promise对象，异步操作放到promise中，执行完之后返回供后续调用的数据
    return new Promise((resolve, reject) => {
      req(
        'post',
        'user/add',
        null,
        data,
        true
      ).then(data => {
        resolve(data)
      }).catch(err => {
        reject(err)
      })
    })
  },
  login (ctx, data) {
    return new Promise((resolve, reject) => {
      req(
        'post',
        'user/auth',
        null,
        data,
        false
      ).then((data) => {
        if (data) {
          ctx.commit('setToken', data.access_token)
          ctx.commit('setReToken', data.refresh_token)
          resolve()
        }
      }).catch((err) => {
        reject(err)
      })
    })
  }
}
