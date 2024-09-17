<template>
  <div class="main-view">
    <div class="content">
      <header class="header">
        <ErpNavigation />
      </header>
      <nav class="sidebar">
        <ErpSidebar />
      </nav>
      <article class="main">
        <div class="inner">
          <router-view />
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
import ErpSidebar from '@/components/organisms/common/ErpSidebar.vue'

export default {
  name: 'ErpMainView',
  components: {
    ErpPopUpMessages,
    ErpNavigation,
    ErpSidebar
  },
  async beforeRouteEnter (to, from, next) {
    // マスタ情報
    await store.dispatch('common/fetchMst')
      .catch(err => { return Promise.reject(err) })
    // マスタ情報
    await store.dispatch('auth/fetchProfile')
      .catch(err => { return Promise.reject(err) })
    next()
  }
}
</script>

<style scoped lang="scss">
  .content {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  .header {
    width: 100%;
    height: 60px;
    position: fixed;
    z-index: 1;
    order: 1;
  }
  .sidebar {
    width: 100%;
    order: 3;
  }
  .main {
    padding-top: 60px;
    flex-grow: 1;
    order: 2;
  }
  .inner {
    margin: 10px auto;
    width: 95%;
  }

  @media screen and (min-width: 760px)
  {
    .content {
      flex-direction: row;
      align-items: stretch;
      order: 1;
    }
    .sidebar {
      /* width: 160px; */
      flex-basis: 10%;
      padding-top: 60px;
      order: 2;
    }
    .main {
      flex-basis: 90%;
      flex-grow: 1;
      order: 3;
    }
  }
</style>
