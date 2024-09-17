<template>
  <div class="login-view">
    <div class="login-card">
      <ErpSimpleH1 value="イルナック" />
      <ErpSimpleH1 value="管理者用ログイン" />
      <ErpLoginForm :onlogin="handleLogin" />
    </div>
  </div>
</template>

<script>
import ErpSimpleH1 from '@/components/atoms/h/ErpSimpleH1.vue'
import ErpLoginForm from '@/components/organisms/auth/ErpLoginForm.vue'

export default {
  name: 'ErpLoginView',
  components: {
    ErpSimpleH1,
    ErpLoginForm
  },
  methods: {
    async handleLogin (authInfo) {
      await this.$store.dispatch('auth/login', authInfo).catch(err => this.throwReject(err))
      this.$router.push({ name: 'top' })
    }
  }
}
</script>

<style scoped lang="scss">
.login-view {
  width: 100%;
  height:100vh;
  font-family: sans-serif;
  background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);
}
.login-card {
  position: absolute;
  top: 50%;
  left: 50%;
  margin: -150px 0 0 -150px;
  width:300px;
}
</style>
