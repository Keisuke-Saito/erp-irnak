import * as types from './mutation-types'
import { Fare } from '../../../api'

export default {
  async fetchImg ({ commit, rootState }, payload) {
    const data = { filePath: payload.filePath, token: rootState.auth.token }
    const detail = await Fare.fetchImg(data).catch(err => { throw err.response })
    return detail
  },
  async fetchFareList ({ commit, rootState }, payload) {
    const data = { target: payload.target, token: rootState.auth.token }
    const detail = await Fare.fetchFareList(data).catch(err => { throw err.response })
    commit(types.FETCH_FARE_LIST, detail.data)
  },
  async fetchDetailByUser ({ commit, rootState }, payload) {
    const data = { erpId: payload.erpId, target: payload.target, token: rootState.auth.token }
    const detail = await Fare.fetchDetailByUser(data).catch(err => { throw err.response })
    commit(types.FETCH_DETAIL_LIST, detail.data)
  },
  async download ({ commit, rootState }, payload) {
    const data = { targetMonth: payload.targetMonth, targetErpIdList: payload.targetErpIdList, token: rootState.auth.token }
    const result = await Fare.download(data).catch(err => { throw err.response })
    return result
  },
  async store ({ commit, rootState }, payload) {
    const data = { detail: payload.detail, targetMonth: payload.targetMonth, erpId: payload.erpId, token: rootState.auth.token }
    await Fare.store(data).catch(err => { throw err.response })
  },
  async update ({ commit, rootState }, payload) {
    const data = { detail: payload, token: rootState.auth.token }
    await Fare.update(data).catch(err => { throw err.response })
    // commit(types.UPDATE_FARE, payload.detail)
  },
  async delete ({ commit, rootState }, payload) {
    const data = { uuid: payload.uuid, token: rootState.auth.token }
    await Fare.delete(data).catch(err => { throw err.response })
    commit(types.DELETE_FARE, payload.uuid)
  },
  async changeStatus ({ commit, rootState }, payload) {
    const data = { uuid: payload.uuid, status: payload.status, token: rootState.auth.token }
    await Fare.changeStatus(data).catch(err => { throw err.response })
    commit(types.CHANGE_STATUS, payload.status)
  }
}
