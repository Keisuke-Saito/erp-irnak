import ErpLoginView from '@/components/templates/Auth/ErpLoginView.vue'
import ErpCreateUserView from '@/components/templates/Auth/ErpCreateUserView.vue'
import ErpMainView from '@/components/templates/ErpMainView.vue'
import ErpTopView from '@/components/templates/Top/ErpTopView.vue'
import ErpProfileMainView from '@/components/templates/Profile/ErpProfileMainView.vue'
import ErpProfileView from '@/components/templates/Profile/ErpProfileView.vue'
import ErpFareMainView from '@/components/templates/Fare/ErpFareMainView.vue'
import ErpFareApplyView from '@/components/templates/Fare/ErpFareApplyView.vue'

export default [{
  path: '/',
  component: ErpMainView,
  meta: { requiresAuth: true },
  children: [{
    path: '',
    component: ErpTopView,
    name: 'top',
    meta: { requiresAuth: true }
  }, {
    path: '/profile',
    component: ErpProfileMainView,
    meta: { requiresAuth: true },
    children: [{
      path: '',
      component: ErpProfileView,
      name: 'profile',
      meta: { requiresAuth: true }
    }]
  }, {
    path: '/fare',
    component: ErpFareMainView,
    meta: { requiresAuth: true },
    children: [{
      path: '/fare/apply',
      component: ErpFareApplyView,
      name: 'applyFare',
      meta: { requiresAuth: true }
    }]
  }]
}, {
  path: '/login',
  name: 'login',
  component: ErpLoginView
}, {
  path: '/password/generate',
  name: 'createUser',
  component: ErpCreateUserView
}, {
  path: '*',
  redirect: '/'
}]
