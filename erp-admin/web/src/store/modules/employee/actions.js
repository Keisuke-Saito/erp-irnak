import * as types from './mutation-types'
import { Employee } from '../../../api'

export default {
  async fetchEmployeeList ({ commit, rootState }) {
    const data = { token: rootState.auth.token }
    const detail = await Employee.fetchEmployeeList(data).catch(err => { throw err.response })
    commit(types.FETCH_EMPLOYEE_LIST, detail.data)
  },

  async fetchProfileHistory ({ commit, rootState }, payload) {
    const data = { erpId: payload.erpId, token: rootState.auth.token }
    const detail = await Employee.fetchProfileHistory(data).catch(err => { throw err.response })
    commit(types.FETCH_PROFILE_HISTORY, detail.data)
  },

  async fetchProfileDetail ({ commit, rootState }, payload) {
    const data = { uuid: payload.uuid, token: rootState.auth.token }
    const detail = await Employee.fetchProfileDetail(data).catch(err => { throw err.response })
    commit(types.FETCH_PROFILE_DETAIL, detail.data)
  },

  async storeEmployee ({ commit, rootState }, payload) {
    const data = { formdata: payload.formdata, token: rootState.auth.token }
    const detail = await Employee.store(data).catch(err => { throw err.response })
    commit(types.CREATE_EMPLOYEE, detail.data)
  },

  async updateEmployee ({ commit, rootState }, payload) {
    const data = { formdata: payload.formdata, token: rootState.auth.token }
    await Employee.update(data).catch(err => { throw err.response })
  },

  async deleteEmployee ({ commit, rootState }, payload) {
    const data = { erpId: payload.erpId, token: rootState.auth.token }
    await Employee.delete(data).catch(err => { throw err.response })
    commit(types.DELETE_EMPLOYEE)
  }
}
