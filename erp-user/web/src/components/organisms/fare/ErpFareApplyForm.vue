<template>
  <form
    novalidate
    class="fare-apply-form"
  >
    <h2 class="fare-apply-form__h2">
      下書きシート
    </h2>
    <div class="form-actions">
      <ErpButton
        @click="addNewItems"
      >
        自動入力
      </ErpButton>
      <select
        v-model="reason"
      >
        <option
          v-for="(reasonVal, index) in $consts.trafic.REASON_VALUE"
          :key="index"
          :value="reasonVal.value"
        >
          {{ reasonVal.label }}
        </option>
      </select>
    </div>
    <div class="form-actions">
      <ErpButton @click="addFormItems">
        行追加
      </ErpButton>
    </div>
    <div class="fare-apply-form__inner">
      <table>
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
        <tr
          v-for="(item, index) in formdata"
          :key="index"
        >
          <td>
            <ErpValidationInputText
              v-model="item.targetDate"
              :option="targetDateRule(index)"
              input-type="date"
            />
          </td>
          <td>
            <ErpValidationInputText
              v-model="item.destination"
              :option="destinationRule(index)"
              placeholder=""
            />
          </td>
          <td class="section">
            <span>(出発)</span>
            <ErpValidationInputText
              v-model="item.pointOfDeparture"
              :option="pointOfDepartureRule(index)"
              placeholder=""
            />
          </td>
          <td class="section">
            <span>(手段)</span>
            <ErpValidationSelect
              v-model="item.routeDiv"
              :option="routeDivRule(index)"
              :params="$consts.trafic.ROUTE_VALUE"
            />
          </td>
          <td class="section">
            <span>(到着)</span>
            <ErpValidationInputText
              v-model="item.arrival"
              :option="arrivalRule(index)"
              placeholder=""
            />
          </td>
          <td>
            <ErpValidationSelect
              v-model="item.transportation"
              :option="transportationRule(index)"
              :params="$consts.trafic.TRANSPORTATION_VALUE"
            />
          </td>
          <td>
            <ErpValidationInputText
              v-model="item.amountOfMoney"
              :option="amountOfMoneyRule(index)"
              placeholder=""
            />
          </td>
          <td>
            <ErpValidationInputText
              v-model="item.remarks"
              :option="remarksRule(index)"
            />
          </td>
          <td class="input-receipt">
            <div class="input-item">
              <div class="img">
                <label class="input-item__label img-add-btn">
                  <input
                    ref="file"
                    type="file"
                    @change="onFileChange(index, arguments[0])"
                  />
                  <i class="fas fa-plus-square" />
                </label>
                <label
                  class="img-delete-btn"
                  @click="resetInputFile(index)"
                >
                  <i class="fas fa-minus-square img-delete-btn" />
                </label>
                <img
                  v-if="item.uploadImage"
                  :src="item.uploadImage"
                />
                <img
                  v-else
                  :src="noimage"
                />
              </div>
            </div>
            <ul class="erp-validation">
              <div v-if="Object.keys(receiptRule(index)).every(key => receiptRule(index)[key].key)">
                <li
                  v-for="(rule, i) in receiptRule(index)"
                  :key="i"
                >
                  {{ rule.value }}
                </li>
              </div>
            </ul>
          </td>
          <td class="operation">
            <ErpButton @click="upFormItems(index)">
              <i class="fas fa-arrow-up" />
            </ErpButton>
            <ErpButton @click="downFormItems(index)">
              <i class="fas fa-arrow-down" />
            </ErpButton>
            <ErpButton @click="copyFormItems(index)">
              <i class="fas fa-copy" />
            </ErpButton>
            <ErpButton
              :disabled="disableDeleteFormItems"
              @click="deleteFormItems(index)"
            >
              <i class="fas fa-trash-alt" />
            </ErpButton>
          </td>
        </tr>
      </table>
    </div>
    <ErpError :errors="errors" />
    <ErpP>{{ error }}</ErpP>
    <div class="form-actions draft">
      <ErpButton
        :disabled="disableSubmitAction"
        @click="storeSubmit"
      >
        下書き保存
      </ErpButton>
    </div>
  </form>
</template>

<script>
import { mapGetters } from 'vuex'
import ErpButton from '@/components/atoms/button/ErpButton.vue'
import ErpP from '@/components/atoms/p/ErpP.vue'
import ErpError from '@/components/atoms/form/ErpError.vue'
import ErpValidationInputText from '@/components/molecules/form/ErpValidationInputText.vue'
import ErpValidationSelect from '@/components/molecules/form/ErpValidationSelect.vue'

