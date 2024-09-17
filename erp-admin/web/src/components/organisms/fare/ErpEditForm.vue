<template>
  <div
    class="fare-form-wrap"
    @click="cancel"
  >
    <div
      class="fare-form"
      @click="stopEvent"
    >
      <form novalidate>
        <ErpP>{{ error }}</ErpP>
        <ErpError :errors="errors" />
        <div class="form-group">
          <ErpP class-name="parts-ttl">
            日付
          </ErpP>
          <ErpValidationInputText
            v-model="detail.targetDate"
            :option="targetDateRule"
            input-type="date"
            class="form-group-item"
          />
          <ErpP class-name="parts-ttl">
            行き先
          </ErpP>
          <ErpValidationInputText
            v-model="detail.destination"
            :option="destinationRule"
            placeholder=""
            class="form-group-item"
          />
        </div>
        <div class="form-group">
          <ErpP class-name="parts-ttl">
            区間
          </ErpP>
          <ErpValidationInputText
            v-model="detail.pointOfDeparture"
            :option="pointOfDepartureRule"
            placeholder="出発"
            class="form-group-item"
          />
          <ErpValidationSelect
            v-model="detail.routeDiv"
            :option="routeDivRule"
            :params="$consts.trafic.ROUTE_VALUE"
            class="form-group-item"
          />
          <ErpValidationInputText
            v-model="detail.arrival"
            :option="arrivalRule"
            placeholder="到着"
            class="form-group-item"
          />
        </div>
        <div class="form-group">
          <ErpP class-name="parts-ttl">
            交通手段
          </ErpP>
          <ErpValidationSelect
            v-model="detail.transportation"
            :option="transportationRule"
            :params="$consts.trafic.TRANSPORTATION_VALUE"
          />
        </div>
        <div class="form-group">
          <ErpP class-name="parts-ttl">
            金額
          </ErpP>
          <ErpValidationInputText
            v-model="detail.amountOfMoney"
            :option="amountOfMoneyRule"
            placeholder="10000"
          />
        </div>
        <div class="form-group remarks-group">
          <ErpP class-name="parts-ttl">
            管理者記入欄
          </ErpP>
          <ErpValidationInputText
            v-model="detail.adminRemarks"
            :option="remarksRule"
          />
        </div>
        <div class="form-group receipt-group">
          <ErpP class-name="parts-ttl">
            領収書
          </ErpP>
          <div class="input-item">
            <label class="input-item__label">
              <input
                ref="file"
                type="file"
                @change="onFileChange"
              />
              <i class="fas fa-plus-square" />
            </label>
            <label @click="resetInputFile"><i class="fas fa-minus-square img-delete-btn" /></label>
            <div class="img">
              <img
                v-if="uploadImage"
                :src="uploadImage"
              />
              <img
                v-else
                :src="noimage"
              />
            </div>
          </div>
          <ul class="erp-validation">
            <div v-if="Object.keys(receiptRule).every(key => receiptRule[key].key)">
              <li
                v-for="(item, index) in receiptRule"
                :key="index"
              >
                {{ item.value }}
              </li>
            </div>
          </ul>
        </div>
        <div class="form-actions">
          <ErpButton
            :disabled="disableSubmitAction"
            @click="updateSubmit"
          >
            更新
          </ErpButton>
          <ErpButton @click="cancel">
            キャンセル
          </ErpButton>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import ErpButton from '@/components/atoms/button/ErpButton.vue'
import ErpError from '@/components/atoms/form/ErpError.vue'
import ErpP from '@/components/atoms/p/ErpP.vue'
import ErpValidationInputText from '@/components/molecules/form/ErpValidationInputText.vue'
import ErpValidationSelect from '@/components/molecules/form/ErpValidationSelect.vue'

const money = val => /[0-9]/.test(val)
const required = val => val.trim()

