<template>
    <div class="discover-nav">
        <nav class="navbar navbar-default">
            <ul class="nav">
                <li><a href="#"><span class="dash"></span>Mélé / Contraste<sup>I</sup></a></li>
                <li><a v-link="{ name: 'summary', params: { theme: 'maleagre-in-love' }}"><span class="dash"></span>Méléagre in love<sup>II</sup></a></li>
                <li><a href="#"><span class="dash"></span>La Couronne de Méléagre<sup>III</sup></a></li>
                <li><a href="#"><span class="dash"></span>L'Anthologie de Méléane<sup>IV</sup></a></li>
                <li><a href="#"><span class="dash"></span>Agis de Méléi<sup>V</sup></a></li>
                <li><a href="#"><span class="dash"></span>Lettre à Méléag l'Égyptien<sup>VI</sup></a></li>
                <li><a href="#"><span class="dash"></span>Le Thème de Méléagren<sup>VII</sup></a></li>
            </ul>
        </nav>
    </div>
</template>

<style lang="sass" scoped>
$hover: .2s all linear

.discover-nav
  margin-top: 150px

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
      &:focus,
      &.v-link-active
        opacity: 1
        color: #000
        
        .dash
          width: 20px
          margin-right: 20px
</style>