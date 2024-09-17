<template>
  <div class="wrap">
    <ErpEmployeeSearchForm />

    <ErpTable :th-list="$consts.profile.PROFILE_COLUMNS">
      <ErpEmployeeListTableItem
        v-for="detail in employeeList"
        :key="detail.erpId"
        :detail="detail"
      />
    </ErpTable>
  </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import ErpTable from '@/components/molecules/common/ErpTable.vue'
import ErpEmployeeSearchForm from '@/components/molecules/employee/ErpEmployeeSearchForm.vue'
import ErpEmployeeListTableItem from '@/components/molecules/employee/ErpEmployeeListTableItem.vue'

export default {
  name: 'ErpEmployeeView',
  components: {
    ErpTable,
    ErpEmployeeListTableItem,
    ErpEmployeeSearchForm
  },
  computed: {
    ...mapState({ employee: 'employee' }),
    ...mapGetters({ employeeList: 'employee/getEmployeeList' })
  },
  created () {
    this.fetchEmployeeList()
  },
  methods: {
    // 画面描画
    async fetchEmployeeList (target) {
      const messageId = this.messageInfo({ message: '従業員情報読み込み中...' })
      await this.$store.dispatch('employee/fetchEmployeeList', { target })
        .then(() => this.messageDelete(messageId))
        .catch(err => this.resultMessage({ id: messageId, error: this.throwError(err) }))
      this.messageDelete(messageId)
    }
  }
}
</script>

<style scoped lang="scss">
  .wrap {
    margin: 40px 10px;
    overflow: scroll;
  }
</style>