export default {
  name: 'ErpEditForm',
  components: {
    ErpButton,
    ErpError,
    ErpP,
    ErpValidationInputText,
    ErpValidationSelect
  },
  props: {
    detailId: { type: String, default: null }
  },
  data () {
    return {
      detail: {
        uuid: '',
        fareId: '',
        targetDate: '',
        destination: '',
        pointOfDeparture: '',
        arrival: '',
        routeDiv: '',
        transportation: '',
        amountOfMoney: '',
        adminRemarks: '',
        receipt: '',
        imgObj: ''
      },
      uploadImage: '',
      progress: false,
      errors: {},
      error: '',
      noimage: '../../img/noimage.png'
    }
  },
  computed: {
    ...mapGetters({ detailList: 'fare/getDetailList' }),
    targetDateRule () {
      return [{ key: !this.validation.targetDate.required, value: '日付を入力してください。' }]
    },
    destinationRule () {
      return [{ key: !this.validation.destination.required, value: '入力されていません。' }]
    },
    pointOfDepartureRule () {
      return [{ key: !this.validation.pointOfDeparture.required, value: '入力されていません。' }]
    },
    arrivalRule () {
      return [{ key: !this.validation.arrival.required, value: '入力されていません。' }]
    },
    routeDivRule () {
      return [{ key: !this.validation.routeDiv.required, value: '選択されていません。' }]
    },
    transportationRule () {
      return [{ key: !this.validation.transportation.required, value: '選択されていません。' }]
    },
    amountOfMoneyRule () {
      return [{ key: !this.validation.amountOfMoney.money, value: '半角数字で入力してください。' }]
    },
    remarksRule () {
      return [{ key: !this.validation.remarks.required, value: '入力されていません。' }]
    },
    receiptRule () {
      return [{ key: !this.validation.receipt.required, value: '領収書の添付が必須です。' }]
    },
    validation () {
      return {
        targetDate: { required: required(this.detail.targetDate) },
        destination: { required: required(this.detail.destination) },
        pointOfDeparture: { required: required(this.detail.pointOfDeparture) },
        arrival: { required: required(this.detail.arrival) },
        routeDiv: { required: required(this.detail.routeDiv) },
        transportation: { required: required(this.detail.transportation) },
        amountOfMoney: { money: money(this.detail.amountOfMoney) },
        remarks: { required: true },
        receipt: { required: this.detail.routeDiv === '3' ? (this.detail.receipt || this.detail.imgObj) : true }
      }
    },
    valid () {
      const validation = this.validation
      const fields = Object.keys(validation)
      let valid = true
      for (let i = 0; i < fields.length; i++) {
        const field = fields[i]
        valid = Object.keys(validation[field])
          .every(key => validation[field][key])
        if (!valid) { break }
      }
      return valid
    },
    disableSubmitAction () { return !this.valid || this.progress }
  },
  watch: {
    detailId (val, oldVal) {
      this.setDetail()
    }
  },
  methods: {
    // モーダルのイベントキャンセル
    stopEvent () {
      event.stopPropagation()
    },
    // 更新
    updateSubmit (ev) {
      if (this.disableSubmitAction) { return }

      this.progress = true
      this.errors = {}
      this.error = ''
      const messageId = this.messageInfo({ message: '交通費更新中...' })

      this.$nextTick(() => {
        this.$store.dispatch('fare/update', this.detail)
          .then(() => {
            this.messageSuccess({ message: '更新しました', timeout: 2000 })
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
    // キャンセル
    cancel () {
      this.resetDetail()
      this.$emit('cancel')
    },
    // 初期値に戻す
    resetDetail () {
      this.detail.uuid = ''
      this.detail.fareId = ''
      this.detail.targetDate = ''
      this.detail.destination = ''
      this.detail.pointOfDeparture = ''
      this.detail.routeDiv = ''
      this.detail.arrival = ''
      this.detail.transportation = ''
      this.detail.amountOfMoney = ''
      this.detail.adminRemarks = ''
      this.detail.receipt = ''
      this.detail.imgObj = ''
      this.errors = {}
      this.resetInputFile()
    },
    // 対象レコードのセット
    async setDetail () {
      // eslint-disable-next-line no-unused-vars
      for (const item of this.detailList.details) {
        if (item.uuid === this.detailId) {
          this.detail.uuid = item.uuid
          this.detail.fareId = item.fareId
          this.detail.targetDate = item.targetDate
          this.detail.destination = item.destination
          this.detail.pointOfDeparture = item.pointOfDeparture
          this.detail.routeDiv = String(item.routeDiv)
          this.detail.arrival = item.arrival
          this.detail.transportation = String(item.transportation)
          this.detail.amountOfMoney = String(item.amountOfMoney)
          this.detail.adminRemarks = item.adminRemarks === null ? '' : item.adminRemarks
          this.detail.receipt = item.receipt === null ? '' : item.receipt
          const result = await this.fetchImageData({ type: 'fare/fetchImg', filePath: this.detail.receipt })
          this.uploadImage = result.data
        }
      }
    },
    // サムネイル表示
    onFileChange (e) {
      const render = new FileReader()
      render.onload = (e) => {
        this.uploadImage = e.target.result
      }
      render.readAsDataURL(e.target.files[0])
      this.detail.imgObj = e.target.files[0]
    },
    // inputタグを初期化
    resetInputFile () {
      const input = this.$refs.file
      input.type = 'text'
      input.type = 'file'
      this.detail.receipt = ''
      this.uploadImage = ''
      this.detail.imgObj = ''
    }
  }
}
</script>

<style scoped lang="scss">
.fare-form-wrap {
  width:100%;
  height:100%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.fare-form {
  width: 700px;
  padding: 40px;
  z-index:20;
  background:#FFF;
}
.erp-validation {
  color: #333333;
  font-size: 0.5em;
  padding: 0;
  margin: 0;
}

.input-item {
  width: 100px;
  height: 110px;
  display: flex;
  align-items: flex-start;
  justify-content: flex-start;
  position: relative;
  .img {
    width: 80px;
    height: 80px;
  }
  img {
    max-width: 100%;
    max-height: 100%;
  }
  .input-item__label > input {
    display: none;
  }
  label {
    // color: #AAA;
    position: absolute;
    bottom: 0;
    &:hover {
      cursor: pointer;
    }
    &:first-child { //画像登録ボタン
      left: 10px;
    }
    &:nth-child(2) { //削除ボタン
      right: 25px;
    }
    i {
      font-size: 20px;
    }
  }
}

.form-group {
  display: flex;
  flex-direction: row;
  width: 100%;
  // height: 30px;
  margin-top: 40px;
}
.form-group-item {
  flex-grow: 1;
  padding: 0 5px;
}
.mt40 {
  margin-top: 40px;
}
.form-actions {
  margin-top: 20px;
}
.receipt-group {
  display: block;
}
</style>
