import Vue from 'vue'
import Vuex from 'vuex'
import actions from './actions'
import getters from './getters'
import mutations from './mutations'

Vue.use(Vuex)

const state = {
  token: sessionStorage.getItem('token')
}

const auth = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}

export default auth
