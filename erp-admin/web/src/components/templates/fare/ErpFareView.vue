<template>
  <div>
    <ErpSearch
      pagename="fare"
      @fetch="fetchFare"
    />

    <ErpP>合計：{{ fareList.count | numberWithDelimiter }}円</ErpP>

    <ErpFareSearchForm />

    <ErpFareTable :th-list="$consts.trafic.FARE_TH">
      <ErpFareAllListTableItem
        v-for="detail in fareList.list"
        :key="detail.id"
        :detail="detail"
      />
    </ErpFareTable>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import ErpP from '@/components/atoms/p/ErpP.vue'
import ErpSearch from '@/components/organisms/fare/ErpSearch.vue'
import ErpFareTable from '@/components/molecules/fare/ErpFareTable.vue'
import ErpFareSearchForm from '@/components/molecules/fare/ErpFareSearchForm.vue'
import ErpFareAllListTableItem from '@/components/molecules/fare/ErpFareAllListTableItem.vue'

export default {
  name: 'ErpFareView',
  components: {
    ErpP,
    ErpSearch,
    ErpFareTable,
    ErpFareSearchForm,
    ErpFareAllListTableItem
  },
  computed: {
    ...mapGetters({ fareList: 'fare/getFareList' })
  },
  methods: {
    // 画面描画
    fetchFare (target) {
      const messageId = this.messageInfo({ message: '交通費情報読み込み中...' })
      this.$store.dispatch('fare/fetchFareList', { target })
        .then(() => this.messageDelete(messageId))
        .catch(err => this.resultMessage({ id: messageId, error: this.throwError(err) }))
    }
  }
}
</script>

<style scoped lang="scss">
</style>
