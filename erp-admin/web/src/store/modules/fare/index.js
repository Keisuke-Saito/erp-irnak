import Vue from 'vue'
import Vuex from 'vuex'
import actions from './actions'
import getters from './getters'
import mutations from './mutations'

Vue.use(Vuex)

const state = {
  data: {
    allList: {
      targetMonth: '',
      list: []
    },
    detailList: {
      uuid: '',
      erpId: '',
      name: '',
      kana: '',
      nearestStation: '',
      belongId: '',
      retirementAt: null,
      targetMonth: '',
      confirmStatus: null,
      details: []
    }
  },
  csv: {
    scope: [],
    belong: [],
    confirmStatus: [],
    all: true
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
