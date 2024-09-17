import Vue from 'vue'
import consts from './const'

const NUKNOWN_VALUE = '不明'

/** ------common------------------------------------------------------------------------- */

/**
 * 都道府県
 */
Vue.filter('prefectural', (value) => {
  if (value in consts.common.PREFECTURAL) {
    return consts.common.PREFECTURAL[value]
  }
  return NUKNOWN_VALUE
})
/**
 * 金額などの数列の３桁ごとに”,”を表示する。
 */
Vue.filter('numberWithDelimiter', (value) => {
  if (value) {
    return value.toString().replace(/(\d)(?=(\d{3})+$)/g, '$1,')
  }
  return '0'
})
/**
 * ありorなし
 */
Vue.filter('ariNashi', (value) => {
  if (value in consts.common.ARI_NASHI) {
    return consts.common.ARI_NASHI[value]
  }
  return NUKNOWN_VALUE
})
/**
 * 不明
 */
Vue.filter('unknown', (value) => {
  return value === null ? '不明' : value
})
/**
 * 特になし
 */
Vue.filter('blank', (value) => {
  return value === null ? '特になし' : value
})

/** ------fare------------------------------------------------------------------------- */

/**
 * 経路
 */
Vue.filter('routeDiv', (value) => {
  const routeDiv = consts.trafic.ROUTE_VALUE
  // eslint-disable-next-line no-unused-vars
  for (const item in routeDiv) {
    if (value === routeDiv[item].value) {
      return routeDiv[item].label
    }
  }
  return NUKNOWN_VALUE
})
/**
/**
 * 交通手段
 */
Vue.filter('transportation', (value) => {
  if (value in consts.trafic.TRANSPORTATION) {
    return consts.trafic.TRANSPORTATION[value]
  }
  return NUKNOWN_VALUE
})

/** ------profile------------------------------------------------------------------------- */

/**
 * 性別
 */
Vue.filter('gender', (value) => {
  if (value in consts.profile.GENDER) {
    return consts.profile.GENDER[value]
  }
  return NUKNOWN_VALUE
})
/**
 * 既婚or未婚
 */
Vue.filter('spouse', (value) => {
  if (value in consts.profile.SPOUSE) {
    return consts.profile.SPOUSE[value]
  }
  return NUKNOWN_VALUE
})
/**
 * 最終学歴
 */
Vue.filter('enducationalBackground', (value) => {
  if (value in consts.profile.ENDUCATIONAL_BACKGROUND) {
    return consts.profile.ENDUCATIONAL_BACKGROUND[value]
  }
  return NUKNOWN_VALUE
})
/**
 * 採用区分
 */
Vue.filter('recruitmentClassification', (value) => {
  if (value in consts.profile.RECRUITMENT_CLASSIFICATION) {
    return consts.profile.RECRUITMENT_CLASSIFICATION[value]
  }
  return NUKNOWN_VALUE
})
/**
 * 在籍区分
 */
Vue.filter('classificationOfAttendance', (value) => {
  let status = 0
  if (value.joinedAt !== null) status = 1
  if (value.retirementAt !== null) status = 3
  if (status in consts.profile.CLASSIFICATION_OF_ATTENDANCE) {
    return consts.profile.CLASSIFICATION_OF_ATTENDANCE[status]
  }
  return NUKNOWN_VALUE
})
/**
 * ログイン制御
 */
Vue.filter('loginDiv', (value) => {
  if (value in consts.profile.LOGIN_DIV_LIST) {
    return consts.profile.LOGIN_DIV_LIST[value]
  }
  return NUKNOWN_VALUE
})
