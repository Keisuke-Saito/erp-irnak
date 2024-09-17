<template>
  <div class="fare-all-view">
    <ErpTable
      v-if="detailList.details.length > 0"
      :th-list="$consts.trafic.FARE_DETAIL_TH"
      class="fare-detail-table"
    >
      <ErpFareDetailTableItem
        v-for="detail in detailList.details"
        :key="detail.id"
        :detail="detail"
        @click="showPopup"
      />
    </ErpTable>
    <p v-else>
      この月の申請はありません。
    </p>

    <ErpOverlay
      :popup="popup"
      @cansel="closePopup"
    >
      <ErpImageClick
        :file-path="srcPath"
        type="popup-receipt-img"
        fetch-img="fare/fetchImg"
        @click="closePopup"
      />
    </ErpOverlay>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import ErpImageClick from '@/components/atoms/img/ErpImageClick.vue'
import ErpTable from '@/components/molecules/common/ErpTable.vue'
import ErpOverlay from '@/components/molecules/common/ErpOverlay.vue'
import ErpFareDetailTableItem from '@/components/molecules/fare/ErpFareDetailTableItem.vue'

export default {
  name: 'ErpFareDetailTable',
  components: {
    ErpImageClick,
    ErpTable,
    ErpOverlay,
    ErpFareDetailTableItem
  },
  data () {
    return {
      srcPath: '',
      popup: false
    }
  },
  computed: {
    ...mapGetters({ detailList: 'fare/getDetailList' })
  },
  methods: {
    showPopup (value) {
      this.srcPath = value
      this.popup = true
    },
    closePopup () {
      this.srcPath = ''
      this.popup = false
    }
  }
}
</script>

<style scoped lang="scss">
.fare-all-view {
  white-space: nowrap;
  margin-top: 20px;
  overflow: auto;
}
</style>
