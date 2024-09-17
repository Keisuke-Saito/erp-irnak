<template>
  <tr>
    <td>{{ detail.targetDate }}</td>
    <td>{{ detail.destination }}</td>
    <td class="section">
      {{ detail.pointOfDeparture }}
    </td>
    <td class="section">
      {{ detail.routeDiv | routeDiv }}
    </td>
    <td class="section">
      {{ detail.arrival }}
    </td>
    <td>{{ detail.transportation | transportation }}</td>
    <td>{{ detail.amountOfMoney | numberWithDelimiter }}</td>
    <td>{{ detail.remarks | blank }}</td>
    <td>
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
    <td>
      <ErpButton
        v-if="disableForm"
        @click="showForm"
      >
        <i class="fas fa-edit" />
      </ErpButton>
      <ErpButton
        v-if="disableForm"
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
import ErpButton from '@/components/atoms/button/ErpButton.vue'
import ErpOverlay from '@/components/molecules/common/ErpOverlay.vue'
import ErpImageClick from '@/components/atoms/img/ErpImageClick.vue'
import ErpEditForm from '@/components/organisms/fare/ErpEditForm.vue'

export default {
  name: 'ErpFareApplyDetailTableItem',
  components: {
    ErpButton,
    ErpOverlay,
    ErpImageClick,
    ErpEditForm
  },
  props: {
    detail: { type: Object, required: true },
    disableForm: { type: Boolean, required: true }
  },
  data () {
    return {
      detailId: '',
      popupForm: false
    }
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
    resetForm () {
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
table td {
  padding: 5px 0;
  text-align: center;
  border: 1px solid #eee;
}
td.section {
  width: 200px;
}
</style>
