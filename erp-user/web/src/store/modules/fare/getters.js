export default {
  getDetailList (state) {
    return {
      fare: state.data.detailList.fare,
      list: state.data.detailList.list
    }
  }
}
