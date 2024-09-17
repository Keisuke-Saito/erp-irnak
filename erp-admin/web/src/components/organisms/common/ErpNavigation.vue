<template>
  <nav class="navigation">
    <div class="title">
      <h1>イルナック</h1>
    </div>
    <div class="menu-body">
      <ul>
        <li :class="{ active: $route.path === '' }">
          <router-link :to="{ name: 'top' }">
            <i class="fas fa-home">ホーム</i>
          </router-link>
        </li>
        <li :class="{ active: $route.path.match(/\/employee/) }">
          <router-link :to="{ name: 'employee' }">
            <i class="fas fa-user" />スタッフ
          </router-link>
        </li>
        <li :class="{ active: $route.path.match(/\/fare/) }">
          <router-link :to="{ name: 'fare' }">
            <i class="fas fa-calculator" />交通費
          </router-link>
        </li>
      </ul>
    </div>
    <div class="actions">
      <ErpButton
        type="logout"
        @click="logout"
      >
        ログアウト
      </ErpButton>
    </div>
  </nav>
</template>

<script>
import ErpButton from '@/components/atoms/button/ErpButton.vue'

export default {
  name: 'ErpNavigation',
  components: {
    ErpButton
  },
  methods: {
    logout () {
      this.$store.dispatch('auth/logout')
      this.$router.push({ name: 'login' })
    }
  }
}
</script>

<style scoped lang="scss">
.navigation {
  display: flex;
  width: 100%;
  height:100%;
  // font-family: sans-serif;
  background: #f0f0f0;
  position: relative;
}
.title {
  width:280px;
  margin-left: 50px;
}
.title h1 {
  margin: 0;
  /* width:250px; */
  text-align: left;
  height:100%;
  // color: #fff;
  // text-shadow: 0 0 10px rgba(0,0,0,0.3);
  letter-spacing:1px;
  line-height: 60px;
}

.actions {
  position: absolute;
  right: 15px;
  margin: 5px 20px;
  padding: 5px;
  display: flex;
  font-weight: bold;
  justify-content: center;
  align-items: center;
}

.menu-body{
  flex-grow: 1;
}
.menu-body ul {
  display: flex;
  margin: 5px 0;
  padding: 0;
  text-align: center;
}
.menu-body ul li {
  // display: table-cell;
  min-width: 150px;
  // border-right: 1px solid #333333;
}
.menu-body ul li:first-child {
  // border-left: 1px solid #333333;
}
.menu-body ul li a {
  display: block;
  width: 100%;
  padding: 10px 0;
  text-decoration: none;
  // color: #fff;
  transition: .6s;
  // opacity: .6;÷
}
.menu-body ul li a:hover {
  font-weight: bold;
  // opacity: 1;
  // border-bottom: 5px solid #fff;
}
.menu-body ul li.active {
  font-weight: bold;
}
.menu-body ul li.active a {
  opacity: 1;
  // border-bottom: 5px solid #fff;
}
.menu-body ul li.active a:hover {
  // border-bottom: 5px solid #FF4F02;
  // color: #FFFFFF;
}
.fas {
  margin-right: 5px;
}
</style>
