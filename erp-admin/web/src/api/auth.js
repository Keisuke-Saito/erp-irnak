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
        .catch(() => resolve())
    })
  }
}
