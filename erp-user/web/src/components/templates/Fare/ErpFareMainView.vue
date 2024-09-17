<template>
  <div>
    <!-- <ErpLinkButton
      :to="{
        name: 'applyFare'
      }"
      name="交通費の申請"
    /> -->
    <router-view />
  </div>
</template>

<script>
// import ErpLinkButton from '@/components/atoms/button/ErpLinkButton.vue'

export default {
  name: 'ErpFareMainView',
  components: {
    // ErpLinkButton
  }
}
</script>

<style scoped lang="scss">
</style>
