<template>
  <div>
    <ErpLinkButton
      :to="{
        name: 'fare',
        query: { ty: targetYear, tm: targetMonth }
      }"
      name="この月の一覧に戻る"
    />
    <ErpSearch @fetch="fetchFareDetail" />

    <ErpFareDetailInfoList />

    <ErpFareCreateForm />

    <ErpFareDetailTable />
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import ErpLinkButton from '@/components/atoms/button/ErpLinkButton.vue'
import ErpSearch from '@/components/organisms/fare/ErpSearch.vue'
import ErpFareDetailInfoList from '@/components/organisms/fare/ErpFareDetailInfoList.vue'
import ErpFareDetailTable from '@/components/organisms/fare/ErpFareDetailTable.vue'
import ErpFareCreateForm from '@/components/organisms/fare/ErpFareCreateForm.vue'

export default {
  name: 'ErpFareDetailView',
  components: {
    ErpLinkButton,
    ErpSearch,
    ErpFareDetailInfoList,
    ErpFareDetailTable,
    ErpFareCreateForm
  },
  computed: {
    ...mapGetters({ detailList: 'fare/getDetailList' }),
    targetMonth () { return this.getMonth(this.detailList.targetMonth) },
    targetYear () { return this.getYear(this.detailList.targetMonth) }
  },
  methods: {
    // 画面描画
    fetchFareDetail (target) {
      const messageId = this.messageInfo({ message: '交通費詳細情報読み込み中...' })
      this.$store.dispatch('fare/fetchDetailByUser', {
        erpId: this.$route.params.uid,
        target
      })
        .then(() => this.messageDelete(messageId))
        .catch(err => this.resultMessage({ id: messageId, error: this.throwError(err) }))
    }
  }
}
</script>

<style scoped lang="scss">
</style>
