<template>
  <div class="radio">
    <div
      v-for="option in options"
      :key="option.key"
    >
      <label
        :key="option.key"
        :class="classes(option.value)"
      >
        <input
          :id="option.key"
          :key="option.key"
          v-model="request"
          :value="option.value"
          type="radio"
          @change="updateValue"
        />
        {{ option.label }}
      </label>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ErpInputRadioGroup',
  props: {
    value: { type: [String, Number], required: true },
    options: { type: Array, required: true }
  },
  data () {
    return { request: '' }
  },
  watch: {
    value (val, oldVal) { this.request = this.value }
  },
  created () {
    this.request = this.value
    this.$emit('input', this.value)
  },
  methods: {
    updateValue (e) { this.$emit('input', this.request) },
    classes (value) { return String(value) === String(this.value) ? ['checked', 'label'] : ['label'] }
  }
}
</script>

<style scoped lang="scss">
.radio input {
  display: none;
}
.label {
  display: block;
  float: left;
  cursor: pointer;
  width: 33.333%;
  margin: 0;
  padding: 10px;
  background-image: linear-gradient(#808080 0%, #D9E5FF 100%);
  color: #3300FF;
  font-weight: bold;
  font-size: 16px;
  text-align: center;
  line-height: 1;
  box-sizing: border-box;
  transition: .2s;
}
.checked {
  background-image: linear-gradient(#FF4F02 0%, #FF9872 100%);
  color: #FFF;
  transition: 0.3s;
}
</style>
