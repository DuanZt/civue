export function setToken (ctx, data) {
  ctx.commit('setToken', true)
  ctx.commit('setReToken', true)
  window.localStorage.setItem('tokens', JSON.stringify(data))
};
export function checkToken () {
  let tokens = window.localStorage.getItem('tokens')
  if (!tokens) {
    return false
  }
  return true
}
export function getToken () {
  let tokens = window.localStorage.getItem('tokens')
  if (!tokens) {
    return false
  }
  tokens = JSON.parse(tokens)
  return tokens.access_token
}
export function getReToken () {
  let tokens = window.localStorage.getItem('tokens')
  if (!tokens) {
    return false
  }
  tokens = JSON.parse(tokens)
  return tokens.refresh_token
}
