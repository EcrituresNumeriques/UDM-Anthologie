<template>
  <div class="home">
    <div class="row">
        <div class="col-md-6 col-md-offset-1 left-column">
            <discover-nav></discover-nav>
            <div class="page-subtitle-container">
                <span class="dash"></span>
                <h2>L’Anthologie<br> Palatine & découverte.</h2>
            </div>
        </div>
        <div class="col-md-5 right-column">
            <img src="~assets/img/img.png">
        </div>
     </div>
  </div>
</template>

<script>
import MainNav from './MainNav'
import DiscoverNav from './DiscoverNav'

export default {
  components: {
    MainNav,
    DiscoverNav
  },
  name: 'home'
}
</script>

<style lang="sass">
$hover: .2s all linear

.home
  height: 100%
  width: 100%
  
  >.row
    height: 100%

.left-column,
.right-column
  display: inline-flex
  height: 100%
  
.left-column
  flex-direction: column
  justify-content: flex-end
  padding-right: 0
  
.right-column
  align-items: center
  justify-content: flex-end
  padding: 0 17px 0 0
  
  img
    height: 100%
</style>