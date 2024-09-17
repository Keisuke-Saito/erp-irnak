import Vue from 'vue'
import Vuex from 'vuex'
import actions from './actions'
import getters from './getters'
import mutations from './mutations'

Vue.use(Vuex)

const state = {
  data: []
}

const message = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}

export default message
