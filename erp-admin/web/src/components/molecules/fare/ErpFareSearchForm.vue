<template>
  <div class="form">
    <p>絞り込み検索</p>
    <ul>
      <li>
        所属：
        <ErpButton
          v-for="detail in belongMst"
          :key="detail.belongId"
          :type="belongButton(detail.belongId)"
          @click="belongCheck(detail.belongId)"
        >
          {{ detail.name }}
        </ErpButton>
      </li>
      <li>
        ステータス：
        <ErpButton
          v-for="(value, index) in confirmStatus"
          :key="index"
          :type="confirmButton(Number.isNaN(Number(index)) ? null : Number(index))"
          @click="confirmStatusCheck(Number.isNaN(Number(index)) ? null : Number(index))"
        >
          {{ value }}
        </ErpButton>
      </li>
      <li>
        全て選択：<ErpButton
          :type="allCheckButton()"
          @click="allCheck"
        />
      </li>
    </ul>
    <ErpCsvDownload :download="download" />
  </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import ErpButton from '@/components/atoms/button/ErpButton.vue'
import ErpCsvDownload from '@/components/atoms/button/ErpCsvDownload.vue'

export default {
  name: 'ErpFareSearchForm',
  components: {
    ErpButton,
    ErpCsvDownload
  },
  computed: {
    ...mapState({ fare: 'fare' }),
    ...mapGetters({ fareList: 'fare/getFareList' }),
    ...mapGetters({ csvDownloadList: 'fare/getCsvTarget' }),
    ...mapState({ common: 'common' }),
    belongMst () { return this.common.mst.commonMst.belongMst },
    confirmStatus () { return this.$consts.fare.CONFIRM_STATUS_LIST }
  },
  methods: {
    // csvdownload
    async download () {
      const result = await this.$store.dispatch('fare/download', {
        targetMonth: this.fareList.year + '-' + this.fareList.month,
        targetErpIdList: this.csvDownloadList
      })
        .catch(err => this.throwReject(err))
      return result
    },
    allCheck () { this.$store.commit('fare/allCheck') },
    belongCheck (value) { this.$store.commit('fare/belongCheck', { target: value }) },
    confirmStatusCheck (value) { this.$store.commit('fare/confirmStatusCheck', { target: value }) },
    allCheckButton () { return this.fare.csv.all ? 'blue' : '' },
    belongButton (value) { return this.fare.csv.belong.indexOf(value) >= 0 ? 'blue' : '' },
    confirmButton (value) { return this.fare.csv.confirmStatus.indexOf(value) >= 0 ? 'blue' : '' }
  }
}
</script>

<style scoped lang="scss">
.form {
  margin: 30px;
  padding: 8px;
  border: 1px solid #AAAAAA;
}
li {
  list-style: none;
}
</style>
