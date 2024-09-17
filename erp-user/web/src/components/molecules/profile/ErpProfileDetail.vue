<template>
  <div>
    <div class="">
      <ErpH3 class-name="underline">
        基本情報
      </ErpH3>
      <ErpP>スタッフコード：{{ profile.erpId }}</ErpP>
      <ErpP>入社日：{{ profile.joinedAt }}</ErpP>
      <ErpP>退職日：{{ profile.retirementAt }}</ErpP>
      <ErpP>所属会社：{{ getNameBelongMst(profile.belongId) }}</ErpP>
      <ErpP>所属部門：{{ getNameAffiliationDept(profile.affiliationDeptId) }}</ErpP>
      <ErpP>役職：{{ getNamePosition(profile.positionId) }}</ErpP>
      <ErpP>従業員区分：{{ getNameEmployeeDiv(profile.employeeDivId) }}</ErpP>
      <ErpP>業務区分：{{ getNameBusinessDiv(profile.businessDivId) }}</ErpP>
    </div>
    <div class="">
      <ErpH3 class-name="underline">
        勤務情報
      </ErpH3>
      <ErpP>稼働先会社名称：{{ profile.operationDestinationName | blank }}</ErpP>
      <ErpP>稼働先(駅など)：{{ profile.operationDestination | blank }}</ErpP>
      <label>
        <span>業務内容：</span>
        <ErpInputTextarea
          :value="profile.businessContent"
          :disabled="true"
        />
      </label>
    </div>
    <div class="">
      <ErpH3 class-name="underline">
        登録情報
      </ErpH3>
      <ErpP>名前：{{ profile.name }}</ErpP>
      <ErpP>名前（カナ）：{{ profile.kana }}</ErpP>
      <ErpP>生年月日：{{ profile.birthday }}</ErpP>
      <ErpP>性別：{{ profile.gender | gender }}</ErpP>
      <ErpP>郵便番号：{{ profile.postalCode }}</ErpP>
      <ErpP>住所：{{ profile.prefectural | prefectural }}{{ profile.address }}</ErpP>
      <ErpP>最寄駅：{{ profile.nearestStation | unknown }}</ErpP>
    </div>
    <div class="">
      <ErpH3 class-name="underline">
        連絡先
      </ErpH3>
      <ErpP>Mail：{{ profile.email }}</ErpP>
      <ErpP>連絡先：{{ profile.contactNumber }}</ErpP>
      <ErpP>緊急連絡先：{{ profile.emergencyContactNumber | blank }}</ErpP>
    </div>
    <div class="">
      <ErpH3 class-name="underline">
        その他
      </ErpH3>
      <ErpP>所持資格：</ErpP>
      <table
        v-for="(item, index) in profile.possessionQualification"
        :key="index"
        border="1"
      >
        <td>{{ item }}</td>
      </table>
      <label>
        <span>メモ：</span>
        <ErpInputTextarea
          :value="profile.note"
          :disabled="true"
        />
      </label>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import ErpH3 from '@/components/atoms/h/ErpH3.vue'
import ErpP from '@/components/atoms/p/ErpP.vue'
import ErpInputTextarea from '@/components/atoms/form/ErpInputTextarea.vue'

export default {
  name: 'ErpProfileDetail',
  components: {
    ErpH3,
    ErpP,
    ErpInputTextarea
  },
  props: {
    profile: { type: [Array, Object], required: true }
  },
  computed: {
    ...mapState({ common: 'common' }),
    belong () { return this.common.mst.commonMst.belongMst },
    affiliationDept () { return this.common.mst.commonMst.affiliationDeptMst },
    position () { return this.common.mst.commonMst.positionMst },
    employeeDiv () { return this.common.mst.commonMst.employeeDivMst },
    businessDiv () { return this.common.mst.commonMst.businessDivMst }
  },
  methods: {
    getNameBelongMst (id) {
      const index = this.belong.findIndex((v) => v.belongId === id)
      return this.belong[index] ? this.belong[index].name : '未定'
    },
    getNameAffiliationDept (id) {
      const index = this.affiliationDept.findIndex((v) => v.affiliationDeptId === id)
      return this.affiliationDept[index] ? this.affiliationDept[index].name : '未定'
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
</style>
