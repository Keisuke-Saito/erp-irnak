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
          :value="option.value"
          :key="option.key"
          v-model="request"
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
</style>
