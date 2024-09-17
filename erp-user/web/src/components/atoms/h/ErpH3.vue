<template>
  <h3 :class="className">
    <slot />
  </h3>
</template>

<script>
export default {
  name: 'ErpH3',
  props: {
    className: { type: String, default: '' }
  }
}
</script>

<style scoped lang="scss">
.underline {
    border-bottom: 1px solid #323232;
    padding-bottom: 5px;
}
</style>
