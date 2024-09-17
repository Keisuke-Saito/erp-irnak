export default {
  getFareList (state) {
    return {
      count: state.data.allList.targetTotal,
      year: state.data.allList.targetYear,
      month: state.data.allList.targetMonth,
      list: state.data.allList.list
    }
  },
  getDetailList (state) {
    return {
      uuid: state.data.detailList.uuid,
      erpId: state.data.detailList.erpId,
      name: state.data.detailList.name,
      kana: state.data.detailList.kana,
      nearestStation: state.data.detailList.nearestStation,
      belongId: state.data.detailList.belongId,
      retirementAt: state.data.detailList.retirementAt,
      targetMonth: state.data.detailList.targetMonth,
      confirmStatus: state.data.detailList.confirmStatus,
      details: state.data.detailList.details
    }
  },
  getCsvTarget (state) {
    const list = []
    // eslint-disable-next-line no-unused-vars
    for (const i in state.data.allList.list) {
      const target = state.data.allList.list[i]
      if (state.csv.all) {
        list.push(target.erpId)
      } else {
        const scope = state.csv.scope.indexOf(target.erpId) >= 0
        const check = state.csv.belong.length > 0 || state.csv.confirmStatus.length > 0
        const belong = (state.csv.belong.indexOf(target.belongId) >= 0 && state.csv.belong.length > 0) || state.csv.belong.length === 0
        const confirmStatus = (state.csv.confirmStatus.indexOf(target.confirmStatus) >= 0 && state.csv.confirmStatus.length > 0) || state.csv.confirmStatus.length === 0
        if (scope || (check && belong && confirmStatus)) list.push(target.erpId)
      }
    }
    return list
  }
}
