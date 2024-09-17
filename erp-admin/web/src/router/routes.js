import ErpLoginView from '@/components/templates/ErpLoginView.vue'
import ErpMainView from '@/components/templates/ErpMainView.vue'
import ErpTopView from '@/components/templates/Top/ErpTopView.vue'
import ErpEmployeeMainView from '@/components/templates/employee/ErpEmployeeMainView.vue'
import ErpEmployeeView from '@/components/templates/employee/ErpEmployeeView.vue'
import ErpCreateEmployeeView from '@/components/templates/employee/ErpCreateEmployeeView.vue'
import ErpEmployeeProfileView from '@/components/templates/employee/ErpEmployeeProfileView.vue'
import ErpUpdateEmployeeView from '@/components/templates/employee/ErpUpdateEmployeeView.vue'
import ErpFareMainView from '@/components/templates/fare/ErpFareMainView.vue'
import ErpFareView from '@/components/templates/fare/ErpFareView.vue'
import ErpFareDetailView from '@/components/templates/fare/ErpFareDetailView.vue'

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
    path: '/employee',
    component: ErpEmployeeMainView,
    name: 'employeeMain',
    meta: { requiresAuth: true },
    children: [{
      path: '/employee/member',
      component: ErpEmployeeView,
      name: 'employee',
      meta: { requiresAuth: true }
    }, {
      path: '/employee/create',
      component: ErpCreateEmployeeView,
      name: 'createEmployee',
      meta: { requiresAuth: true }
    }, {
      path: '/employee/detail/:erpId',
      component: ErpEmployeeProfileView,
      name: 'employeeProfile',
      meta: { requiresAuth: true },
      props: true
    }, {
      path: '/employee/update/:uuid',
      component: ErpUpdateEmployeeView,
      name: 'updateEmployee',
      meta: { requiresAuth: true },
      props: true
    }]
  }, {
    path: '/fare',
    component: ErpFareMainView,
    name: 'fareMain',
    meta: { requiresAuth: true },
    children: [{
      path: '/fare/list',
      component: ErpFareView,
      name: 'fare',
      meta: { requiresAuth: true }
    }, {
      path: '/fare/detail/:uid',
      component: ErpFareDetailView,
      name: 'fareDetail',
      meta: { requiresAuth: true }
    }]
  }]
}, {
  path: '/login',
  component: ErpLoginView,
  name: 'login'
}, {
  path: '*',
  redirect: '/'
}]
