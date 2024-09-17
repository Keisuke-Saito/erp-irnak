import * as types from './mutation-types'

export default {
  [types.AUTH_LOGIN] (state, payload) {
    state.token = payload
  },
  [types.AUTH_LOGOUT] (state, payload) {
    state.token = payload.token
    state.profile = payload.profile
  },
  [types.FETCH_AUTH_PROFILE] (state, payload) {
    state.profile = payload
  }
}
