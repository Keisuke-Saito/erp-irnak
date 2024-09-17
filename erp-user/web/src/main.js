import Vue from 'vue'
import 'es6-promise/auto'
import App from './App'
import consts from './const'
import router from './router'
import store from './store'
import './filter'
import image from './utils/image'
import date from './utils/date'
import error from './utils/error'
import message from './utils/message'

// グローバルメソッドのグローバルミックスイン
Vue.mixin(image)
Vue.mixin(date)
Vue.mixin(error)
Vue.mixin(message)

Vue.config.productionTip = false
Vue.config.performance = true // NODE_ENV == 'development'で測定有効化

Vue.config.errorHandler = (err, vm, info) => {
  console.error('errorHandler err:', err)
  console.error('errorHandler vm:', vm)
  console.error('errorHandler info:', info)
}
window.addEventListener('error', event => {
  console.log('Captured in error EventListener', event.error)
})
window.addEventListener('unhandledrejection', event => {
  console.log('Captured in unhandledrejection EventListener', event.reason)
})

Vue.prototype.$consts = consts

const app = new Vue({
  el: '#app',
  consts,
  router,
  store,
  render: h => h(App)
})

app.$mount('#app')
