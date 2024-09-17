<template>
  <div class="fare-view">
    <ErpH1 value="交通費申請" />
    <ErpP
      :class-name="className"
    >
      {{ statusString }}
    </ErpP>

    <div class="fare-view-body">
      <ErpSearch @fetch="fetchFare" />
      <ErpFareApplyForm v-if="disableForm" />
      <ErpFareApplyDetailTable :disable-form="disableForm" />
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import ErpH1 from '@/components/atoms/h/ErpH1.vue'
import ErpP from '@/components/atoms/p/ErpP.vue'
import ErpSearch from '@/components/organisms/fare/ErpSearch.vue'
import ErpFareApplyForm from '@/components/organisms/fare/ErpFareApplyForm.vue'
import ErpFareApplyDetailTable from '@/components/organisms/fare/ErpFareApplyDetailTable.vue'

export default {
  name: 'ErpFareApplyView',
  components: {
    ErpH1,
    ErpP,
    ErpSearch,
    ErpFareApplyForm,
    ErpFareApplyDetailTable
  },
  computed: {
    ...mapGetters({ detailList: 'fare/getDetailList' }),
    statusString () {
      let str = ''
      switch (this.confirmStatus) {
        case this.$consts.fare.CONFIRM_STATUS_UNSUBMITTED :
          if (this.disableForm) str = '交通費申請を行なってください'
          else str = '申請の受付は終了しています'
          break
        case this.$consts.fare.CONFIRM_STATUS_UNFIXED :
          str = '交通費の申請を行なってください'
          break
        case this.$consts.fare.CONFIRM_STATUS_FIXED :
          str = '交通費申請中です'
          break
        case this.$consts.fare.CONFIRM_STATUS_AUTO_FIXED :
        case this.$consts.fare.CONFIRM_STATUS_VERIFID :
          str = '申請の受付は終了しています'
          break
        case this.$consts.fare.CONFIRM_STATUS_MODIFYING :
          str = '早急に修正し申請しなおしてください'
          break
      }
      return str
    },
    className () {
      let name = 'default'
      if (this.confirmStatus === this.$consts.fare.CONFIRM_STATUS_MODIFYING) {
        name = 'red'
      }
      return name
    },
    confirmStatus () { return this.detailList.fare.confirmStatus },
    targetMonth () { return this.getMonth(this.detailList.fare.targetMonth) },
    targetYear () { return this.getYear(this.detailList.fare.targetMonth) },
    // 未申請
    isUnFixed () {
      if (this.confirmStatus === this.$consts.fare.CONFIRM_STATUS_UNSUBMITTED) return true
      if (this.confirmStatus === this.$consts.fare.CONFIRM_STATUS_UNFIXED) return true
      if (this.confirmStatus === this.$consts.fare.CONFIRM_STATUS_MODIFYING) return true
      return false
    },
    disableForm () {
      let year = Number(this.getYear())
      let month = Number(this.getMonth())
      const now = `${year}-${month}`
      const target = `${this.targetYear}-${this.targetMonth}`
      if (month === 1) {
        year = year - 1
        month = 12
      } else {
        month = month - 1
      }
      const subMonth = `${year}-${month}`
      if (this.confirmStatus !== null) return this.isUnFixed
      if (now === target) return true
      return target === subMonth
    }
  },
  methods: {
    // 画面描画
    fetchFare (target) {
      const messageId = this.messageInfo({ message: '交通費詳細情報読み込み中...' })
      this.$store.dispatch('fare/fetchFareHistory', { target })
        .then(() => this.messageDelete(messageId))
        .catch(err => this.resultMessage({ id: messageId, error: this.throwError(err) }))
    }
  }
}
</script>

<style scoped lang="scss">
.fare-view {
  margin-bottom: 80px;
}
</style>