const money = val => /[0-9]/.test(val)
const required = val => val.trim()
const formItem = {
  targetDate: '',
  destination: '',
  pointOfDeparture: '',
  arrival: '',
  routeDiv: '',
  transportation: '',
  amountOfMoney: '',
  remarks: '',
  receipt: '',
  uploadImage: ''
}

export default {
  name: 'ErpFareApplyForm',
  components: {
    ErpButton,
    ErpP,
    ErpError,
    ErpValidationInputText,
    ErpValidationSelect
  },
  data () {
    return {
      formdata: [JSON.parse(JSON.stringify(formItem))],
      reason: '',
      progress: false,
      errors: {},
      error: '',
      noimage: '../img/noimage.png'
    }
  },
  computed: {
    ...mapGetters({ detailList: 'fare/getDetailList' }),
    targetMonth () { return this.getMonth(this.detailList.fare.targetMonth) },
    targetYear () { return this.getYear(this.detailList.fare.targetMonth) },
    valid () {
      const validation = this.validation
      const formdata = this.formdata
      let valid = true
      for (let i = 0; i < formdata.length; i++) {
        const formItems = formdata[i]
        const fields = Object.keys(formItems)
        for (let s = 0; s < fields.length; s++) {
          const field = fields[s]
          if (field === 'uploadImage') { continue }
          const rule = validation(i)[field]
          valid = Object.keys(rule)
            .every(key => rule[key])
          if (!valid) { break }
        }
      }
      return valid
    },
    disableSubmitAction () { return !this.valid || this.progress },
    disableDeleteFormItems () { return this.formdata.length <= 1 }
  },
  methods: {
    targetDateRule (index) {
      return [{ key: !this.validation(index).targetDate.required, value: '選択されていません' }]
    },
    destinationRule (index) {
      return [{ key: !this.validation(index).destination.required, value: '入力されていません' }]
    },
    pointOfDepartureRule (index) {
      return [{ key: !this.validation(index).pointOfDeparture.required, value: '入力されていません' }]
    },
    arrivalRule (index) {
      return [{ key: !this.validation(index).arrival.required, value: '入力されていません' }]
    },
    routeDivRule (index) {
      return [{ key: !this.validation(index).routeDiv.required, value: '選択されていません' }]
    },
    transportationRule (index) {
      return [{ key: !this.validation(index).transportation.required, value: '選択されていません' }]
    },
    amountOfMoneyRule (index) {
      return [{ key: !this.validation(index).amountOfMoney.money, value: '半角数字で入力してください' }]
    },
    remarksRule (index) {
      return [{ key: !this.validation(index).remarks.required, value: '入力されていません' }]
    },
    receiptRule (index) {
      return [{ key: !this.validation(index).receipt.required, value: '領収書の添付が必須です' }]
    },
    validation (index) {
      return {
        targetDate: { required: required(this.formdata[index].targetDate) },
        destination: { required: required(this.formdata[index].destination) },
        pointOfDeparture: { required: required(this.formdata[index].pointOfDeparture) },
        arrival: { required: required(this.formdata[index].arrival) },
        routeDiv: { required: required(this.formdata[index].routeDiv) },
        transportation: { required: required(this.formdata[index].transportation) },
        amountOfMoney: { money: money(this.formdata[index].amountOfMoney) },
        remarks: { required: true },
        receipt: { required: this.formdata[index].routeDiv === '3' ? this.formdata[index].receipt : true }
      }
    },
    addFormItems () {
      this.formdata.push(JSON.parse(JSON.stringify(formItem)))
    },
    addNewItems () {
      if (this.reason === 0) {
        const targetMonth = this.targetMonth.toString().padStart(2, '0')
        this.formdata = [JSON.parse(JSON.stringify({
          targetDate: `${this.targetYear}-${targetMonth}-01`,
          destination: 'なし',
          pointOfDeparture: 'なし',
          arrival: 'なし',
          routeDiv: '1',
          transportation: '0',
          amountOfMoney: '0',
          remarks: 'リモートのため交通費無し',
          receipt: '',
          uploadImage: ''
        }))]
      }
    },
    copyFormItems (id) {
      const item = this.formdata[id]
      const copy = JSON.parse(JSON.stringify(item))
      copy.receipt = ''
      copy.uploadImage = ''
      this.formdata.push(copy)
    },
    upFormItems (id) {
      const length = this.formdata.length
      if (length === 1 || id === 0) return
      this.formdata.splice(id - 1, 2, this.formdata[id], this.formdata[id - 1])
    },
    downFormItems (id) {
      const length = this.formdata.length
      if (length <= id + 1) return
      this.formdata.splice(id, 2, this.formdata[id + 1], this.formdata[id])
    },
    deleteFormItems (id) {
      if (this.disableDeleteFormItems) return
      this.formdata.splice(id, 1)
    },
    // 申請
    storeSubmit (ev) {
      if (this.disableSubmitAction) { return }

      this.progress = true
      this.errors = {}
      this.error = ''
      const messageId = this.messageInfo({ message: '交通費申請中...' })

      this.$nextTick(() => {
        this.$store.dispatch('fare/store', {
          detail: this.formdata,
          targetMonth: `${this.targetYear}-${this.targetMonth}`
        })
          .then(() => {
            this.messageSuccess({ message: '追加しました', timeout: 2000 })
            this.$router.go({ name: 'applyFare', force: true })
          })
          .catch(err => {
            if (err.data.errors) this.errors = err.data.errors
            if (err.data.message && !err.data.errors) this.error = err.data.message
            this.resultMessage({ id: messageId, error: this.throwError(err) })
          })
          .then(() => {
            this.messageDelete(messageId)
            this.progress = false
          })
      })
    },
    // サムネイル表示
    onFileChange (id, e) {
      const render = new FileReader()
      render.onload = (e) => {
        this.formdata[id].uploadImage = e.target.result
      }
      render.readAsDataURL(e.target.files[0])
      this.formdata[id].receipt = e.target.files[0]
    },
    // inputタグを初期化
    resetInputFile (id) {
      const input = this.$refs.file[id]
      input.type = 'text'
      input.type = 'file'
      this.formdata[id].uploadImage = ''
      this.formdata[id].receipt = ''
    }
  }
}
</script>

