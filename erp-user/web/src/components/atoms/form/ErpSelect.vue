<template>
  <div class="select-group">
    <select
      v-model="request"
      class="select-tag"
      @change="updateValue"
    >
      <option
        v-for="(option, index) in options"
        :key="index"
        :value="option.value"
      >
        {{ option.label }}
      </option>
    </select>
    <span class="select-tag-highlight" />
    <span class="select-tag-selectbar" />
    <label class="select-tag-selectlabel"><slot /></label>
  </div>
</template>

<script>
export default {
  name: 'ErpSelect',
  props: {
    value: { type: [String, Number], required: true },
    options: { type: [Object, Array], required: true }
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
    updateValue (e) { this.$emit('input', e.target.value) }
  }
}
</script>

<style scoped lang="scss">
.select-group {
  position: relative;
  text-align: center;
  width: 80%;
  margin: 20px;
}
.select-tag {
  position: relative;
  background-color: transparent;
  width: 100%;
  padding: 10px 10px 5px 100px;
  font-size: 15px;
  border-radius: 0;
  border: none;
  border-bottom: 1px solid #3300FF;
}
.select-tag:focus {
  outline: none;
  border-bottom: 1px solid #FF4F02;
}
.select-group .select-tag {
  appearance: none;
  -webkit-appearance:none
}
.select-group select::-ms-expand {
  display: none;
}
.select-group:after {
  position: absolute;
  top: 18px;
  right: 10px;
  width: 0;
  height: 0;
  padding: 0;
  content: '';
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  border-top: 6px solid rgba(0, 0, 0, 0.3);
  pointer-events: none;
}
.select-tag-selectlabel {
  color: rgba(0,0,0, 0.5);
  font-size: 15px;
  font-weight: normal;
  position: absolute;
  pointer-events: none;
  left: 0;
  top: 10px;
  transition: 0.2s ease all;
}
.select-tag:focus ~ .select-tag-selectlabel {
  color: #FF4F02;
  top: -20px;
  transition: 0.2s ease all;
  font-size: 14px;
}
.select-tag-selectbar {
  position: relative;
  display: block;
  width: 100%;
}
.select-tag-selectbar:before, .select-tag-selectbar:after {
  content: '';
  height: 2px;
  width: 0;
  bottom: 1px;
  position: absolute;
  background: #FF4F02;
  transition: 0.2s ease all;
}
.select-tag-selectbar:before {
  left: 50%;
}
.select-tag-selectbar:after {
  right: 50%;
}
.select-tag:focus ~ .select-tag-selectbar:before, .select-tag:focus ~ .select-tag-selectbar:after {
  width: 50%;
}
.select-tag-highlight {
  position: absolute;
  top: 25%;
  left: 0;
  pointer-events: none;
  opacity: 0.5;
}
</style>
