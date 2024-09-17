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
  fetchFareHistory: payload => {
    return new Promise((resolve, reject) => {
      client({
        method: 'get',
        url: '/api/fare/show/hisotry',
        params: {
          target: payload.target
        },
        headers: {
          Acceptn: 'application/json',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(res => resolve({ detail: res.data }))
        .catch(err => reject(err))
    })
  },
  confirm: payload => {
    return new Promise((resolve, reject) => {
      client({
        method: 'patch',
        url: '/api/fare/confirm',
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
  store: payload => {
    const formData = new FormData()
    for (let i = 0; i < payload.detail.length; i++) {
      const detail = payload.detail[i]
      formData.append('detail[' + i + '][targetDate]', detail.targetDate)
      formData.append('detail[' + i + '][destination]', detail.destination)
      formData.append('detail[' + i + '][pointOfDeparture]', detail.pointOfDeparture)
      formData.append('detail[' + i + '][arrival]', detail.arrival)
      formData.append('detail[' + i + '][routeDiv]', detail.routeDiv)
      formData.append('detail[' + i + '][transportation]', detail.transportation)
      formData.append('detail[' + i + '][amountOfMoney]', detail.amountOfMoney)
      formData.append('detail[' + i + '][remarks]', detail.remarks === null ? '' : detail.remarks)
      formData.append('detail[' + i + '][receipt]', detail.receipt === null ? '' : detail.receipt)
    }
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
    formData.append('remarks', payload.detail.remarks === null ? '' : payload.detail.remarks)
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
  }
}
