<template>
  <div class="input-group">
    <input
      :id="inputId"
      :class="inputClasses"
      :value="value"
      type="text"
      @input="updateValue"
    />
    <label><slot /></label>
    <span class="focus-line" />
  </div>
</template>

<script>
export default {
  name: 'ErpInputText',
  props: {
    classType: { type: String, default: 'nomal' },
    value: { type: [String, Number], required: true },
    inputId: { type: String, default: '' }
  },
  computed: {
    inputClasses () {
      const cls = this.classType ? this.classType : ''
      switch (cls) {
        default: return ['erp-input']
      }
    }
  },
  methods: {
    updateValue (e) { this.$emit('input', e.target.value) }
  }
}
</script>

<style scoped lang="scss">
  .erp-input {
    box-sizing: border-box;
    width: 100%;
    border: none;
    outline: none;
    padding: 5px;
    font-size: 13px;
    color: #333;
    font-weight: bold;
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-radius: 4px;
    box-shadow: inset 0 -5px 45px rgba(100, 100, 100, 0.2),
      0 1px 1px rgba(255, 255, 255, 0.2);
    transition: box-shadow 0.5s ease;
    &:focus {
      box-shadow: inset 0 -5px 45px rgba(100, 100, 100, 0.4),
        0 1px 1px rgba(255, 255, 255, 0.2);
    }
  }
</style>
