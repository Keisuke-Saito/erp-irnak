export default {
  methods: {
    async fetchImageData (payload) {
      if (payload.filePath !== '') {
        const res = await this.$store.dispatch(payload.type, { filePath: payload.filePath })
        if (res.detail.status === 200) {
          const blob = new Blob([res.detail.data], { type: res.detail.headers[0] })
          const url = window.URL || window.webkitURL
          return Promise.resolve({ data: url.createObjectURL(blob) })
        }
      } else {
        return Promise.resolve({ data: '' })
      }
    }
  }
}
