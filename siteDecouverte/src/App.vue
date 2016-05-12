<template>
  <div id="app" class="container-fluid">
    <div class="hidden-xs hidden-sm">
      <main-nav></main-nav>
      <router-view></router-view>
    </div>
    <div class="hidden-md hidden-lg">
      <responsive></responsive>
    </div>
  </div>
</template>

<script>
import Responsive from './components/Responsive'
import MainNav from './components/MainNav'
import Home from './components/Home'
import Credits from './components/Credits'

export default {
  components: {
    Responsive,
    MainNav,
    Home,
    Credits
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
  padding: 19px 17px
  
  >div
    width: 100%
    height: 100%
      
.navbar-default
  background: #fff
  border: none
  
</style>
