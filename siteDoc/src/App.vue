<template>
  <div id="app" class="container-fluid">
  
    <app-header></app-header>    
    <router-view></router-view>
    <app-footer></app-footer>
    
  </div>
</template>

<script>
import Vue from 'vue'
import AppHeader from './components/app-header.vue'
import AppFooter from './components/app-footer.vue'
import Home from './components/home.vue'
import Doc from './components/doc.vue'
import DocContent from './components/doc-content.vue'

export default {
    
  name: 'app',
  components: {
    AppHeader,
    AppFooter,
    Home,
    Doc,
    DocContent
  }
}
</script>

<style lang="sass">

body
  font-family: 'Source Sans Pro', sans-serif
  overflow-x: hidden

</style>