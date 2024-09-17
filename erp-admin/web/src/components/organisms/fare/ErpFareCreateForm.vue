<template>
  <div>
    <ErpButton
      @click="showForm"
    >
      <i class="fas fa-edit" />新規登録
    </ErpButton>
    <ErpOverlay
      :popup="popupForm"
      @cansel="cancel"
    >
      <ErpFareApplyForm
        @cancel="cancel"
        @success="resetForm"
      />
    </ErpOverlay>
  </div>
</template>

<script>
import ErpButton from '@/components/atoms/button/ErpButton.vue'
import ErpOverlay from '@/components/molecules/common/ErpOverlay.vue'
import ErpFareApplyForm from '@/components/organisms/fare/ErpFareApplyForm.vue'

export default {
  name: 'ErpFareCreateForm',
  components: {
    ErpButton,
    ErpOverlay,
    ErpFareApplyForm
  },
  // props: {
  //   detail: {type: Object, required: true}
  // },
  data () {
    return {
      // detailId: '',
      popupForm: false
    }
  },
  // computed: {
  //   ...mapGetters({detailList: 'fare/getDetailList'})
  // },
  methods: {
    // 編集撤回
    cancel () {
      this.messageInfo({ message: 'キャンセルしました', timeout: 2000 })
      this.resetForm()
    },
    // form画面表示
    showForm () {
      this.popupForm = true
    },
    // form画面非表示
    resetForm (payload) {
      // this.detailId = ''
      this.popupForm = false
    },
    handleClick () { this.$emit('click', this.detail.receipt) }
  }
}
</script>

<style scoped lang="scss">
table td {
  padding: 5px 0;
  text-align: center;
}
</style>
