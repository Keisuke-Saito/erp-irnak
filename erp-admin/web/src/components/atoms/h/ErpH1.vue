<template>
  <h1 :class="className">
    <slot />
  </h1>
</template>

<script>
export default {
  name: 'ErpH1',
  props: {
    className: { type: String, default: '' }
  }
}
</script>

<style scoped lang="scss">
.login {
  color: #333333;
  text-shadow: 0 0 10px rgba(0,0,0,0.3);
  letter-spacing:1px; text-align:center;
}
.underline {
    border-bottom: 1px solid #323232;
    padding-bottom: 5px;
}
</style>
