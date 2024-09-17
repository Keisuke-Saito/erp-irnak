<template>
  <div
    v-if="errors"
    class="error"
  >
    <p
      v-for="(value, index) in errors"
      :key="index"
    >
      {{ value[0] }}
    </p>
  </div>
</template>

<script>
export default {
  name: 'ErpError',
  props: {
    errors: { type: Object, required: true }
  }
}
</script>

<style scoped lang="scss">
.error {
  color: red;
  margin: -15px auto;
  width: 80%;
}
.error p {
  font-size: 14px;
  line-height: 1;
  word-wrap: break-word;
  margin: 0 20px;
}
</style>
