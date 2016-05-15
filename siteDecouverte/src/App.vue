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
import Keywords from './components/Keywords'
import Authors from './components/Authors'
import Characters from './components/Characters'

export default {
  components: {
    Responsive,
    MainNav,
    Home,
    Credits,
    Summary,
    Keywords,
    Authors,
    Characters
  }
}
</script>

<style lang="sass">
$hover: .2s all linear
$raleway: 'Raileway', Helvetica, Arial, sans-serif

@font-face
  font-family: 'times'
  src: url(~assets/fonts/times/Times-Roman.ttf)

html
  height: 100%

body
  display: flex
  height: 100%
  
  &::-webkit-scrollbar
    display: none
  
#app
  width: 100%
  height: 100%    
  padding: 19px 17px
  
  >div
    width: 100%
    height: 100%
      
.navbar-default
  background: none
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
  position: absolute
  top: 50%
  left: 50%
  transform: translate3d(-50%, -50%, 0)
  font-family: $raleway
  opacity: .04
  z-index: -1

  h1     
    text-transform: uppercase
    font-size: 100px
    font-weight: 800
          
.page-subtitle-container
  display: flex
  align-items: center
  margin: 5% 0 5%
  
  .dash
    width: 24px
    height: 2px
    margin-right: 100px
    
  h2
    display: inline-block
    font-size: 30px
    font-style: italic
  
</style>
