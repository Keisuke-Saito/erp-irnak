<template>
  <div class="select-group">
    <select
      v-model="request"
      class="select-tag"
      @change="updateValue"
    >
      <option
        v-for="(option, index) in params"
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
    params: { type: [Object, Array], required: true }
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
  &:focus {
    box-shadow: inset 0 -5px 45px rgba(100,100,100,0.3), 0 1px 1px rgba(255,255,255,0.2);
  }
}
</style>
