<template>
  <div>
    <ErpH1 value="お知らせ" />
    <ul>
      <li>
        2020/12/22：
        <a
          href="https://docs.google.com/presentation/d/1FEoTsLNHdxIW5QLhD8BqtMjQXIgggy__8oOwuSm0NTU/edit#slide=id.ga8010b1299_0_5"
          target="_blank"
          rel="noopener"
        >
          操作マニュアル
        </a>
        の公開
      </li>
      <li>2020/12/07：アプリリリース</li>
    </ul>
  </div>
</template>

<script>
import ErpH1 from '@/components/atoms/h/ErpH1.vue'

export default {
  name: 'ErpTopView',
  components: {
    ErpH1
  }
}
</script>

<style scoped lang="scss">
a {
  color: #2c3e50;
}

li + li {
  margin-top: 10px;
}
</style>
