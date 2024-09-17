import * as types from './mutation-types'
import { Auth } from '../../../api'

export default {
  async login ({ commit }, authInfo) {
    const detail = await Auth.login(authInfo).catch(err => { throw err.response })
    sessionStorage.setItem('token', detail.token)
    commit(types.AUTH_LOGIN, detail.token)
  },
  async logout ({ commit, state }) {
    await Auth.logout(state.token).catch(err => { throw err.response })
    sessionStorage.removeItem('token')
    commit(types.AUTH_LOGOUT, { token: null, profile: [] })
  },
  async checkToken ({ commit }, token) {
    const result = await Auth.checkToken(token).catch(err => { throw err.response })
    return result
  },
  async createUser ({ commit }, authInfo) {
    const result = await Auth.createUser(authInfo).catch(err => { throw err.response })
    commit(types.AUTH_LOGIN, result.token)
    return result.token
  },
  async fetchProfile ({ commit, state }) {
    const list = await Auth.fetchProfile(state).catch(err => { throw err.response })
    commit(types.FETCH_AUTH_PROFILE, list)
  }
}
