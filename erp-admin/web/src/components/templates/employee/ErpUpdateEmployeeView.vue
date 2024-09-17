<template>
  <div class="">
    <ErpH1>スタッフ更新画面</ErpH1>
    <ErpUpdateForm
      :profile-detail="profileDetail"
      :update-employee="updateEmployee"
    />
  </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import ErpH1 from '@/components/atoms/h/ErpH1.vue'
import ErpUpdateForm from '@/components/organisms/employee/ErpUpdateForm.vue'

export default {
  name: 'ErpUpdateEmployeeView',
  components: {
    ErpH1,
    ErpUpdateForm
  },
  data () {
    return {
      updateAble: false
    }
  },
  computed: {
    ...mapState({ employee: 'employee' }),
    ...mapGetters({ profileDetail: 'employee/getProfileDetail' })
  },
  created () { this.fetchProfileDetail() },
  methods: {
    fetchProfileDetail () {
      const messageId = this.messageInfo({ message: '従業員詳細情報読み込み中...' })
      this.$store.dispatch('employee/fetchProfileDetail', {
        uuid: this.$route.params.uuid
      })
        .then(() => this.messageDelete(messageId))
        .catch((err) => this.resultMessage({ id: messageId, error: this.throwError(err) }))
    },
    async updateEmployee (formdata) {
      await this.$store
        .dispatch('employee/updateEmployee', formdata)
        .catch((err) => this.throwReject(err))
      this.$router.push({ name: 'employeeProfile', params: { erpId: this.profileDetail.erpId } })
    }
  }
}
</script>

<style scoped lang="scss"></style>