<style scoped lang="scss">
.fare-apply-form {
  margin-top: 25px;
  margin-bottom: 50px;
  border-top: 1px solid #333;
  border-bottom: 1px solid #333;
  padding-bottom: 20px;
  &__inner {
  overflow-x: scroll;
  white-space: nowrap;
  margin-top: 25px;
  }
  &__h2 {
    margin-top: 20px;
    font-size: 1.2em;
  }
}
table {
  width: 130%;
  border-collapse: collapse;
  border-spacing: 0;
  tr:nth-child(odd) {
    background-color: #F3F3F3;
  }
  th {
    border: 1px solid #333;
    color:#225588;
    background: #EEE;
    box-shadow: 0px 1px 1px rgba(255,255,255,0.3) inset;
    padding: 5px 0;
    text-align: center;
    position: relative;
  }
  td {
    border: 1px solid #eee;
    padding: 0 5px;
  }
  td.section {
    position: relative;
    text-align: center;
    width: 200px;
    span {
      position: absolute;
      top: 40px;
      left: 50%;
      transform: translateX(-50%);
    }
  }
  .date {
    width: 200px;
  }
  .destination {
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
    width: 200px;
  }
  .handle {
    width: 200px;
  }
}
.arrow_box {
  display: none;
  position: absolute;
  padding: 16px;
  border-radius: 8px;
  color: #fff;
  background: #1E488D;
  border: 4px solid #1E488D;
}
.arrow_box:after, .arrow_box:before {
  top: 100%;
  left: 50%;
  border: solid transparent;
  content: "";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
}
.arrow_box:after {
  border-color: rgba(30, 72, 141, 0);
  border-top-color: #1E488D;
  border-width: 30px;
  margin-left: -30px;
}
.arrow_box:before {
  border-color: rgba(30, 72, 141, 0);
  border-top-color: #1E488D;
  border-width: 36px;
  margin-left: -36px;
}
.input-item {
  // margin-top: -10px;
  width: 100%;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 150px;
}
.input-item .img {
  // margin-left: 5px;
  // margin-bottom: 5px;
  // width: 100px;
  height: 80px;
  width: 80px;
  position: relative;
}
.input-item img {
  max-width: 100%;
  max-height: 100%;
}
.input-item .input-item__label > input {
  display: none;
}
.input-item label {
  // color: #AAA;
  // padding: 0 1rem;
  position: absolute;
  bottom: -30px;
  // width: 80px;
  // height: 80px;
  &:hover {
    cursor: pointer;
    // opacity: .7;
    // transition: opacity 3s;
  }
  i {
    font-size: 20px;
  }
}
.input-item .img-add-btn {
  left: 10px;
}
.input-item .img-delete-btn {
  right: 10px;
}
.form-actions {
  margin-top: 20px;
}
.draft {
  margin-top: 30px;
}
.operation {
  text-align: center;
}
.input-receipt {
  position: relative;
  padding-bottom: 20px;
  .erp-validation {
    color: #333;
    font-size: 0.7em;
    padding: 0;
    margin: 0.25em 0;
    position: absolute;
    bottom: 0;
  }
}
</style>
