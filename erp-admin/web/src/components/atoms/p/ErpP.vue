<template>
  <p
    v-if="boolean"
    :class="className"
  >
    <slot />
  </p>
</template>

<script>
export default {
  name: 'ErpP',
  props: {
    boolean: { type: Boolean, default: true },
    className: { type: String, default: 'default' }
  }
}
</script>

<style scoped lang="scss">
.default {
  color: #333;
}
.login {
  font-size: 0.7em;
  // color: #333333;
}
.parts-ttl {
  color: #333;
  line-height: 30px;
  display: block;
  height: 30px;
  margin: 0;
  margin-right: 10px;
}
.form-ttl {
  font-weight: bold;
  margin: 0;
  border-bottom: 1px solid #000;
  padding-bottom: 5px;
}
</style>
