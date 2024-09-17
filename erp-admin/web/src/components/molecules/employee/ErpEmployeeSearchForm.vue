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
        退職：
        <ErpButton
          v-for="(value, index) in retirement"
          :key="index"
          :type="retirementButton(index)"
          @click="retirementCheck(index)"
        >
          {{ value }}
        </ErpButton>
      </li>
      <li>
        ログイン制御：
        <ErpButton
          v-for="(value, index) in loginDiv"
          :key="index"
          :type="confirmButton(index)"
          @click="loginDivCheck(index)"
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
    <p>ソート</p>
    <ul>
      <li>
        項目：
        <ErpButton
          v-for="detail in $consts.profile.PROFILE_SORT_SELECT"
          :key="detail.value"
          :type="targetButton(detail.value)"
          @click="targetCheck(detail.value)"
        >
          {{ detail.label }}
        </ErpButton>
      </li>
      <li>
        ソート順：
        <ErpButton
          v-for="detail in $consts.profile.ORDER_BY_SELECT"
          :key="detail.value"
          :type="orderByButton(detail.value)"
          @click="orderByCheck(detail.value)"
        >
          {{ detail.label }}
        </ErpButton>
      </li>
    </ul>
  </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import ErpButton from '@/components/atoms/button/ErpButton.vue'

export default {
  name: 'ErpEmployeeSearchForm',
  components: {
    ErpButton
  },
  computed: {
    ...mapState({ employee: 'employee' }),
    ...mapGetters({ employeeList: 'employee/getEmployeeList' }),
    ...mapState({ common: 'common' }),
    belongMst () { return this.common.mst.commonMst.belongMst },
    retirement () { return { false: '現職', true: '退職' } },
    loginDiv () { return this.$consts.profile.LOGIN_DIV_LIST }
  },
  methods: {
    allCheck () { this.$store.commit('employee/allCheck') },
    belongCheck (value) { this.$store.commit('employee/belongCheck', { target: value }) },
    retirementCheck (value) { this.$store.commit('employee/retirementCheck', { target: value }) },
    loginDivCheck (value) { this.$store.commit('employee/loginDivCheck', { target: value }) },
    allCheckButton () { return this.employee.search.all ? 'blue' : '' },
    belongButton (value) { return this.employee.search.belong.indexOf(value) >= 0 ? 'blue' : '' },
    retirementButton (value) { return this.employee.search.retirement.indexOf(value) >= 0 ? 'blue' : '' },
    confirmButton (value) { return this.employee.search.loginDiv.indexOf(value) >= 0 ? 'blue' : '' },
    targetCheck (value) { this.$store.commit('employee/targetCheck', { target: value }) },
    targetButton (value) { return this.employee.sort.target.indexOf(value) >= 0 ? 'blue' : '' },
    orderByCheck (value) { this.$store.commit('employee/orderByCheck', { target: value }) },
    orderByButton (value) { return this.employee.sort.orderBy.indexOf(value) >= 0 ? 'blue' : '' }
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
