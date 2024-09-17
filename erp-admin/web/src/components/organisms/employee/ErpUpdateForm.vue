<template>
  <div class="employee-form">
    <form novalidate>
      <ErpP>{{ error }}</ErpP>
      <ErpError :errors="errors" />
      <div class="form-group">
        <ErpP class-name="form-ttl">
          姓名
        </ErpP>
        <label for="name1">
          <span>姓</span>
          <ErpValidationInputText
            v-model="formdata.lastname"
            :option="lastnameRule"
            input-id="name1"
          />
        </label>
        <label for="name2">
          <span>名</span>
          <ErpValidationInputText
            v-model="formdata.firstname"
            :option="firstnameRule"
            input-id="name2"
          />
        </label>
      </div>
      <div class="form-group">
        <ErpP class-name="form-ttl">
          姓名(フリガナ)
        </ErpP>
        <label for="name3">
          <span>姓</span>
          <ErpValidationInputText
            v-model="formdata.lastnameKana"
            :option="lastnameKanaRule"
            input-id="name3"
          />
        </label>
        <label for="name4">
          <span>名</span>
          <ErpValidationInputText
            v-model="formdata.firstnameKana"
            :option="firstnameKanaRule"
            input-id="name4"
          />
        </label>
      </div>
      <div class="form-group birth-group">
        <ErpP class-name="form-ttl">
          生年月日
        </ErpP>
        <label for="birthYear">
          <ErpValidationSelect
            v-model="formdata.birthYear"
            :option="birthYearRule"
            :params="yearSelect"
            select-id="birthYear"
          />
          <span>年</span>
        </label>
        <label for="birthMonth">
          <ErpValidationSelect
            v-model="formdata.birthMonth"
            :option="birthMonthRule"
            :params="$consts.common.MONTH_SELECT"
            select-id="birthMonth"
          />
          <span>月</span>
        </label>
        <label for="birthDay">
          <ErpValidationSelect
            v-model="formdata.birthDay"
            :option="birthDayRule"
            :params="$consts.common.DAY_SELECT"
            select-id="birthDay"
          />
          <span>日</span>
        </label>
      </div>
      <div class="form-group">
        <ErpP class-name="form-ttl">
          個人情報
        </ErpP>
        <label
          for="birthPlace"
          class="flex"
        >
          <span>出身都道府県：</span>
          <ErpSelect
            v-model="formdata.birthplace"
            :params="$consts.common.PREFECTURAL_SELECT"
            select-id="birthPlace"
          />
        </label>
        <label
          for="gender"
          class="flex s-select"
        >
          <span>性別：</span>
          <ErpValidationSelect
            v-model="formdata.gender"
            :option="genderRule"
            :params="$consts.profile.GENDER_SELECT"
            select-id="gender"
          />
        </label>
        <label
          for="spouse"
          class="flex s-select"
        >
          <span>配偶者：</span>
          <ErpSelect
            v-model="formdata.spouse"
            :params="$consts.profile.SPOUSE_SELECT"
            select-id="spouse"
          />
        </label>
        <label
          for="education"
          class="flex s-select"
        >
          <span>最終学歴：</span>
          <ErpSelect
            v-model="formdata.enducationalBackground"
            :params="$consts.profile.ENDUCATIONAL_BACKGROUND_SELECT"
            select-id="education"
          />
        </label>
      </div>
      <div class="form-group address-group">
        <ErpP class-name="form-ttl">
          現在住所
        </ErpP>
        <label for="postCode">
          <span>郵便番号：</span>
          <ErpValidationInputText
            v-model="formdata.postalCode"
            :option="postalCodeRule"
            input-id="postCode"
          />
        </label>
        <label
          for="prefectural"
          class="flex"
        >
          <span>都道府県：</span>
          <ErpValidationSelect
            v-model="formdata.prefectural"
            :option="prefecturalRule"
            :params="$consts.common.PREFECTURAL_SELECT"
            input-id="prefectural"
          />
        </label>
        <label for="address">
          <span>住所：</span>
          <ErpValidationInputText
            v-model="formdata.address"
            :option="addressRule"
            placeholder="新宿区新宿1-19-10 サンモールクレスト5F"
            input-id="address"
          />
        </label>
        <label for="nearestStation">
          <span>最寄駅：</span>
          <ErpInputText
            v-model="formdata.nearestStation"
            input-id="nearestStation"
          />
        </label>
      </div>
      <div class="form-group contact-group">
        <ErpP class-name="form-ttl">
          連絡先
        </ErpP>
        <label for="contactNumber">
          <span>電話番号：</span>
          <ErpValidationInputText
            v-model="formdata.contactNumber"
            :option="contactNumberRule"
            input-id="contactNumber"
          />
        </label>
        <label for="emergencyContactNumber">
          <span>緊急連絡先：</span>
          <ErpValidationInputText
            v-model="formdata.emergencyContactNumber"
            :option="emergencyContactNumberRule"
            input-id="emergencyContactNumber"
          />
        </label>
        <label for="email">
          <span>メールアドレス：</span>
          <ErpValidationInputText
            v-model="formdata.email"
            :option="emailRule"
            input-id="email"
          />
        </label>
      </div>
      <div class="form-group business-group">
        <ErpP class-name="form-ttl">
          業務
        </ErpP>
        <label for="recruitmentClassification">
          <span>採用区分:</span>
          <ErpSelect
            v-model="formdata.recruitmentClassification"
            :params="$consts.profile.RECRUITMENT_CLASSIFICATION_SELECT"
          />
        </label>
        <label for="belong">
          <span>所属:</span>
          <ErpSelect
            v-model="formdata.belongId"
            :params="belongMstSelect"
          />
        </label>
        <label for="affiliationDept">
          <span>所属部門:</span>
          <ErpSelect
            v-model="formdata.affiliationDeptId"
            :params="affiliationDeptMstSelect"
          />
        </label>
        <label for="position">
          <span>役職:</span>
          <ErpSelect
            v-model="formdata.positionId"
            :params="positionMstSelect"
          />
        </label>
        <label for="employeeDiv">
          <span>従業員区分:</span>
          <ErpSelect
            v-model="formdata.employeeDivId"
            :params="employeeDivMstSelect"
          />
        </label>
        <label for="businessDiv">
          <span>業務区分:</span>
          <ErpSelect
            v-model="formdata.businessDivId"
            :params="businessDivMstSelect"
          />
        </label>
        <label for="operationDestination">
          <span>稼働先(駅など):</span>
          <ErpInputText
            v-model="formdata.operationDestination"
            input-id="operationDestination"
          />
        </label>
        <label for="operationDestinationName">
          <span>稼働先会社名称:</span>
          <ErpInputText
            v-model="formdata.operationDestinationName"
            input-id="operationDestinationName"
          />
        </label>
        <label for="businessContent">
          <span>業務内容:</span>
          <ErpInputTextarea
            v-model="formdata.businessContent"
            textarea-id="businessContent"
          />
        </label>
      </div>
      <div class="form-group joined-group">
        <ErpP class-name="form-ttl">
          入社年月日
        </ErpP>
        <label for="joinedYear">
          <ErpValidationSelect
            v-model="formdata.joinedYear"
            :option="joinedYearRule"
            :params="yearSelect"
          />
          <span>年</span>
        </label>
        <label for="joinedMonth">
          <ErpValidationSelect
            v-model="formdata.joinedMonth"
            :option="joinedMonthRule"
            :params="$consts.common.MONTH_SELECT"
          />
          <span>月</span>
        </label>
        <label for="joinedDay">
          <ErpValidationSelect
            v-model="formdata.joinedDay"
            :option="joinedDayRule"
            :params="$consts.common.DAY_SELECT"
          />
          <span>日</span>
        </label>
      </div>
      <div class="form-group joined-group">
        <ErpP class-name="form-ttl">
          退職年月日
        </ErpP>
        <label for="retirementYear">
          <ErpValidationSelect
            v-model="formdata.retirementYear"
            :option="retirementYearRule"
            :params="yearSelect"
          />
          <span>年</span>
        </label>
        <label for="retirementMonth">
          <ErpValidationSelect
            v-model="formdata.retirementMonth"
            :option="retirementMonthRule"
            :params="$consts.common.MONTH_SELECT"
          />
          <span>月</span>
        </label>
        <label for="retirementDay">
          <ErpValidationSelect
            v-model="formdata.retirementDay"
            :option="retirementDayRule"
            :params="$consts.common.DAY_SELECT"
          />
          <span>日</span>
        </label>
      </div>
      <div class="form-group other-group">
        <ErpP class-name="form-ttl">
          備考
        </ErpP>
        <div>
          保有資格:
          <div
            v-for="(item, index) in formdata.possessionQualification"
            :key="index"
          >
            <label for="possessionQualification">
              <span>{{ index }}：</span>
              <ErpInputText
                v-model="item.value"
                input-id="possessionQualification"
              />
            </label>
            <div @click="deletePossessionQualification(index)">
              削除
            </div>
          </div>
          <div @click="addPossessionQualification">
            追加
          </div>
        </div>
        <label for="note">
          <span>メモ</span>
          <ErpInputTextarea
            v-model="formdata.note"
            textarea-id="note"
          />
        </label>
      </div>
      <div class="form-actions">
        <ErpButton
          :disabled="disableStoreAction"
          @click="handleClick"
        >
          更新
        </ErpButton>
      </div>
    </form>
  </div>
