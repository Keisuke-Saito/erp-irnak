<template>
  <h1>{{ value }}</h1>
</template>

<script>
export default {
  name: 'ErpH1',
  props: {
    value: { type: String, required: true }
  }
}
</script>

<style scoped lang="scss">
h1 {
  position: relative;
  font-size: 28px;
  /* padding: 0.25em 20px; */
}
h1:after {
  content: "";
  display: block;
  height: 4px;
  /* background: linear-gradient(to right, #FF4F02, #3300FF); */
}
</style>
