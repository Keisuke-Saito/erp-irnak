<template>
  <form novalidate>
    <ErpValidationInputText
      v-model="username"
      :option="usernameRule"
      class-name="login"
      placeholder="スタッフコード"
    />
    <ErpValidationInputText
      v-model="password"
      :option="passwordRule"
      class-name="login"
      input-type="password"
      placeholder="パスワード"
    />
    <div class="form-actions">
      <ErpButton
        :disabled="disableLoginAction"
        type="login"
        @click="handleClick"
      >
        ログイン
      </ErpButton>
      <ErpP
        class-name="login"
        :boolean="progress"
      >
        ログイン中...
      </ErpP>
      <ErpP class-name="login">
        {{ error }}
      </ErpP>
    </div>
  </form>
</template>

<script>
import ErpButton from '@/components/atoms/button/ErpButton.vue'
import ErpP from '@/components/atoms/p/ErpP.vue'
import ErpValidationInputText from '@/components/molecules/form/ErpValidationInputText.vue'

const required = val => !!val.trim()

export default {
  name: 'ErpLoginForm',
  components: {
    ErpButton,
    ErpP,
    ErpValidationInputText
  },
  props: {
    onlogin: { type: Function, required: true }
  },
  data () {
    return {
      username: '',
      password: '',
      progress: false,
      error: ''
    }
  },
  computed: {
    usernameRule () {
      return [{ key: !this.validation.username.required, value: 'スタッフコードが入力されていません' }]
    },
    passwordRule () {
      return [{ key: !this.validation.password.required, value: 'パスワードが入力されていません' }]
    },
    validation () {
      return {
        username: { required: required(this.username) },
        password: { required: required(this.password) }
      }
    },
    valid () {
      const validation = this.validation
      const fields = Object.keys(validation)
      let valid = true
      for (let i = 0; i < fields.length; i++) {
        const field = fields[i]
        valid = Object.keys(validation[field])
          .every(key => validation[field][key])
        if (!valid) { break }
      }
      return valid
    },
    disableLoginAction () { return !this.valid || this.progress }
  },
  methods: {
    handleClick (ev) {
      if (this.disableLoginAction) { return }

      this.progress = true
      this.error = ''

      this.$nextTick(() => {
        this.onlogin({
          username: this.username,
          password: this.password
        })
          .catch(err => {
            const error = this.throwError(err)
            if (err.status === 401 || err.status === 422) {
              this.error = err.data.message ? err.data.message : error.detail.message
            } else {
              this.error = error.detail.message
            }
          })
          .then(() => { this.progress = false })
      })
    }
  }
}
</script>

<style scoped lang="scss">
</style>
