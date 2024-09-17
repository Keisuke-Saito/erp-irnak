<template>
  <div class="select-group">
    <select
      :id="selectId"
      v-model="request"
      class="select-tag"
      @change="updateValue"
    >
      <option
        v-for="(param, index) in params"
        :key="index"
        :value="param.value"
      >
        {{ param.label }}
      </option>
    </select>
    <ul :class="validationClasses">
      <div v-if="Object.keys(option).every(key => option[key].key)">
        <li
          v-for="(item, index) in option"
          :key="index"
        >
          {{ item.value }}
        </li>
      </div>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'ErpValidationSelect',
  props: {
    classType: { type: String, default: 'nomal' },
    option: { type: Array, required: true },
    value: { type: [String, Number], required: true },
    params: { type: [Object, Array], required: true },
    selectId: { type: String, default: '' }
  },
  data () {
    return { request: '' }
  },
  computed: {
    inputClasses () {
      const cls = this.classType ? this.classType : ''
      switch (cls) {
        default: return ['erp-input']
      }
    },
    validationClasses () {
      const cls = this.classType ? this.classType : ''
      switch (cls) {
        default: return ['erp-validation']
      }
    }
  },
  watch: {
    value (val, oldVal) { this.request = this.value }
  },
  created () {
    this.request = this.value
    this.$emit('input', this.value)
  },
  methods: {
    updateValue (e) { this.$emit('input', e.target.value) }
  }
}
</script>

<style scoped lang="scss">
.select-tag {
  box-sizing: border-box;
  width: 100%;
  margin-bottom: 4px;
  border: none;
  outline: none;
  padding: 4px;
  font-size: 13px;
  color: #333333;
  border: 1px solid rgba(0,0,0,0.3);
  border-radius: 4px;
  box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
  transition: box-shadow .5s ease;
  // font-weight: bold;
  &:focus {
    box-shadow: inset 0 -5px 45px rgba(100,100,100,0.3), 0 1px 1px rgba(255,255,255,0.2);
  }
}

.erp-validation {
  color: #333;
  font-size: 0.7em;
  padding: 0;
  margin: 0.25em 0;
  position: absolute;
  top: 25px;
}
</style>
