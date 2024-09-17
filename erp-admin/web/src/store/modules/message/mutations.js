import * as types from './mutation-types'

export default {
  [types.SET] (state, payload) {
    let data = state.data
    const count = data.length
    if (count > 4) {
      data.shift()
    }
    data.push(payload)
  },
  [types.DELETE] (state, payload) {
    let data = state.data
    const index = data.findIndex((v) => v.id === payload)
    data.splice(index, 1)
  },
  [types.FLUSH] (state) {
    state.data = []
  }
}
