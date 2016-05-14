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
import Summary from './components/Summary'

export default {
  components: {
    Responsive,
    MainNav,
    Home,
    Credits,
    Summary
  }
}
</script>

<style lang="sass">
$hover: .2s all linear

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
  
span.bg
  width: 20px
  height: 20px
  background: #e4e4e4
  position: absolute
  left: 0
  top: 50%
  transform: translateY(-50%)
  z-index: -1
  transition: $hover

.dash
  background: #000
  display: inline-block
  vertical-align: middle  
          
.page-title-container
  display: flex
  align-items: center
  margin: 5% 0 5%
  
  .dash
    width: 24px
    height: 2px
    margin-right: 100px
    
  h1
    display: inline-block
    font-size: 30px
    font-style: italic
  
</style>
