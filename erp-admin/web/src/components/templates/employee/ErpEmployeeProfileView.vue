<template>
  <div class="">
    <ErpH1>スタッフ情報画面</ErpH1>
    <ErpLinkButton
      v-if="updateAble"
      :to="{
        name: 'updateEmployee',
        params: { uuid: profile.uuid }
      }"
      name="更新"
      type="blue"
    />
    <ErpButton
      v-if="deleteAble"
      type="red"
      @click="deleteEmployee"
    >
      ログインユーザー削除
    </ErpButton>
    <ErpSearch
      v-if="updateAble"
      :profile-history="profileHistory"
      @target="setTarget"
    />
    <ErpProfileDetail
      v-if="updateAble"
      :profile="profile"
    />
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import ErpH1 from '@/components/atoms/h/ErpH1.vue'
import ErpButton from '@/components/atoms/button/ErpButton.vue'
import ErpLinkButton from '@/components/atoms/button/ErpLinkButton.vue'
import ErpSearch from '@/components/organisms/employee/ErpSearch.vue'
import ErpProfileDetail from '@/components/molecules/employee/ErpProfileDetail.vue'

export default {
  name: 'ErpEmployeeProfileView',
  components: {
    ErpH1,
    ErpButton,
    ErpLinkButton,
    ErpSearch,
    ErpProfileDetail
  },
  data () {
    return {
      target: 0
    }
  },
  computed: {
    ...mapGetters({ profileHistory: 'employee/getProfileHistory' }),
    profile () {
      // eslint-disable-next-line no-unused-vars
      for (const i in this.profileHistory) {
        const profile = this.profileHistory[i]
        if (Number(i) === this.target) {
          return profile
        }
      }
      return {}
    },
    updateAble () { return this.profileHistory.length > 0 },
    deleteAble () {
      const profile = this.profileHistory[0]
      if (profile === undefined) return false
      const retirement = profile.retirementAt != null
      const loginDiv = profile.loginDiv === true
      return retirement && loginDiv
    }
  },
  created () { this.fetchProfileHistory() },
  methods: {
    // 画面描画 追加
    fetchProfileHistory () {
      const messageId = this.messageInfo({ message: '従業員詳細情報読み込み中...' })
      this.$store.dispatch('employee/fetchProfileHistory', { erpId: this.$route.params.erpId })
        .then(() => this.messageDelete(messageId))
        .catch((err) => this.resultMessage({ id: messageId, error: this.throwError(err) }))
    },
    async deleteEmployee () {
      if (!confirm('削除すると "' + this.profileHistory[0].name + 'さん" はログインができなくなります。\n問題ありませんか？')) return
      const messageId = this.messageInfo({ message: 'ログイン情報削除中...' })
      await this.$store.dispatch('employee/deleteEmployee', { erpId: this.$route.params.erpId })
        .then(() => this.messageDelete(messageId))
        .catch((err) => this.resultMessage({ id: messageId, error: this.throwError(err) }))
    },
    setTarget (value) {
      this.target = Number(value)
    }
  }
}
</script>

<style scoped lang="scss"></style>
