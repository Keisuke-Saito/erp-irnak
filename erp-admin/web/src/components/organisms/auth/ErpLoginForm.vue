<template>
  <form novalidate>
    <ErpValidationInputText
      v-model="username"
      :option="usernameRule"
      class-type="login"
      placeholder="ユーザーID"
    />
    <ErpValidationInputText
      v-model="password"
      :option="passwordRule"
      class-type="login"
      input-type="password"
      placeholder="パスワード"
    />
    <div class="form-actions">
      <ErpButton
        type="login"
        :disabled="disableLoginAction"
        @click="handleClick"
      >
        ログイン
      </ErpButton>
      <ErpP
        :boolean="progress"
        class-name="login"
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
      return [
        {
          key: !this.validation.username.required,
          value: 'ユーザーIDが入力されていません。'
        }
      ]
    },
    passwordRule () {
      return [
        {
          key: !this.validation.password.required,
          value: 'パスワードが入力されていません。'
        }
      ]
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
            this.error = error.detail.message
          })
          .then(() => { this.progress = false })
      })
    }
  }
}
</script>

<style scoped lang="scss">
</style>
