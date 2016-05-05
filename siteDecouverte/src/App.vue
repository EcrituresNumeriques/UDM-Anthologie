<template>
  <div id="app" class="container-fluid">
    <router-view></router-view>
  </div>
</template>

<script>
import Home from './components/Home'

export default {
  components: {
    Home
  }
}
</script>

<style lang="sass">
@font-face
  font-family: 'times'
  src: url(~assets/fonts/times/Times-Roman.ttf)

html
  height: 100%

body
  display: flex
  height: 100%
  font-family: 'times', Helvetica, Arial, sans-serif
  
#app
  width: 100%
  height: 100%    
</style>
