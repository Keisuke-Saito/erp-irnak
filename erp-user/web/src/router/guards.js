import store from '../store'

export const authorizeToken = (to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!store.state.auth || !store.state.auth.token) {
      // 強制ログアウト、ポップアップメッセージ削除
      store.state.message.data = []
      next({ name: 'login' })
    } else {
      next()
    }
  } else if (to.path === '/login' && store.state.auth.token) {
    next({ name: 'top' })
  } else {
    next()
  }
}
