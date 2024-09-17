import * as types from './mutation-types'

export default {
  [types.FETCH_FARE_LIST] (state, payload) {
    state.data.allList = payload
  },
  [types.FETCH_DETAIL_LIST] (state, payload) {
    state.data.detailList.uuid = payload.uuid
    state.data.detailList.erpId = payload.erpId
    state.data.detailList.name = payload.name
    state.data.detailList.kana = payload.kana
    state.data.detailList.nearestStation = payload.nearestStation
    state.data.detailList.belongId = payload.belongId
    state.data.detailList.retirementAt = payload.retirementAt
    state.data.detailList.targetMonth = payload.targetMonth
    state.data.detailList.confirmStatus = payload.confirmStatus
    state.data.detailList.details = payload.details
  },
  scopeCheck (state, payload) {
    state.csv.scope.indexOf(payload.target) >= 0
      ? state.csv.scope = state.csv.scope.filter(n => n !== payload.target)
      : state.csv.scope.push(payload.target)
  },
  allCheck (state, payload) {
    state.csv.all = !state.csv.all
    state.csv.belong = []
    state.csv.confirmStatus = []
  },
  belongCheck (state, payload) {
    state.csv.all = false
    state.csv.belong.indexOf(payload.target) >= 0
      ? state.csv.belong = state.csv.belong.filter(n => n !== payload.target)
      : state.csv.belong.push(payload.target)
  },
  confirmStatusCheck (state, payload) {
    state.csv.all = false
    if (state.csv.confirmStatus.indexOf(payload.target) >= 0) {
      state.csv.confirmStatus = state.csv.confirmStatus.filter(n => n !== payload.target)
    } else {
      state.csv.confirmStatus.push(payload.target)
    }
  },
  [types.DELETE_FARE] (state, payload) {
    const details = state.data.detailList.details
    const index = details.findIndex((v) => v.uuid === payload)
    details.splice(index, 1)
  },
  [types.CHANGE_STATUS] (state, payload) {
    state.data.detailList.confirmStatus = payload
  }
}
