<template>
  <button
    :class="classes"
    :disabled="disabled"
    type="button"
    @click="handleClick"
  >
    <slot />
  </button>
</template>

<script>
export default {
  name: 'ErpButton',
  props: {
    type: { type: String, default: '' },
    disabled: { type: Boolean, default: false }
  },
  computed: {
    classes () {
      const cls = this.type ? this.type : ''
      switch (cls) {
        case 'blue':
          return ['erp-button', 'erp-button-blue']
        case 'red':
          return ['erp-button', 'erp-button-red']
        case 'login':
          return ['erp-button', 'erp-button-login']
        case 'logout':
          return ['erp-button', 'erp-button-red', 'erp-button-logout']
        default:
          return ['erp-button']
      }
    }
  },
  methods: {
    handleClick (ev) { this.$emit('click', ev) }
  }
}
</script>

<style scoped lang="scss">
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
.erp-button-login {
  width: 100%;
  padding: 0.5em 1em;
  margin-top: 20px;
  // color: #FFF;
  // transform: translateY(4px);
  // background-image: linear-gradient(#FF4F02 0%, #FF9872 100%);
  // box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.29);
  // border-bottom: solid 3px #FF4F02;
  box-shadow: none;
  color: #fff;
  background-color: rgba(0,0,0,0.5);
  transition: .2s all ease;
}
.erp-button-login:disabled {
  // background-image: linear-gradient(#D3D3D3 0%, #FF9872 100%);
  background-color: rgba(0,0,0,0.2);
}
.erp-button-logout {
  width: 100%;
  padding: 0.5em 1em;
  color: #FFF;
  /* background-image: linear-gradient(#990000 0%, #FF1493 100%); */
  background: #1E488D;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.29);
  font-weight: bold;
  /* border-bottom: solid 3px #990000; */
}
.erp-button-logout:hover {
  /* background-image: linear-gradient(#FF1493 0%, #990000 100%); */
  /* border-bottom: solid 3px #FF1493; */
  transition: 0.3s;
}
.erp-button-text {
  border: none;
  text-decoration: none;
  font-weight: bold;
  font-size: 20px;
  color: #FF4F02;
  text-shadow: 0 4px 2px rgba(0, 0, 0, 0.32), 0 1px 0 #FF9872, 0 3px 0 #D3D3D3;
}
.erp-button-text:disabled,
.erp-button-text:disabled:hover {
  color: #777;
  text-shadow: none;
}
.erp-button-text:hover {
  text-shadow: 4px 4px 2px rgba(0, 0, 0, 0.32), 0 1px 0 #FF9872, 0 3px 0 #D3D3D3;
  transition: 0.3s;
}
</style>
