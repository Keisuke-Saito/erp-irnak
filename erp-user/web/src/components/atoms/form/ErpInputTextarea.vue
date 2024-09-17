<template>
  <div class="input-group">
    <textarea
      :value="value"
      :placeholder="placeholder"
      :disabled="disabled"
      :rows="rows"
      :cols="cols"
      class="textarea"
      @input="updateValue"
    />
    <label><slot /></label>
    <span class="focus-line" />
  </div>
</template>

<script>
export default {
  name: 'ErpInputTextarea',
  props: {
    placeholder: { type: String, default: '' },
    disabled: { type: Boolean, default: false },
    value: { type: String, required: true },
    rows: { type: Number, default: 8 },
    cols: { type: Number, default: 50 }
  },
  methods: {
    updateValue (e) { this.$emit('input', e.target.value) }
  }
}
</script>

<style scoped lang="scss">
.textarea {
  border: none;
  outline: none;
  border: 1px solid rgba(0,0,0,0.3);
  border-radius: 4px;
  background:rgba(100,100,100,0.2);
  &:focus {
    background: rgba(100,100,100,0.4);
  }
}
</style>
