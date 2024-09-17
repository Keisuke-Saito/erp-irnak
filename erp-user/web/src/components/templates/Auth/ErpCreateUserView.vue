<template>
  <div class="login-view">
    <div class="login-card">
      <ErpCreateUserForm
        v-if="check"
        :erp-id="data.erpId"
        :name="data.name"
        :email="data.email"
      />
      <ErpSimpleH1
        v-else
        value="無効なトークンです。"
      />
    </div>

    <ErpPopUpMessages />
  </div>
</template>

<script>
import ErpPopUpMessages from '@/components/molecules/popup/ErpPopUpMessages.vue'
import ErpSimpleH1 from '@/components/atoms/h/ErpSimpleH1.vue'
import ErpCreateUserForm from '@/components/organisms/auth/ErpCreateUserForm.vue'

export default {
  name: 'ErpCreateUserView',
  components: {
    ErpPopUpMessages,
    ErpSimpleH1,
    ErpCreateUserForm
  },
  data () {
    return {
      data: {
        erpId: '',
        name: '',
        email: '',
        password: ''
      },
      check: false
    }
  },
  created () {
    this.checkToken()
  },
  methods: {
    async checkToken () {
      const messageId = this.messageInfo({ message: 'トークンチェック中...' })
      const result = await this.$store.dispatch('auth/checkToken', this.$route.query.token)
        .catch(() => { return false })
      this.messageDelete(messageId)
      if (result) {
        this.data.erpId = result.data.erpId
        this.data.name = result.data.name
        this.data.email = result.data.email
        this.check = true
      }
    }
  }
}
</script>

<style scoped lang="scss">
// .login-view {
//   width: 100%;
//   height:100vh;
//   font-family: sans-serif;
//   background-color: #092756;
//   background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%),-moz-linear-gradient(top,  rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg,  #670d10 0%, #092756 100%);
//   background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
//   background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
//   background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg,  #670d10 0%,#092756 100%);
//   background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg,  #670d10 0%,#092756 100%);
//   filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
// }
// .login-card {
//   position: absolute;
//   top: 50%;
//   left: 50%;
//   margin: -150px 0 0 -150px;
//   width:300px;
//   height:300px;
// }
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
  height:300px;
}

</style>
