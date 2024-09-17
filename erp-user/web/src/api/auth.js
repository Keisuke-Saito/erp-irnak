import client from './client'

export default {
  login: authInfo => {
    return new Promise((resolve, reject) => {
      client.post('/api/auth/login', authInfo)
        .then(res => resolve({ token: res.data.token }))
        .catch(err => reject(err))
    })
  },
  logout: token => {
    return new Promise((resolve, reject) => {
      client.delete('/api/auth/logout', {
        headers: {
          Authorization: 'Bearer ' + token
        }
      })
        .then(() => resolve())
        .catch(err => reject(err))
    })
  },
  checkToken: token => {
    return new Promise((resolve, reject) => {
      client.post('/api/auth/check/token', { token: token })
        .then(res => resolve(res))
        .catch(err => reject(err))
    })
  },
  createUser: authInfo => {
    return new Promise((resolve, reject) => {
      client.post('/api/auth/create/user', authInfo)
        .then(res => resolve({ token: res.data.token }))
        .catch(err => reject(err))
    })
  },
  fetchProfile: state => {
    return new Promise((resolve, reject) => {
      client.get('/api/auth/profile', {
        headers: {
          Acceptn: 'application/json',
          Authorization: 'Bearer ' + state.token
        }
      })
        .then(res => resolve(res.data))
        .catch(err => reject(err))
    })
  }
}
