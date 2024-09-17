<template>
  <img
    :class="classes"
    :src="srcPath"
    @click="handleClick"
  />
</template>

<script>
export default {
  name: 'ErpImageClick',
  props: {
    type: { type: String, default: 'img' },
    filePath: { type: String, default: '' },
    fetchImg: { type: String, required: true }
  },
  data () {
    return {
      srcPath: ''
    }
  },
  computed: {
    classes () {
      const cls = this.type !== 'img' ? ('-' + this.type) : ''
      return [`erp${cls}`]
    }
  },
  watch: {
    filePath (val, oldVal) {
      if (typeof (this.filePath) === 'string') this.createImg(this.filePath)
    }
  },
  created () {
    this.createImg()
  },
  methods: {
    // 画像取得
    async createImg () {
      const result = await this.fetchImageData({ type: this.fetchImg, filePath: this.filePath })
      this.srcPath = result.data
    },
    handleClick () { this.$emit('click') }
  }
}
</script>

<style scoped lang="scss">
img:hover {cursor: pointer;}

.erp-receipt-img {
  max-height: 60px;
}
.erp-popup-receipt-img {
  width: 400px;
}
.erp-input-item-img {
  margin-left: 20px;
  margin-bottom: 15px;
  width: 200px;
  height: 160px;
}
</style>
