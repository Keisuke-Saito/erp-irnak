import Vue from 'vue'
import Vuex from 'vuex'
import auth from './modules/auth'
import common from './modules/common'
import fare from './modules/fare'
import message from './modules/message'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    common,
    fare,
    message
  },
  strict: process.env.NODE_ENV !== 'production'
})

export default store
