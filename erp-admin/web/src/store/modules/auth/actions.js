import * as types from './mutation-types'
import { Auth } from '../../../api'

export default {
  async login ({ commit }, authInfo) {
    const detail = await Auth.login(authInfo).catch(err => { throw err.response })
    sessionStorage.setItem('token', detail.token)
    commit(types.AUTH_LOGIN, detail.token)
  },
  logout ({ commit, state }) {
    Auth.logout(state.token)
    sessionStorage.removeItem('token')
    commit(types.AUTH_LOGOUT, null)
  }
}
