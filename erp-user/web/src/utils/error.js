export default {
  methods: {
    throwError (err) {
      if (this.$consts.common.STATUS_CODE.hasOwnProperty(err.status)) {
        return { detail: this.$consts.common.STATUS_CODE[err.status], err: err.data.errors, status: err.status }
      }
      return { detail: this.$consts.common.STATUS_CODE[500], err: '', status: 500 }
    },
    throwReject (err) { return Promise.reject(err) }
  }
}
