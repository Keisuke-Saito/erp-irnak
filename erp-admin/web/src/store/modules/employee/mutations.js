import * as types from './mutation-types'

export default {
  [types.FETCH_EMPLOYEE_LIST] (state, payload) {
    state.data.allList = payload
  },
  [types.FETCH_PROFILE_HISTORY] (state, payload) {
    state.data.profileHistory = payload
  },
  [types.FETCH_PROFILE_DETAIL] (state, payload) {
    state.data.profileDetail = payload
  },
  [types.CREATE_EMPLOYEE] (state, payload) {
  },
  [types.DELETE_EMPLOYEE] (state, payload) {
    // eslint-disable-next-line no-unused-vars
    for (const i in state.data.profileHistory) {
      const target = state.data.profileHistory[i]
      target.loginDiv = false
    }
  },
  allCheck (state, payload) {
    state.search.all = !state.search.all
    state.search.belong = []
    state.search.retirement = []
    state.search.loginDiv = []
  },
  belongCheck (state, payload) {
    state.search.all = false
    state.search.belong.indexOf(payload.target) >= 0
      ? state.search.belong = state.search.belong.filter(n => n !== payload.target)
      : state.search.belong.push(payload.target)
  },
  retirementCheck (state, payload) {
    state.search.all = false
    state.search.retirement.indexOf(payload.target) >= 0
      ? state.search.retirement = state.search.retirement.filter(n => n !== payload.target)
      : state.search.retirement.push(payload.target)
  },
  loginDivCheck (state, payload) {
    state.search.all = false
    state.search.loginDiv.indexOf(payload.target) >= 0
      ? state.search.loginDiv = state.search.loginDiv.filter(n => n !== payload.target)
      : state.search.loginDiv.push(payload.target)
  },
  targetCheck (state, payload) {
    state.sort.target = payload.target
  },
  orderByCheck (state, payload) {
    state.sort.orderBy = payload.target
  }
}
