<template>
  <form novalidate>
    <ErpP class-name="login">
      {{ name }}さんの登録画面です。
    </ErpP>
    <ErpP class-name="login">
      IDは：{{ erpId }}
    </ErpP>
    <ErpP class-name="login">
      アドレスは：{{ email }}
    </ErpP>
    <ErpValidationInputText
      v-model="password"
      :option="passwordRule"
      class-name="login"
      input-type="password"
      placeholder="パスワード"
    />
    <ErpValidationInputText
      v-model="confirm"
      :option="confirmRule"
      class-name="login"
      input-type="password"
      placeholder="パスワード確認"
    />
    <div class="form-actions">
      <ErpButton
        :disabled="disableLoginAction"
        type="login"
        @click="handleClick"
      >
        登録
      </ErpButton>
      <ErpP
        class-name="login"
        :boolean="progress"
      >
        登録中...
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
  name: 'ErpCreateUserForm',
  components: {
    ErpButton,
    ErpP,
    ErpValidationInputText
  },
  props: {
    erpId: { type: String, required: true },
    name: { type: String, required: true },
    email: { type: String, required: true }
  },
  data () {
    return {
      password: '',
      confirm: '',
      progress: false,
      error: ''
    }
  },
  computed: {
    passwordRule () {
      return [{ key: !this.validation.password.required, value: 'パスワードが入力されていません。' }]
    },
    confirmRule () {
      return [{
        key: !this.validation.password.required, value: '入力されていません。'
      }, {
        key: !this.validation.confirm.confirm, value: 'パスワードが一致しません。'
      }]
    },
    validation () {
      return {
        confirm: { required: required(this.confirm), confirm: this.confirm === this.password },
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
        this.$store.dispatch('auth/createUser', {
          token: this.$route.query.token,
          erpId: this.erpId,
          email: this.email,
          password: this.password
        })
          .then(() => {
            this.$router.push({ name: 'top' })
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
