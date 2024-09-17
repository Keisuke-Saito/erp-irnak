import Vue from 'vue'
import Vuex from 'vuex'
import actions from './actions'
import getters from './getters'
import mutations from './mutations'

Vue.use(Vuex)

const state = {
  search: {
    belong: [],
    retirement: ['false'],
    loginDiv: [],
    all: false
  },
  sort: {
    target: 'kana',
    orderBy: 'asc'
  },
  data: {
    allList: [],
    profileHistory: [],
    profileDetail: {}
  }
}

const employee = {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
}

export default employee
