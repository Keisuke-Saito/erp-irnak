<template>
  <div class="main-view">
    <div class="content">
      <header class="header">
        <ErpNavigation />
      </header>
      <article class="main">
        <div class="inner">
          <Router-view />
        </div>
      </article>
    </div>

    <ErpPopUpMessages />
  </div>
</template>

<script>
import store from '@/store'
import ErpPopUpMessages from '@/components/molecules/popup/ErpPopUpMessages.vue'
import ErpNavigation from '@/components/organisms/common/ErpNavigation.vue'

export default {
  name: 'ErpMainView',
  components: {
    ErpPopUpMessages,
    ErpNavigation
  },
  async beforeRouteEnter (to, from, next) {
    // マスタ情報
    const messageId = store.dispatch('message/info', { message: 'マスタ情報読み込み中...' })
    await store.dispatch('common/fetchMst')
      .catch(err => {
        store.dispatch('message/delete', messageId)
        store.messageError({ message: store.throwError(err).detail.message })
      })
    store.dispatch('message/delete', messageId)
    next()
  }
}
</script>

<style scoped lang="scss">
.content {
  width: 100%;
  min-height: 100vh;
}
.header {
  width: 100%;
  height: 60px;
  position: fixed;
  z-index: 1000;
}
.main {
  padding-top: 60px;
}
.inner {
  margin: 10px auto;
  width: 95%;
}
</style>
