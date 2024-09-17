import * as types from './mutation-types'
import { Fare } from '@/api'

export default {
  async fetchImg ({ commit, rootState }, payload) {
    const data = { filePath: payload.filePath, token: rootState.auth.token }
    const detail = await Fare.fetchImg(data).catch(err => { throw err.response })
    return detail
  },
  async fetchFareHistory ({ commit, rootState }, payload) {
    const data = { target: payload.target, token: rootState.auth.token }
    const detail = await Fare.fetchFareHistory(data).catch(err => { throw err.response })
    commit(types.FETCH_FARE, detail.detail)
  },
  async confirm ({ commit, rootState }, payload) {
    const data = { uuid: payload.uuid, token: rootState.auth.token }
    await Fare.confirm(data).catch(err => { throw err.response })
    commit(types.CONFIRM_FARE, payload)
  },
  async store ({ commit, rootState }, payload) {
    const data = { detail: payload.detail, targetMonth: payload.targetMonth, token: rootState.auth.token }
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
  }
}
