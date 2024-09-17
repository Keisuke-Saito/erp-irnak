<template>
  <div
    v-show="popup"
    class="overlay"
    @click="cancel"
  >
    <div class="item">
      <slot />
    </div>
  </div>
</template>
<script>
export default {
  name: 'ErpOverlay',
  props: {
    popup: { type: Boolean, default: false }
  },
  methods: {
    cancel () { this.$emit('cansel') }
  }
}
</script>

<style scoped lang="scss">
.overlay{
  z-index:10;
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background-color:rgba(0,0,0,0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: overlay;
}
.item {
  max-width: 80%;
  max-height: 80%;
}
</style>
