<template>
  <button
    :class="classes"
    :disabled="disabled"
    type="button"
    @click="csvDownload"
  >
    {{ name }}
  </button>
</template>

<script>

export default {
  name: 'ErpCsvDownload',
  props: {
    type: { type: String, default: 'normal' },
    disabled: { type: Boolean, default: false },
    download: { type: Function, required: true },
    name: { type: String, default: 'csvダウンロード' },
    message: { type: String, default: 'csvダウンロード中...' }
  },
  computed: {
    classes () {
      const cls = this.type
      return [`erp-button-${cls}`]
    }
  },
  methods: {
    csvDownload () {
      const messageId = this.messageInfo({ message: this.message })
      this.download()
        .then(res => {
          this.downloadCsvBlob(res.data, this.getFileName(res.headers['content-disposition']))
          this.messageDelete(messageId)
        })
        .catch(err => this.resultMessage({ id: messageId, error: this.throwError(err) }))
    },
    getFileName (contentDisposition) {
      const filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/
      const matches = filenameRegex.exec(contentDisposition)
      if (matches != null && matches[1]) {
        const fileName = matches[1].replace(/['"]/g, '')
        return decodeURI(fileName)
      } else {
        return null
      }
    },
    downloadCsvBlob (blob, fileName) {
      if (window.navigator.msSaveOrOpenBlob) {
        // for IE,Edge
        window.navigator.msSaveOrOpenBlob(blob, fileName)
      } else {
        // for chrome, firefox
        const url = URL.createObjectURL(new Blob([blob], { type: 'text/csv' }))
        const link = document.createElement('a')
        link.href = url
        link.setAttribute('download', fileName)
        document.body.appendChild(link)
        link.click()
        URL.revokeObjectURL(url)
        link.parentNode.removeChild(link)
      }
    }
  }
}
</script>

<style scoped lang="scss">
.erp-button-normal:hover {
  cursor: pointer;
}
</style>
