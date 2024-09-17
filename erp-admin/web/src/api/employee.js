import client from './client'

export default {
  fetchEmployeeList: payload => {
    return new Promise((resolve, reject) => {
      client({
        method: 'get',
        url: '/api/employee/fetch/all',
        headers: {
          Acceptn: 'application/json',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(res => resolve({ data: res.data }))
        .catch(err => reject(err))
    })
  },
  fetchProfileHistory: payload => {
    return new Promise((resolve, reject) => {
      client({
        method: 'get',
        url: '/api/employee/fetch/profile/history',
        params: {
          erpId: payload.erpId
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
  fetchProfileDetail: payload => {
    return new Promise((resolve, reject) => {
      client({
        method: 'get',
        url: '/api/employee/fetch/profile/detail',
        params: {
          uuid: payload.uuid
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
  store: payload => {
    return new Promise((resolve, reject) => {
      const birthday = payload.formdata.birthYear + '-' + payload.formdata.birthMonth + '-' + payload.formdata.birthDay
      const joinedAt = payload.formdata.joinedYear + '-' + payload.formdata.joinedMonth + '-' + payload.formdata.joinedDay
      const formData = new FormData()
      formData.append('lastname', payload.formdata.lastname)
      formData.append('firstname', payload.formdata.firstname)
      formData.append('lastnameKana', payload.formdata.lastnameKana)
      formData.append('firstnameKana', payload.formdata.firstnameKana)
      formData.append('birthday', birthday)
      formData.append('gender', payload.formdata.gender)
      formData.append('birthplace', payload.formdata.birthplace)
      formData.append('spouse', payload.formdata.spouse)
      formData.append('postalCode', payload.formdata.postalCode)
      formData.append('prefectural', payload.formdata.prefectural)
      formData.append('address', payload.formdata.address)
      formData.append('nearestStation', payload.formdata.nearestStation)
      formData.append('enducationalBackground', payload.formdata.enducationalBackground)
      formData.append('email', payload.formdata.email)
      formData.append('contactNumber', payload.formdata.contactNumber)
      formData.append('emergencyContactNumber', payload.formdata.emergencyContactNumber)
      formData.append('recruitmentClassification', payload.formdata.recruitmentClassification)
      formData.append('belongId', payload.formdata.belongId)
      formData.append('affiliationDeptId', payload.formdata.affiliationDeptId)
      formData.append('positionId', payload.formdata.positionId)
      formData.append('employeeDivId', payload.formdata.employeeDivId)
      formData.append('businessDivId', payload.formdata.businessDivId)
      formData.append('businessContent', payload.formdata.businessContent)
      formData.append('joinedAt', joinedAt)
      formData.append('operationDestination', payload.formdata.operationDestination)
      formData.append('operationDestinationName', payload.formdata.operationDestinationName)
      formData.append('possessionQualification', JSON.stringify(payload.formdata.possessionQualification))
      formData.append('note', payload.formdata.note)

      client.post('/api/employee/store/member', formData, {
        headers: {
          Acceptn: 'application/json',
          Authorization: 'Bearer ' + payload.token
        }
      })
        .then(res => resolve({ detail: res.data }))
        .catch(err => reject(err))
    })
  },
  update: payload => {
    return new Promise((resolve, reject) => {
      const birthday = payload.formdata.birthYear + '-' + payload.formdata.birthMonth + '-' + payload.formdata.birthDay
      const joinedAt = payload.formdata.joinedYear + '-' + payload.formdata.joinedMonth + '-' + payload.formdata.joinedDay
      const retirementAt = payload.formdata.retirementYear + '-' + payload.formdata.retirementMonth + '-' + payload.formdata.retirementDay
      const formData = new FormData()
      formData.append('uuid', payload.formdata.uuid)
      formData.append('erpId', payload.formdata.erpId)
      formData.append('lastname', payload.formdata.lastname)
      formData.append('firstname', payload.formdata.firstname)
      formData.append('lastnameKana', payload.formdata.lastnameKana)
      formData.append('firstnameKana', payload.formdata.firstnameKana)
      formData.append('birthday', birthday)
      formData.append('gender', payload.formdata.gender)
      formData.append('birthplace', payload.formdata.birthplace)
      formData.append('spouse', payload.formdata.spouse)
      formData.append('postalCode', payload.formdata.postalCode)
      formData.append('prefectural', payload.formdata.prefectural)
      formData.append('address', payload.formdata.address)
      formData.append('nearestStation', payload.formdata.nearestStation)
      formData.append('enducationalBackground', payload.formdata.enducationalBackground)
      formData.append('email', payload.formdata.email)
      formData.append('contactNumber', payload.formdata.contactNumber)
      formData.append('emergencyContactNumber', payload.formdata.emergencyContactNumber)
      formData.append('recruitmentClassification', payload.formdata.recruitmentClassification)
      formData.append('belongId', payload.formdata.belongId)
      formData.append('affiliationDeptId', payload.formdata.affiliationDeptId)
      formData.append('positionId', payload.formdata.positionId)
      formData.append('employeeDivId', payload.formdata.employeeDivId)
      formData.append('businessDivId', payload.formdata.businessDivId)
      formData.append('businessContent', payload.formdata.businessContent)
      formData.append('joinedAt', joinedAt)
      formData.append('retirementAt', (retirementAt === '--') ? '' : retirementAt)
      formData.append('operationDestination', payload.formdata.operationDestination)
      formData.append('operationDestinationName', payload.formdata.operationDestinationName)
      formData.append('possessionQualification', JSON.stringify(payload.formdata.possessionQualification))
      formData.append('note', payload.formdata.note)

      client.post('/api/employee/update/profile', formData, {
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
        url: '/api/employee/delete/user',
        params: {
          erpId: payload.erpId
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
