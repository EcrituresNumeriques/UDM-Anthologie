<template>
    <div class="app-footer">
        <div class="hidden-xs hidden-sm row">
            <nav class="navbar">
                <div class="navbar-header col-md-3">
                    <a class="navbar-brand" v-link="{ path : '/home' }">Anthologie palatine</a>     
                </div>
                <ul class="nav navbar-nav list-inline">
                    <li><a v-link="{ path: '/home' }" v-link-active>Accueil</a></li>
                    <li><a v-link="{ path: '/documentation' }">Documentation</a></li>
                    <li><a href="#">Accès API</a></li>
                    <li><a href="#">Exemple</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right list-inline social">
                    <li><a target="_blank" href="http://twitter.com"><i class="fa fa-twitter"></i></a></li>
                    <li><a target="_blank" href="http://facebook.com"><i class="fa fa-facebook"></i></a></li>
                    <li><a target="_blank" href="http://github.com"><i class="fa fa-github"></i></a></li>
                </ul>
            </nav>
        </div>
        <div class="row copyright">
            <div class="col-md-9 col-md-offset-3">
                <p>Créé par des étudiants de HETIC</p>
                <p>Copyright &copy; université de Montréal</p>
            </div>
        </div>
    </div>
</template>

<style lang="sass">
$default-color: #366870;

.app-footer
  border-top: 1px solid $default-color
  padding-bottom: 50px
  margin: 0 -15px
  background: #fff
  
  >.row
    &:first-child
      padding-top: 30px
      
  .navbar-header
    padding-left: 50px
    
    .navbar-brand
      color: $default-color
      font-weight: 700
      transition: .2 all linear
      font-size: 28px
      
      &:hover,
      &:focus
        text-decoration: none
        opacity: .8
        
  ul
    li
      a
        opacity: 0.5
        font-size: 24px
        color: #000
        transition: .2s all linear
        
        &:hover,
        &:focus,
        &.v-link-active
          opacity: 1
          color: $default-color
          text-decoration: none
          
    &.social
      a
        opacity: 1
        margin: 0 5px
        
        i.fa
          color: #000
          
        &:hover,
        &:focus
          opacity: .5
          
          
  .copyright
    margin: 5% 0 0
    padding-left: 5%
    
    p
      color: rgba(0, 0, 0, .5)
      font-size: 14px
      margin: 0
      
  @media (min-width: 992px)
    .social
      margin: 0
    
    .copyright
      margin: 2% 0 0
      padding: 0
      
      >div
        padding: 25px
        
</style>