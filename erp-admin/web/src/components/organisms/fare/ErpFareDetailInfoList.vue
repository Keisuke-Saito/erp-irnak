<template>
  <ul class="fare-detail-info">
    <li>名前：{{ detailList.name }}</li>
    <li>フリガナ：{{ detailList.kana }}</li>
    <li>自宅最寄駅：{{ detailList.nearestStation }}</li>
    <!-- <li>稼働先：{{ detailList }}</li> -->
    <li>
      ステータス：{{ confirmStatus }}
      <ErpButton @click="changeStatus(reject)">
        差し戻す
      </ErpButton>
      <ErpButton @click="changeStatus(verified)">
        確認済み
      </ErpButton>
    </li>
    <li v-if="detailList.details.length > 0">
      合計金額：{{ totalFee | numberWithDelimiter }}円
    </li>
    <li v-if="detailList.retirementAt !== null">
      {{ detailList.retirementAt }}に退職しました
    </li>
  </ul>
</template>

<script>
import { mapGetters } from 'vuex'
import ErpButton from '@/components/atoms/button/ErpButton.vue'

export default {
  name: 'ErpFareDetailInfoList',
  components: {
    ErpButton
  },
  computed: {
    ...mapGetters({ detailList: 'fare/getDetailList' }),
    confirmStatus () {
      return this.$consts.fare.CONFIRM_STATUS_LIST[this.detailList.confirmStatus]
    },
    reject () {
      return this.$consts.fare.CONFIRM_STATUS_MODIFYING
    },
    verified () {
      return this.$consts.fare.CONFIRM_STATUS_VERIFID
    },
    totalFee () {
      let total = 0
      // eslint-disable-next-line no-unused-vars
      for (const item of this.detailList.details) {
        total += Number(item.amountOfMoney)
      }
      return total
    }
  },
  methods: {
    async changeStatus (status) {
      if (!window.confirm('本当にステータスを変更して良いですか？')) return
      const messageId = this.messageInfo({ message: 'ステータス更新中...' })

      this.$store.dispatch('fare/changeStatus', {
        uuid: this.detailList.uuid,
        status
      })
        .then(() => {
          this.messageDelete(messageId)
          this.messageSuccess({ message: '更新しました', timeout: 2000 })
        })
        .catch(err => this.resultMessage({
          id: messageId, error: this.throwError(err)
        }))
    }
  }
}
</script>

<style scoped lang="scss">
.fare-detail-info {
  list-style: none;
  border:  1px solid #eee;
  padding: 10px;
  margin-bottom: 20px;
}
</style>
