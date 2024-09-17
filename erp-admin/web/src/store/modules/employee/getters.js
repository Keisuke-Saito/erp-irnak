export default {
  getEmployeeList (state) {
    const list = []
    // eslint-disable-next-line no-unused-vars
    for (const i in state.data.allList) {
      const target = state.data.allList[i]
      if (state.search.all) {
        list.push(target)
      } else {
        const check = state.search.belong.length > 0 || state.search.retirement.length > 0 || state.search.loginDiv.length > 0
        const belong = (state.search.belong.indexOf(target.belongId) >= 0 && state.search.belong.length > 0) || state.search.belong.length === 0
        const retirementAt = target.retirementAt != null
        const retirement = (state.search.retirement.indexOf(retirementAt.toString()) >= 0 && state.search.retirement.length > 0) || state.search.retirement.length === 0
        const loginDivString = target.loginDiv === null ? 'null' : target.loginDiv.toString()
        const loginDiv = (state.search.loginDiv.indexOf(loginDivString) >= 0 && state.search.loginDiv.length > 0) || state.search.loginDiv.length === 0
        if ((check && belong && retirement && loginDiv)) list.push(target)
      }
    }
    list.sort((a, b) => a[state.sort.target] < b[state.sort.target] ? -1 : 1)
    if (state.sort.orderBy === 'desc') list.reverse()
    return list
  },
  getProfileDetail (state) { return state.data.profileDetail },
  getProfileHistory (state) { return state.data.profileHistory }
}
