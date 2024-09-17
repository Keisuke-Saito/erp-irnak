import * as types from './mutation-types'

export default {
  [types.FETCH_MST] (state, payload) {
    state.mst.commonMst = payload
  }
}
