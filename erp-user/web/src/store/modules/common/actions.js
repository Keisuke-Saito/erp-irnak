import * as types from './mutation-types'
import { Common } from '../../../api'

export default {
  async fetchMst ({ commit, rootState }, payload) {
    const data = { token: rootState.auth.token }
    const detail = await Common.fetchMst(data).catch(err => { throw err.response })
    commit(types.FETCH_MST, detail.data)
  }
}
