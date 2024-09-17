import client from './client'

export default {
  fetchImg: payload => {
    return new Promise((resolve, reject) => {
      client({
        method: 'get',
        url: '/api/fare/img',
        responseType: 'arraybuffer',
        dataType: 'binary',
        params: {
          filePath: payload.filePath
        },
        headers: {
          Acceptn: 'application/json',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(res => resolve({ detail: res }))
        .catch(err => reject(err))
    })
  },
  fetchFareList: payload => {
    return new Promise((resolve, reject) => {
      client({
        method: 'get',
        url: '/api/fare/fetch/all',
        params: {
          target: payload.target
        },
        headers: {
          Acceptn: 'application/json',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(res => resolve({ data: res.data }))
        .catch(err => reject(err))
    })
  },
  fetchDetailByUser: payload => {
    return new Promise((resolve, reject) => {
      client({
        method: 'get',
        url: '/api/fare/fetch/detail',
        params: {
          erpId: payload.erpId,
          target: payload.target
        },
        headers: {
          Acceptn: 'application/json',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(res => resolve({ data: res.data }))
        .catch(err => reject(err))
    })
  },
  download: payload => {
    return new Promise((resolve, reject) => {
      client({
        method: 'get',
        url: '/api/fare/download',
        responseType: 'blob',
        params: {
          targetMonth: payload.targetMonth,
          targetErpIdList: payload.targetErpIdList
        },
        headers: {
          Acceptn: 'application/json',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(res => resolve({ data: res.data, headers: res.headers }))
        .catch(err => reject(err))
    })
  },
  store: payload => {
    const formData = new FormData()
    formData.append('targetDate', payload.detail.targetDate)
    formData.append('destination', payload.detail.destination)
    formData.append('pointOfDeparture', payload.detail.pointOfDeparture)
    formData.append('arrival', payload.detail.arrival)
    formData.append('routeDiv', payload.detail.routeDiv)
    formData.append('transportation', payload.detail.transportation)
    formData.append('amountOfMoney', payload.detail.amountOfMoney)
    formData.append('adminRemarks', payload.detail.adminRemarks === null ? '' : payload.detail.adminRemarks)
    formData.append('receipt', payload.detail.receipt === null ? '' : payload.detail.receipt)
    formData.append('erpId', payload.erpId)
    formData.append('targetMonth', payload.targetMonth)
    return new Promise((resolve, reject) => {
      client.post('/api/fare/store', formData, {
        headers: {
          'content-type': 'multipart/form-data',
          Acceptn: 'multipart/form-data',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(() => resolve())
        .catch(err => reject(err))
    })
  },
  update: payload => {
    const formData = new FormData()
    formData.append('uuid', payload.detail.uuid)
    formData.append('fareId', payload.detail.fareId)
    formData.append('targetDate', payload.detail.targetDate)
    formData.append('destination', payload.detail.destination)
    formData.append('pointOfDeparture', payload.detail.pointOfDeparture)
    formData.append('arrival', payload.detail.arrival)
    formData.append('routeDiv', payload.detail.routeDiv)
    formData.append('transportation', payload.detail.transportation)
    formData.append('amountOfMoney', payload.detail.amountOfMoney)
    formData.append('imgObj', payload.detail.imgObj)
    formData.append('adminRemarks', payload.detail.adminRemarks === null ? '' : payload.detail.adminRemarks)
    formData.append('receipt', payload.detail.receipt === null ? '' : payload.detail.receipt)
    return new Promise((resolve, reject) => {
      client.post('/api/fare/update', formData, {
        headers: {
          Acceptn: 'multipart/form-data',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(() => resolve())
        .catch(err => reject(err))
    })
  },
  delete: payload => {
    return new Promise((resolve, reject) => {
      client({
        method: 'delete',
        url: '/api/fare/delete',
        params: {
          uuid: payload.uuid
        },
        headers: {
          Acceptn: 'application/json',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(() => resolve())
        .catch(err => reject(err))
    })
  },
  changeStatus: payload => {
    const formData = new FormData()
    formData.append('uuid', payload.uuid)
    formData.append('status', payload.status)
    return new Promise((resolve, reject) => {
      client.post('/api/fare/changeStatus', formData, {
        headers: {
          Acceptn: 'multipart/form-data',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(() => resolve())
        .catch(err => reject(err))
    })
  }
}
