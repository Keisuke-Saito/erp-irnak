<template>
  <div class="fare-apply-detail">
    <ErpH1 value="保存中のデータ" />
    <table v-if="detailList.list.length > 0">
      <tr id="tr">
        <th class="date">
          日付
        </th>
        <th class="destination">
          <span>行先</span>
          <p class="arrow_box">
            常駐先の企業名、店舗名or訪問先名
          </p>
        </th>
        <th
          colspan="3"
          class="section"
        >
          <span>区間</span>
          <p class="arrow_box">
            出発した駅名またはバス停、
            到着した駅名またはバス停を入力
          </p>
        </th>
        <th class="traffic">
          交通手段
        </th>
        <th class="fare">
          金額
        </th>
        <th class="remarks">
          備考
        </th>
        <th class="receipt">
          領収書
        </th>
        <th class="handle">
          操作
        </th>
      </tr>
      <ErpFareApplyDetailTableItem
        v-for="detail in detailList.list"
        :key="detail.id"
        :detail="detail"
        :disable-form="disableForm"
        @click="showPopup"
      />
      <ErpButton
        v-if="disableForm"
        @click="comfirmFare"
      >
        <i class="fas fa-check-circle" />管理者へ申請
      </ErpButton>
    </table>
    <p v-else>
      保存中のデータはありません
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
import ErpButton from '@/components/atoms/button/ErpButton.vue'
import ErpH1 from '@/components/atoms/h/ErpH1.vue'
import ErpImageClick from '@/components/atoms/img/ErpImageClick.vue'
import ErpOverlay from '@/components/molecules/common/ErpOverlay.vue'
import ErpFareApplyDetailTableItem from '@/components/molecules/fare/ErpFareApplyDetailTableItem.vue'

export default {
  name: 'ErpFareApplyDetailTable',
  components: {
    ErpButton,
    ErpH1,
    ErpImageClick,
    ErpOverlay,
    ErpFareApplyDetailTableItem
  },
  props: {
    disableForm: { type: Boolean, required: true }
  },
  data () {
    return {
      srcPath: '',
      popup: false
    }
  },
  computed: {
    ...mapGetters({ detailList: 'fare/getDetailList' }),
    targetMonth () { return this.getMonth(this.detailList.fare.targetMonth) },
    targetYear () { return this.getYear(this.detailList.fare.targetMonth) }
  },
  methods: {
    showPopup (value) {
      this.srcPath = value
      this.popup = true
    },
    closePopup () {
      this.srcPath = ''
      this.popup = false
    },
    // 申請処理
    async comfirmFare () {
      if (window.confirm('一度、管理者に申請すると変更できません。申請しても良いですか？')) {
        const messageId = this.messageInfo({ message: '申請処理中...' })
        const error = await this.$store.dispatch('fare/confirm', {
          uuid: this.detailList.fare.uuid,
          status: this.$consts.fare.CONFIRM_STATUS_FIXED
        }).catch(err => { return this.throwError(err) })
        this.resultMessage({ id: messageId, error, success: { message: '申請しました', timeout: 2000 } })
      }
    }
  }
}
</script>

<style scoped lang="scss">
.fare-apply-detail {
  white-space: nowrap;
  overflow-x: scroll;
}
table {
  width: 130%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}
table th {
  border: 1px solid #333;
  color:#225588;
  background: #EEE;
  box-shadow: 0px 1px 1px rgba(255,255,255,0.3) inset;
  padding: 5px 0;
  text-align: center;
  position: relative;
}
table tr:nth-child(odd) {
  background-color: #F3F3F3
}
table th {
  color:#225588;
  box-shadow: 0px 1px 1px rgba(255,255,255,0.3) inset;
}
.destination {
  width: 200px;
}
td.section {
  width: 200px;
  position: relative;
  text-align: center;
  // span {
  //   position: absolute;
  //   top: 20px;
  //   left: 50%;
  //   transform: translateX(-50%);
  // }
}
.date {
  width: 200px;
}
.traffic {
  width: 200px;
}
.fare {
  width: 200px;
}
.remarks {
  width: 300px;
}
.receipt {
  width: 150px;
}
.handle {
  width: 200px
}
.arrow_box {
  display: none;
  position: absolute;
  padding: 16px;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  border-radius: 8px;
  background: #333;
  color: #fff;
}
.arrow_box:after {
  position: absolute;
  bottom: 100%;
  left: 50%;
  width: 0;
  height: 0;
  margin-left: -10px;
  border: solid transparent;
  border-color: rgba(51, 51, 51, 0);
  border-bottom-color: #333;
  border-width: 10px;
  pointer-events: none;
  content: " ";
}
.erp-button {
  margin-top: 50px;
}
</style>
