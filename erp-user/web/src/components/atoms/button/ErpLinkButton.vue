<template>
  <router-link
    :class="classes"
    :to="to"
  >
    {{ name }}
  </router-link>
</template>

<script>
export default {
  name: 'ErpLinkButton',
  props: {
    to: { type: Object, required: true },
    name: { type: String, default: '' },
    type: { type: String, default: '' }
  },
  computed: {
    classes () {
      const cls = this.type ? this.type : ''
      switch (cls) {
        case 'blue' : return ['erp-button', 'erp-button-blue']
        case 'red' : return ['erp-button', 'erp-button-red']
        default:
          return ['erp-link']
      }
    }
  }
}
</script>

<style scoped lang="scss">
.erp-link {
  padding: 0.5em;
  text-decoration: none;
}
.erp-link:hover {
  cursor: pointer;
}
.erp-link a {
  text-decoration: none;
}
.erp-link:disabled {
  background-color: rgba(0,0,0,0.2);
}
.erp-button {
  padding: 0.5em;
  display: inline-block;
  text-decoration: none;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.29);
  border-radius: 4px;
}
.erp-button:hover {
  cursor: pointer;
}
.erp-button a {
  text-decoration: none;
}
.erp-button:disabled {
  background-color: rgba(0,0,0,0.2);
  cursor: none;
}
.erp-button-blue {
  background-image: linear-gradient(#3333FF 0%, #0033FF 100%);
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.29);
  color: #FFFFFF;
}
.erp-button-red {
  background-image: linear-gradient(#990000 0%, #FF1493 100%);
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.29);
  color: #FFFFFF;
}
</style>
