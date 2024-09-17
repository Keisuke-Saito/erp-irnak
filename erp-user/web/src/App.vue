<template>
  <ErrorBoundary id="app">
    <router-view />
  </ErrorBoundary>
</template>

<script>
import ErrorBoundary from '@/ErrorBoundary.vue'
export default {
  name: 'App',

  components: {
    ErrorBoundary
  }
}
</script>

<style>
html, body {
  margin: 0;
  padding: 0;
  width: 100%;
  min-height: 100vh;
}
#app {
  /* font-family: 'Avenir', Helvetica, Arial, sans-serif; */
  /* color: #2c3e50; */
  min-height: 100vh;
  /* background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%); */
  background-repeat: no-repeat;
  font-family: 'M PLUS Rounded 1c', sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-font-smoothing: antialiased;
  -ms-font-smoothing: antialiased;
  -o-font-smoothing: antialiased;
  letter-spacing: 0.1em;
  line-height: 1.5em;
  color: #323232;
}
* {
  box-sizing: border-box;
}
li {
  list-style: none;
}
</style>
