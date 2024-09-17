<template>
  <h1>{{ value }}</h1>
</template>

<script>
export default {
  name: 'ErpSimpleH2',
  props: {
    value: { type: String, required: true }
  }
}
</script>

<style scoped lang="scss">
h1 {
  font-size: 25px;
  letter-spacing:1px;
  text-align:center;
}
</style>
