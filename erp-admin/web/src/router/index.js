import Vue from 'vue'
import Router from 'vue-router'
import routes from './routes'
import { authorizeToken } from './guards'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  routes
})
router.beforeEach(authorizeToken)

export default router
