<template>
  <div class="menu-body">
    <ul>
      <li :class="{ active: $route.path === '/' }">
        <router-link :to="{ name: 'top' }">
          <i class="fas fa-home" />ホーム
        </router-link>
      </li>
      <li :class="{ active: $route.path.match(/\/profile/) }">
        <router-link :to="{ name: 'profile' }">
          <i class="fas fa-id-badge" />プロフィール
        </router-link>
      </li>
      <li :class="{ active: $route.path.match(/\/fare/) }">
        <router-link :to="{ name: 'applyFare' }">
          <i class="fas fa-calculator" />交通費申請
        </router-link>
      </li>
    </ul>
  </div>
</template>

<script>

export default {
  name: 'ErpSidebar'
}
</script>

<style scoped lang="scss">
.menu-body {
  background-color: #333;
  width: 100%;
  height: 100%;
  margin: 0;
  color: #ddd;
}
h1{
  margin: 0;
  padding: 0;
  width:160px;
  text-shadow: 0 0 10px rgba(0,0,0,0.3);
  letter-spacing:1px;
  text-align:center;
  line-height: 60px;
}
a {
  display: block;
  width: 100%;
  border: none;
  text-decoration: none;
  font-weight: bold;
  font-size: 14px;
  color: rgb(143, 139, 139);
}
a:hover {
  color: #fff;
}
ul {
  // list-style: none;
  margin: 0;
  padding: 0;
}
li {
  box-sizing: border-box;
  width: 100%;
  height: 40px;
  padding: 0 10px;
  line-height: 40px;
  background-color: #555;
}
li + li {
  border-top: 1px solid #333;
}
.active a {
  color: #fff;
}
.active li {
  background-color: #fff;
}
.fas {
  margin-right: 5px;
  display: inline-block;
}
</style>
