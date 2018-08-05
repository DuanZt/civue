import req from '../lib/req'
import {
  setToken
} from '../lib/utils'

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
        setToken(ctx, data)
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
          setToken(ctx, data)
          resolve()
        }
      }).catch((err) => {
        reject(err)
      })
    })
  },

  // 获取用户信息
  GetUserInfo () {
    return new Promise((resolve) => {
      req(
        'get',
        'user/view/1'
      ).then((data) => {
        resolve(data)
      })
    })
  }
}
