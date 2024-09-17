import Vue from 'vue'
import Vuex from 'vuex'
import actions from './actions'
import getters from './getters'
import mutations from './mutations'

Vue.use(Vuex)

const state = {
  data: {
    detailList: {
      fare: [],
      list: []
    }
  }
}

const fare = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}

export default fare
