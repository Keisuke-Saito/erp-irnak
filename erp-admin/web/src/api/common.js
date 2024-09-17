import client from './client'

export default {
  fetchMst: payload => {
    return new Promise((resolve, reject) => {
      client({
        method: 'get',
        url: '/api/common/mst',
        headers: {
          Acceptn: 'application/json',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(res => resolve({ data: res.data }))
        .catch(err => reject(err))
      })
    }
}
