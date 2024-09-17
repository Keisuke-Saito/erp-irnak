<template>
  <div class="input-group">
    <input
      :value="value"
      class="ef"
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
    value: { type: [String, Number], required: true }
  },
  methods: {
    updateValue (e) { this.$emit('input', e.target.value) }
  }
}
</script>

<style scoped lang="scss">
.input-group {
  position: relative;
  width: 80%;
  margin: 20px;
}
.input-group input {
  text-align: center;
  font-size: 18px;
  box-sizing: border-box;
  width: 100%;
  letter-spacing: 1px;
  padding-left: 60px;
}
.input-group input:focus {
  outline: none;
}
.ef {
  padding: 4px 0;
  border: 0;
  border-bottom: 1px solid #3300FF;
  background-color: transparent;
}
.ef ~ .focus-line {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  transition: 0.4s;
  background-color: #FF4F02;
}
.ef:focus ~ .focus-line,
.input-group.ef ~ .focus-line {
  width: 100%;
  transition: 0.4s;
}
.ef ~ label {
  position: absolute;
  z-index: -1;
  left: 0;
  width: 100%;
  transition: 0.3s;
  letter-spacing: 0.5px;
  color: #AAA;
}
.ef:focus ~ label, .input-group.ef ~ label {
  font-size: 12px;
  top: -16px;
  transition: 0.3s;
  color: #FF4F02;
}
</style>
