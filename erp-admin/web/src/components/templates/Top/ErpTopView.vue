<template>
  <div>
    <ErpH1 class-name="underline">
      お知らせ
    </ErpH1>
    <ErpP>2020/12/07：アプリリリース</ErpP>
  </div>
</template>

<script>
import ErpH1 from '@/components/atoms/h/ErpH1.vue'
import ErpP from '@/components/atoms/p/ErpP.vue'

export default {
  name: 'ErpTopView',
  components: {
    ErpH1,
    ErpP
  }
}
</script>

<style scoped lang="scss">
</style>
