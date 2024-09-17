<template>
  <div class="input-group">
    <input
      :class="classes"
      :type="inputType"
      :placeholder="placeholder"
      :value="value"
      autocomplete="off"
      @input="updateValue"
    />
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
  name: 'ErpValidationInputText',
  props: {
    placeholder: { type: String, default: '' },
    className: { type: String, default: 'erp' },
    inputType: { type: String, default: 'text' },
    option: { type: Array, required: true },
    value: { type: String, required: true }
  },
  computed: {
    classes () {
      const cls = this.className ? this.className : ''
      switch (cls) {
        case 'login':
          return ['erp-input', 'login-input']
        default:
          return ['erp-input']
      }
    },
    validationClasses () {
      const cls = this.className ? this.className : ''
      switch (cls) {
        case 'login':
          return ['erp-validation', 'login-validation']
        default:
          return ['erp-validation']
      }
    }
  },
  methods: {
    updateValue (e) { this.$emit('input', e.target.value) }
  }
}
</script>

<style scoped lang="scss">
.input-group {
  position: relative;
}

.erp-input {
  box-sizing: border-box;
  width: 100%;
  border: none;
  outline: none;
  padding: 5px;
  font-size: 13px;
  color: #333;
  font-weight: bold;
  border: 1px solid rgba(0,0,0,0.3);
  border-radius: 4px;
  box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
  transition: box-shadow .5s ease;
  &:focus {
    box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2);
  }
}
.erp-validation {
  color: #333;
  font-size: 0.7em;
  padding: 0;
  margin: 0.25em 0;
  position: absolute;
}

.login-input {
  padding: 10px;
  color: #fff;
  background-color: rgba(0,0,0,0.4);
  border: 1px solid rgba(0,0,0,0);
  transition: .2s all ease;
  &:focus {
    color: #333333;
    background-color: #fff;
    border-color: #dddddd;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0,0,0,0.1);
  }
  &::placeholder {
    color: #fff;
  }
}
.login-validation {
  margin-bottom: 20px;
  position: relative;
}
</style>
