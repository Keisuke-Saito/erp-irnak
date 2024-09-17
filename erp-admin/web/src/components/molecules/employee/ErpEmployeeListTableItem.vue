<template>
  <tr>
    <td>{{ detail.erpId }}</td>
    <td>
      <ErpLinkButton
        :to="{
          name: 'employeeProfile',
          params: { erpId: detail.erpId }
        }"
        :name="detail.name"
        class="link-underline"
      />
    </td>
    <td>{{ detail.kana }}</td>
    <td>{{ detail.birthday }}</td>
    <td>{{ detail.gender | gender }}</td>
    <td>{{ detail.postalCode }}</td>
    <td>{{ detail.prefectural | prefectural }}{{ detail.address }}</td>
    <td>{{ detail.nearestStation | unknown }}</td>
    <td>{{ detail.birthplace | prefectural }}</td>
    <td>{{ detail.spouse | spouse }}</td>
    <td>{{ detail.enducationalBackground | enducationalBackground }}</td>
    <td>{{ detail.email }}</td>
    <td>{{ detail.contactNumber }}</td>
    <td>{{ detail.emergencyContactNumber | blank }}</td>
    <td>
      <div
        v-for="(item, index) in detail.possessionQualification"
        :key="index"
      >
        {{ item }}<br />
      </div>
    </td>
    <td>{{ detail.recruitmentClassification | recruitmentClassification }}</td>
    <td>{{ detail | classificationOfAttendance }}</td>
    <td>{{ getNameBelongMst(detail.belongId) }}</td>
    <td>{{ getNameAffiliationDept(detail.affiliationDeptId) }}</td>
    <td>{{ getNamePosition(detail.positionId) }}</td>
    <td>{{ detail.joinedAt }}</td>
    <td>{{ detail.retirementAt }}</td>
    <td>{{ getNameEmployeeDiv(detail.employeeDivId) }}</td>
    <td>{{ getNameBusinessDiv(detail.businessDivId) }}</td>
    <td>{{ detail.operationDestinationName | blank }}</td>
    <td>{{ detail.operationDestination | blank }}</td>
    <td>{{ detail.businessContent | blank }}</td>
    <td>{{ detail.note | blank }}</td>
    <td>{{ detail.loginDiv | loginDiv }}</td>
  </tr>
</template>

<script>
import { mapState } from 'vuex'
import ErpLinkButton from '@/components/atoms/button/ErpLinkButton.vue'

export default {
  name: 'ErpEmployeeListTableItem',
  components: {
    ErpLinkButton
  },
  props: {
    detail: { type: Object, required: true }
  },
  computed: {
    ...mapState({ common: 'common' }),
    belongMst () { return this.common.mst.commonMst.belongMst },
    affiliationDept () { return this.common.mst.commonMst.affiliationDeptMst },
    position () { return this.common.mst.commonMst.positionMst },
    employeeDiv () { return this.common.mst.commonMst.employeeDivMst },
    businessDiv () { return this.common.mst.commonMst.businessDivMst }
  },
  methods: {
    getNameBelongMst (id) {
      const index = this.belongMst.findIndex((v) => v.belongId === id)
      return this.belongMst[index] ? this.belongMst[index].name : '未定'
    },
    getNameAffiliationDept (id) {
      const index = this.affiliationDept.findIndex(
        (v) => v.affiliationDeptId === id
      )
      return this.affiliationDept[index]
        ? this.affiliationDept[index].name
        : '未定'
    },
    getNamePosition (id) {
      const index = this.position.findIndex((v) => v.positionId === id)
      return this.position[index] ? this.position[index].name : '未定'
    },
    getNameEmployeeDiv (id) {
      const index = this.employeeDiv.findIndex((v) => v.employeeDivId === id)
      return this.employeeDiv[index] ? this.employeeDiv[index].name : '未定'
    },
    getNameBusinessDiv (id) {
      const index = this.businessDiv.findIndex((v) => v.businessDivId === id)
      return this.businessDiv[index] ? this.businessDiv[index].name : '未定'
    }
  }
}
</script>

<style scoped lang="scss">
  table td {
    padding: 5px 0;
    text-align: center;
    min-width: 200px;
  }

  .link-underline {
    text-decoration: underline;
  }
</style>
