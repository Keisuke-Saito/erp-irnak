export default {
  methods: {
    messageInfo (payload) {
      return this.$store.dispatch('message/info', payload)
    },
    messageSuccess (payload) {
      return this.$store.dispatch('message/success', payload)
    },
    messageWarning (payload) {
      return this.$store.dispatch('message/warning', payload)
    },
    messageError (payload) {
      return this.$store.dispatch('message/error', payload)
    },
    messageDelete (payload) {
      this.$store.dispatch('message/delete', payload)
    },
    resultMessage (payload) {
      this.messageDelete(payload.id)
      if (payload.error) {
        switch (payload.error.detail.type) {
          case 'warning':
            this.messageWarning({ message: payload.error.detail.message, status: payload.error.status })
            break
          case 'error':
            this.messageError({ message: payload.error.detail.message, status: payload.error.status })
            break
        }
      } else if (payload.success) {
        this.messageSuccess(payload.success)
      } else if (payload.info) {
        this.messageInfo(payload.info)
      }
    }
  }
}
