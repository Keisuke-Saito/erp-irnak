<template>
  <tr>
    <td class="date">
      {{ detail.targetDate }}
    </td>
    <td class="destination">
      {{ detail.destination }}
    </td>
    <td class="departure">
      {{ detail.pointOfDeparture }}
    </td>
    <td class="arrtival">
      {{ detail.arrival }}
    </td>
    <td class="route">
      {{ detail.routeDiv | routeDiv }}
    </td>
    <td class="traffic">
      {{ detail.transportation | transportation }}
    </td>
    <td class="fare">
      {{ detail.amountOfMoney | numberWithDelimiter }}
    </td>
    <td class="remarks">
      {{ detail.remarks | blank }}
    </td>
    <td class="remarks">
      {{ detail.adminRemarks | blank }}
    </td>
    <td class="receipt">
      <ErpImageClick
        v-if="detail.receipt"
        :file-path="detail.receipt"
        type="receipt-img"
        fetch-img="fare/fetchImg"
        @click="handleClick"
      />
      <p v-else>
        添付無し
      </p>
    </td>
    <td class="handle">
      <ErpButton
        @click="showForm"
      >
        <i class="fas fa-edit" />
      </ErpButton>
      <ErpButton
        @click="destroyDetail"
      >
        <i class="fas fa-trash-alt" />
      </ErpButton>
    </td>

    <ErpOverlay
      :popup="popupForm"
      @cansel="cancel"
    >
      <ErpEditForm
        :detail-id="detailId"
        @cancel="cancel"
        @success="resetForm"
      />
    </ErpOverlay>
  </tr>
</template>

<script>
import ErpImageClick from '@/components/atoms/img/ErpImageClick.vue'
import ErpButton from '@/components/atoms/button/ErpButton.vue'
import ErpEditForm from '@/components/organisms/fare/ErpEditForm.vue'
import ErpOverlay from '@/components/molecules/common/ErpOverlay.vue'

export default {
  name: 'ErpFareDetailTableItem',
  components: {
    ErpButton,
    ErpOverlay,
    ErpImageClick,
    ErpEditForm
  },
  props: {
    detail: { type: Object, required: true }
  },
  data () {
    return {
      detailId: '',
      popupForm: false
    }
  },
  computed: {
    day () { return this.getDay(this.detail.targetDate) }
  },
  methods: {
    // 編集撤回
    cancel () {
      this.messageInfo({ message: 'キャンセルしました', timeout: 2000 })
      this.resetForm()
    },
    // form画面表示
    showForm () {
      this.detailId = this.detail.uuid
      this.popupForm = true
    },
    // form画面非表示
    resetForm (payload) {
      this.detailId = ''
      this.popupForm = false
    },
    // 削除
    async destroyDetail () {
      if (window.confirm('削除して良いですか？')) {
        const messageId = this.messageInfo({ message: '削除中...' })
        const error = await this.$store.dispatch('fare/delete', {
          uuid: this.detail.uuid
        }).catch(err => { return this.throwError(err) })
        this.resultMessage({ uuid: messageId, error, success: { message: '削除しました', timeout: 2000 } })
      }
    },
    handleClick () { this.$emit('click', this.detail.receipt) }
  }
}
</script>

<style scoped lang="scss">
// table {
//   width: 150%;
//   border-collapse: collapse;
//   border-spacing: 0;
// }
// table tr:nth-child(odd) {
//   background-color: #EEEEEE
// }
// table th {
//   padding: 5px 0;
//   text-align: center;
//   color:#225588;
//   box-shadow: 0px 1px 1px rgba(255,255,255,0.3) inset;
// }
table td {
  border: 1px solid #eee;
  padding: 0 5px;
  text-align: center;
}
.date {
  width: 200px;
}
.destination,.departure,.arrtival,.route {
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
  width: 200px;
}
</style>
