import * as types from './mutation-types'

export default {
  [types.FETCH_FARE] (state, payload) {
    state.data.detailList.fare = payload.fare
    state.data.detailList.list = payload.list
  },
  [types.CONFIRM_FARE] (state, payload) {
    if (state.data.detailList.fare.uuid === payload.uuid) state.data.detailList.fare.confirmStatus = payload.status
  },
  // [types.UPDATE_FARE] (state, payload) {
  //   let details = state.data.details
  //   const index = details.findIndex((v) => v.uuid === Number(payload.uuid))
  //   details.splice(index, 1, payload)
  // },
  [types.DELETE_FARE] (state, payload) {
    const details = state.data.detailList.list
    const index = details.findIndex((v) => v.uuid === payload)
    details.splice(index, 1)
  }
}
