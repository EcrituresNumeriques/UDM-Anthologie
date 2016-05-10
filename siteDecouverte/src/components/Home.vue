<template>
  <div class="home">
        <div class="col-md-6 col-md-offset-1 left-column">
            <nav class="navbar navbar-default">
                <ul class="nav">
                    <li><a href="#"><span class="dash"></span>Mélé / Contraste<sup>I</sup></a></li>
                    <li><a href="#"><span class="dash"></span>Méléagre in love<sup>II</sup></a></li>
                    <li><a href="#"><span class="dash"></span>La Couronne de Méléagre<sup>III</sup></a></li>
                    <li><a href="#"><span class="dash"></span>L'Anthologie de Méléane<sup>IV</sup></a></li>
                    <li><a href="#"><span class="dash"></span>Agis de Méléi<sup>V</sup></a></li>
                    <li><a href="#"><span class="dash"></span>Lettre à Méléag l'Égyptien<sup>VI</sup></a></li>
                    <li><a href="#"><span class="dash"></span>Le Thème de Méléagren<sup>VII</sup></a></li>
                </ul>
            </nav>
            <div class="title-container">
                <span class="dash"></span>
                <h1>L’Anthologie<br> Palatine & découverte.</h1>
            </div>
        </div>
        <div class="col-md-5 right-column">
            <img src="~assets/img/img.png">
        </div>
        <div class="clearfix">
  </div>
</template>

<script>
import MainNav from './MainNav'

export default {
  components: {
    MainNav
  },
  name: 'home',
  data () {
    return {
      msg: 'accueil'
    }
  }
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
  
.right-column
  align-items: center
  justify-content: flex-end
  padding-right: 0
  
  img
    height: 100%
  
.dash
  background: #000
  display: inline-block
  vertical-align: middle  
  
.nav>li>a
  display: flex
  
ul
  li
    a
      font-size: 20px
      color: rgba(0, 0, 0, 0.5)
      align-items: center
      transition: $hover
      padding-left: 0!important
      
      .dash
        width: 0
        height: 1px
        margin-right: 0
        transition: $hover
        
      sup
        font-weight: bold
        font-size: 9px
        padding: 0 5px
      
      &:hover,
      &:focus
        opacity: 1
        color: #000
        
        .dash
          width: 20px
          margin-right: 20px
          
.title-container
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