import Vue from 'vue'
import Vuex from 'vuex'
import actions from './actions'
import getters from './getters'
import mutations from './mutations'

Vue.use(Vuex)

const state = {
  mst: {
    commonMst: []
  }
}

const common = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}

export default common
