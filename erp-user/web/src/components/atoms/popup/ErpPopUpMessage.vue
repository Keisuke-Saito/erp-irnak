<template>
  <div :class="classes">
    <div v-if="code === 401">
      {{ message }}
      <br />
      ログアウトします
      <span
        class="delete"
        @click="logout"
      >
        ok
      </span>
    </div>
    <div v-else>
      {{ message }}
      <span
        class="delete"
        @click="deleteItem"
      >
        x
      </span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ErpPopUpMessage',
  props: {
    id: { type: Number, default: null },
    type: { type: String, default: 'info' },
    code: { type: Number, default: 200 },
    message: { type: String, required: true },
    timeout: { type: Number, default: null }
  },
  computed: {
    classes () {
      const cls = '-' + this.type
      return [`erp-message${cls}`, 'message']
    }
  },
  created () {
    if (this.timeout !== null) this.setTimeoutMessage()
  },
  methods: {
    setTimeoutMessage () {
      setTimeout(this.deleteItem, this.timeout)
    },
    deleteItem () {
      this.$store.dispatch('message/delete', this.id)
    },
    logout () {
      this.$store.dispatch('message/flush')
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped lang="scss">
.message {
  position: relative;
  line-height: 1.5;
  color: #fff;
  width: 100%;
  min-height: 20px;
  padding: 5px 20px;
  border-radius: 5px;
  box-sizing: border-box;
}
.delete {
  position: absolute;
  color: #333;
  width: 10px;
  top: 50%;
  right: 5px;
  transform: translateY(-50%);
}
.delete:hover {
  cursor: pointer;
}
.erp-message-info {
  color: blue;
  background-color: #fff;
  border: 1px solid blue;
}
.erp-message-success {
  background-color: green;
}
.erp-message-warning {
  color: #333;
  background-color: yellow;
}
.erp-message-error {
  background-color: red;
}
</style>
