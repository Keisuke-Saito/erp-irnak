<template>
  <div :class="classes">
    <div class="last">
      <ErpButton
        @click="handleClick(-1)"
      >
        &lt;&lt; 前{{ name }}
      </ErpButton>
    </div>
    <div class="next">
      <ErpButton
        @click="handleClick(1)"
      >
        次{{ name }} &gt;&gt;
      </ErpButton>
    </div>
  </div>
</template>

<script>
import ErpButton from '@/components/atoms/button/ErpButton.vue'

export default {
  name: 'ErpLastNext',
  components: {
    ErpButton
  },
  props: {
    type: { type: String, default: '' }
  },
  computed: {
    name () {
      const type = this.type ? this.type : ''
      switch (type) {
        case 'profile':
          return ''
        case 'month':
          return '月'
        default:
          return ''
      }
    },
    classes () {
      const cls = this.type ? this.type : ''
      switch (cls) {
        case 'profile':
          return ['period-change-profile']
        case 'month':
          return ['period-change']
        default:
          return ['period-change']
      }
    }
  },
  methods: {
    handleClick (value) { this.$emit('search', value) }
  }
}
</script>

<style scoped lang="scss">
.period-change {
  position: absolute;
  width: 320px;
  top: 0;
}
.period-change-profile {
  position: absolute;
  width: 420px;
  top: 0;
}
.last {
  position: absolute;
  left: 0;
}
.next {
  position: absolute;
  right: 0;
}
</style>