</template>

<script>
import { mapState } from 'vuex'
import ErpButton from '@/components/atoms/button/ErpButton.vue'
import ErpError from '@/components/atoms/form/ErpError.vue'
import ErpP from '@/components/atoms/p/ErpP.vue'
import ErpInputText from '@/components/atoms/form/ErpInputText.vue'
import ErpInputTextarea from '@/components/atoms/form/ErpInputTextarea.vue'
import ErpSelect from '@/components/atoms/form/ErpSelect.vue'
import ErpValidationInputText from '@/components/molecules/form/ErpValidationInputText.vue'
import ErpValidationSelect from '@/components/molecules/form/ErpValidationSelect.vue'

const required = val => val.trim()
const REGEX_EMAIL = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
const KANA_NAME = /^([ァ-ン]|ー)+$/
const POSTAL_CODE = /^\d{3}-\d{4}$/
const CONTACT_NUMBER = /^0\d{1,4}-\d{1,4}-\d{3,4}$/

export default {
  name: 'ErpUpdateForm',
  components: {
    ErpButton,
    ErpError,
    ErpP,
    ErpInputText,
    ErpInputTextarea,
    ErpSelect,
    ErpValidationInputText,
    ErpValidationSelect
  },
  props: {
    profileDetail: { type: Object, required: true },
    updateEmployee: { type: Function, required: true }
  },
  data () {
    return {
      formdata: {
        uuid: '',
        erpId: '',
        lastname: '',
        firstname: '',
        lastnameKana: '',
        firstnameKana: '',
        birthYear: '',
        birthMonth: '',
        birthDay: '',
        gender: '',
        birthplace: '',
        spouse: '',
        postalCode: '',
        prefectural: '',
        address: '',
        nearestStation: '',
        enducationalBackground: '',
        email: '',
        contactNumber: '',
        emergencyContactNumber: '',
        recruitmentClassification: '',
        belongId: '',
        affiliationDeptId: '',
        positionId: '',
        employeeDivId: '',
        businessDivId: '',
        joinedYear: '',
        joinedMonth: '',
        joinedDay: '',
        retirementYear: '',
        retirementMonth: '',
        retirementDay: '',
        businessContent: '',
        operationDestination: '',
        operationDestinationName: '',
        possessionQualification: [],
        note: ''
      },
      errors: {},
      error: ''
    }
  },
  computed: {
    ...mapState({ common: 'common' }),
    belongMstSelect () {
      const belongMstSelect = []
      const belongMst = this.common.mst.commonMst.belongMst
      for (let i = 0; i < belongMst.length; i++) {
        belongMstSelect.push({
          key: i,
          value: belongMst[i].belongId,
          label: belongMst[i].name
        })
      }
      return belongMstSelect
    },
    affiliationDeptMstSelect () {
      const affiliationDeptMstSelect = []
      const affiliationDeptMst = this.common.mst.commonMst.affiliationDeptMst
      for (let i = 0; i < affiliationDeptMst.length; i++) {
        affiliationDeptMstSelect.push({
          key: i,
          value: affiliationDeptMst[i].affiliationDeptId,
          label: affiliationDeptMst[i].name
        })
      }
      return affiliationDeptMstSelect
    },
    positionMstSelect () {
      const positionMstSelect = []
      const positionMst = this.common.mst.commonMst.positionMst
      for (let i = 0; i < positionMst.length; i++) {
        positionMstSelect.push({
          key: i,
          value: positionMst[i].positionId,
          label: positionMst[i].name
        })
      }
      return positionMstSelect
    },
    employeeDivMstSelect () {
      const employeeDivMstSelect = []
      const employeeDivMst = this.common.mst.commonMst.employeeDivMst
      for (let i = 0; i < employeeDivMst.length; i++) {
        employeeDivMstSelect.push({
          key: i,
          value: employeeDivMst[i].employeeDivId,
          label: employeeDivMst[i].name
        })
      }
      return employeeDivMstSelect
    },
    businessDivMstSelect () {
      const businessDivMstSelect = []
      const businessDivMst = this.common.mst.commonMst.businessDivMst
      for (let i = 0; i < businessDivMst.length; i++) {
        businessDivMstSelect.push({
          key: i,
          value: businessDivMst[i].businessDivId,
          label: businessDivMst[i].name
        })
      }
      return businessDivMstSelect
    },
    yearSelect () {
      const yearSelect = [{ key: 0, value: '', label: '選択してください' }]
      const thisyear = this.getYear()
      for (let i = 0; i < 100; i++) {
        yearSelect.push({ key: i, value: thisyear - i, label: thisyear - i })
      }
      return yearSelect
    },
    lastnameRule () { return [{ key: !this.validation.lastname.required, value: '苗字が入力されていません。' }] },
    firstnameRule () { return [{ key: !this.validation.firstname.required, value: '名前が入力されていません。' }] },
    lastnameKanaRule () { return [{ key: !this.validation.lastnameKana.format, value: '全角カタカナで入力してください。' }] },
    firstnameKanaRule () { return [{ key: !this.validation.firstnameKana.format, value: '全角カタカナで入力してください。' }] },
    birthYearRule () { return [{ key: !this.validation.birthYear.required, value: '生年月日（年）を選択してください。' }] },
    birthMonthRule () { return [{ key: !this.validation.birthMonth.required, value: '生年月日（月）を選択してください。' }] },
    birthDayRule () { return [{ key: !this.validation.birthDay.required, value: '生年月日（日）を選択してください。' }] },
    genderRule () { return [{ key: !this.validation.gender.required, value: '性別を選択してください。' }] },
    postalCodeRule () { return [{ key: !this.validation.postalCode.format, value: '郵便番号が正しく入力されていません。' }] },
    prefecturalRule () { return [{ key: !this.validation.prefectural.required, value: '都道府県を選択してください。' }] },
    addressRule () { return [{ key: !this.validation.address.required, value: '住所が入力されていません。' }] },
    contactNumberRule () { return [{ key: !this.validation.contactNumber.format, value: '半角数字でハイフンでつないで入力してください。' }] },
    emergencyContactNumberRule () { return [{ key: !this.validation.emergencyContactNumber.format, value: '半角数字でハイフンでつないで入力してください。' }] },
    emailRule () { return [{ key: !this.validation.email.format, value: 'メールアドレスが正しく入力されていません。' }] },
    joinedYearRule () { return [{ key: !this.validation.joinedYear.required, value: '入社年月日（年）を選択してください。' }] },
    joinedMonthRule () { return [{ key: !this.validation.joinedMonth.required, value: '入社年月日（月）を選択してください。' }] },
    joinedDayRule () { return [{ key: !this.validation.joinedDay.required, value: '入社年月日（日）を選択してください。' }] },
    retirementYearRule () { return [{ key: (this.validation.retirementMonth.required || this.validation.retirementDay.required) && !this.validation.retirementYear.required, value: '退職年（年）も選択してください。' }] },
    retirementMonthRule () { return [{ key: (this.validation.retirementYear.required || this.validation.retirementDay.required) && !this.validation.retirementMonth.required, value: '退職月（月）も選択してください。' }] },
    retirementDayRule () { return [{ key: (this.validation.retirementYear.required || this.validation.retirementMonth.required) && !this.validation.retirementDay.required, value: '退職日（日）も選択してください。' }] },
    validation () {
      const formdata = this.formdata
      return {
        lastname: { required: required(formdata.lastname) },
        firstname: { required: required(formdata.firstname) },
        lastnameKana: { format: KANA_NAME.test(formdata.lastnameKana) },
        firstnameKana: { format: KANA_NAME.test(formdata.firstnameKana) },
        birthYear: { required: formdata.birthYear },
        birthMonth: { required: formdata.birthMonth },
        birthDay: { required: formdata.birthDay },
        gender: { required: formdata.gender },
        postalCode: { format: POSTAL_CODE.test(formdata.postalCode) },
        prefectural: { required: required(formdata.prefectural) },
        address: { required: required(formdata.address) },
        contactNumber: { format: CONTACT_NUMBER.test(formdata.contactNumber) },
        emergencyContactNumber: { format: formdata.emergencyContactNumber === '' || CONTACT_NUMBER.test(formdata.emergencyContactNumber) },
        email: { format: REGEX_EMAIL.test(formdata.email) },
        joinedYear: { required: formdata.joinedYear },
        joinedMonth: { required: formdata.joinedMonth },
        joinedDay: { required: formdata.joinedDay },
        retirementYear: { required: (formdata.retirementYear || formdata.retirementMonth || formdata.retirementDay) ? formdata.retirementYear : true },
        retirementMonth: { required: (formdata.retirementYear || formdata.retirementMonth || formdata.retirementDay) ? formdata.retirementMonth : true },
        retirementDay: { required: (formdata.retirementYear || formdata.retirementMonth || formdata.retirementDay) ? formdata.retirementDay : true }
      }
    },
    valid () {
      const validation = this.validation
      const fields = Object.keys(validation)
      let valid = true
      for (let i = 0; i < fields.length; i++) {
        const field = fields[i]
        valid = Object.keys(validation[field]).every(
          (key) => validation[field][key]
        )
        if (!valid) {
          break
        }
      }
      return valid
    },
    disableStoreAction () { return !this.valid }
  },
  watch: {
    profileDetail (val, oldVal) { this.setDetail() }
  },
  methods: {
    setDetail () {
      this.formdata.uuid = this.profileDetail.uuid
      this.formdata.erpId = this.profileDetail.erpId
      this.formdata.lastname = this.profileDetail.name.split(' ')[0]
      this.formdata.firstname = this.profileDetail.name.split(' ')[1]
      this.formdata.lastnameKana = this.profileDetail.kana.split(' ')[0]
      this.formdata.firstnameKana = this.profileDetail.kana.split(' ')[1]
      this.formdata.birthYear = Number(this.profileDetail.birthday.split('-')[0])
      this.formdata.birthMonth = Number(this.profileDetail.birthday.split('-')[1])
      this.formdata.birthDay = Number(this.profileDetail.birthday.split('-')[2])
      this.formdata.gender = this.profileDetail.gender
      this.formdata.birthplace = this.profileDetail.birthplace
      this.formdata.postalCode = this.profileDetail.postalCode
      const prefectural = this.profileDetail.prefectural || '0'
      this.formdata.prefectural = prefectural + ''
      this.formdata.spouse = this.profileDetail.spouse ? this.profileDetail.spouse + 0 : ''
      this.formdata.address = this.profileDetail.address
      this.formdata.nearestStation = this.profileDetail.nearestStation || ''
      this.formdata.enducationalBackground = this.profileDetail.enducationalBackground || ''
      this.formdata.email = this.profileDetail.email
      this.formdata.contactNumber = this.profileDetail.contactNumber
      this.formdata.emergencyContactNumber = this.profileDetail.emergencyContactNumber || ''
      this.formdata.recruitmentClassification = this.profileDetail.recruitmentClassification
      this.formdata.belongId = this.profileDetail.belongId
      this.formdata.affiliationDeptId = this.profileDetail.affiliationDeptId
      this.formdata.positionId = this.profileDetail.positionId
      this.formdata.employeeDivId = this.profileDetail.employeeDivId
      this.formdata.businessDivId = this.profileDetail.businessDivId
      this.formdata.businessContent = this.profileDetail.businessContent || ''
      this.formdata.joinedYear = Number(this.profileDetail.joinedAt.split('-')[0])
      this.formdata.joinedMonth = Number(this.profileDetail.joinedAt.split('-')[1])
      this.formdata.joinedDay = Number(this.profileDetail.joinedAt.split('-')[2])
      this.formdata.retirementYear = (this.profileDetail.retirementAt == null) ? '' : Number(this.profileDetail.retirementAt.split('-')[0])
      this.formdata.retirementMonth = (this.profileDetail.retirementAt == null) ? '' : Number(this.profileDetail.retirementAt.split('-')[1])
      this.formdata.retirementDay = (this.profileDetail.retirementAt == null) ? '' : Number(this.profileDetail.retirementAt.split('-')[2])
      this.formdata.operationDestination = this.profileDetail.operationDestination || ''
      this.formdata.operationDestinationName = this.profileDetail.operationDestinationName || ''
      if (this.profileDetail.possessionQualification) {
        for (let i = 0; i < this.profileDetail.possessionQualification.length; i++) {
          const possessionQualification = this.profileDetail.possessionQualification[i]
          this.formdata.possessionQualification.push({ value: possessionQualification })
        }
      }
      this.formdata.note = this.profileDetail.note || ''
    },
    addPossessionQualification () {
      this.formdata.possessionQualification.push({ value: '' })
    },
    deletePossessionQualification (id) {
      this.formdata.possessionQualification.splice(id, 1)
    },
    async handleClick (ev) {
      if (this.disableStoreAction) {
        return
      }

      this.errors = {}
      this.error = ''

      const messageId = this.messageInfo({ message: '従業員情報更新中...' })

      this.$nextTick(() => {
        this.updateEmployee({ formdata: this.formdata })
          .then(() => {
            this.messageDelete(messageId)
          })
          .catch((err) => {
            if (err.data.errors) this.errors = err.data.errors
            if (err.data.message && !err.data.errors) this.error = err.data.message
            this.resultMessage({ id: messageId, error: this.throwError(err) })
          })
      })
    }
  }
}
</script>

<style scoped lang="scss">
  .employee-form {
    max-width: 800px;
    margin-top: 20px;
  }
  .input-group {
    position: relative;
    display: inline-block;
    width: 300px;
  }
  .form-group {
    margin-top: 60px;
    label {
      display: inline-block;
      margin-top: 10px;
      position: relative;
    }
    span {
      display: inline-block;
      vertical-align: middle;
      margin-right: 5px;
    }
  }

  .birth-group,
  .joined-group {
    .select-group {
      display: inline-block;
    }
    span {
      margin: 0 5px;
    }
    label {
      width: 200px;
    }
  }
  .address-group,
  .contact-group {
    label {
      display: block;
    }
    label + label {
      margin-top: 50px;
    }
  }

  .business-group {
    label {
      display: block;
      width: 150px;
    }
    label + label {
      margin-top: 25px;
    }
  }
  .other-group {
    span {
      vertical-align: top;
    }
  }

  .form-actions {
    margin-top: 50px;
  }
</style>
