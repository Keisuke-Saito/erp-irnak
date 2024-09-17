import axios from 'axios'
import store from '../store'

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

const csrf = document.head.querySelector('meta[name="csrf-token"]')

if (csrf) {
  axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf.content
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}

axios.interceptors.response.use((response) => {
  return response
}, (error) => {
  if (error.response.status === 401) {
    // 認証失敗時はトークン削除する
    sessionStorage.removeItem('token')
    store.state.auth.token = null
  }
  return Promise.reject(error)
})

export default axios
