import * as types from './mutation-types'

export default {
  info ({ commit, rootState }, payload) {
    const id = new Date().getTime()
    const data = {
      id: id,
      message: payload.message,
      type: 'info',
      code: 200,
      timeout: payload.timeout ? payload.timeout : null
    }
    commit(types.SET, data)
    return id
  },
  success ({ commit, rootState }, payload) {
    const id = new Date().getTime()
    const data = {
      id: id,
      message: payload.message,
      type: 'success',
      code: 200,
      timeout: payload.timeout ? payload.timeout : null
    }
    commit(types.SET, data)
    return id
  },
  warning ({ commit, rootState }, payload) {
    const id = new Date().getTime()
    const data = {
      id: id,
      message: payload.message,
      type: 'warning',
      code: payload.status,
      timeout: payload.timeout ? payload.timeout : null
    }
    commit(types.SET, data)
    return id
  },
  error ({ commit, rootState }, payload) {
    const id = new Date().getTime()
    const data = {
      id: id,
      message: payload.message,
      type: 'error',
      code: payload.status,
      timeout: payload.timeout ? payload.timeout : null
    }
    commit(types.SET, data)
    return id
  },
  delete ({ commit, rootState }, payload) {
    commit(types.DELETE, payload)
  },
  flush ({ commit, rootState }) {
    commit(types.FLUSH)
  }
}
