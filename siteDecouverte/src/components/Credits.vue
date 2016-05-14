<template>
  <div id="credits">
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
        <div class="back-container">
          <a href="#" class="back"><span class="bg"></span>Retour</a>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-md-offset-1">
        <div class="desc-container">
          <h3>Un projet collaboratif</h3>
          <q><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vitae mi venenatis, tempus erat non, scelerisque odio. Morbi ultricies felis ut quam pretium, at sodales lacus posuere. Aenean feugiat tincidunt magna id lacinia. Morbi consequat, magna in dapibus porttitor, augue metus pulvinar.</p></q>
        </div>
      </div>
      <div class="col-md-6 col-md-offset-2">
        <div class="team-container">
          <h4><span class="bg"></span>Notre équipe <sup>V</sup></h4>
          <ul>
            <li>Miléna Tarrière : Chef de Projet</li>
            <li>Nahel Moussi : UX/UI Designer</li>
            <li>Raphaël Aupée : Développeur Back</li>
            <li>Paul Chagnon : UX/UI Designer</li>
            <li>Valentin Crochemore : Développeur Front</li>  
          </li>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
        <div class="title-container">
            <span class="dash"></span>
            <h1>L’Université de<br> Montréal & Hétic.</h1>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'

export default {
  components: {
  },
  name: 'credits'
}

$(document).ready(function () {
  $('body').on('click', '.back', function (e) {
    e.preventDefault()
    window.history.back()
  })
})

</script>

<style lang="sass">  
$hover: .2s all linear
$raleway: 'Raileway', Helvetica, Arial, sans-serif

#credits
  width: 100%
  height: 100%
  display: flex
  flex-direction: column
  justify-content: flex-end
  
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

.back-container
  margin-bottom: 50px

  .back
    font-family: $raleway
    font-weight: 600
    font-size: 12px
    color: #5c5c5c
    transition: $hover
    position: relative
  
    &:hover,
    &:focus
      color: #000
      text-decoration: none
    
      span
        width: 100%
    
.desc-container
  color: #2c2c2c
  margin-top: 40px
  margin-bottom: 150px
  
  h3
    font-style: italic
    font-size: 18px
    padding-left: 100px
    margin-top: 0
    
  q
    font-size: 14px
    line-height: 1.5em;
    margin-top: 80px
    display: inline-block
    quotes: "\201C""\201D""\2018""\2019"
    
    &:before
      font-size: 30px
      margin-bottom: -15px
      vertical-align: bottom
      display: inline-block
    
    &:after
      content: no-close-quote
      
    p
     padding-left: 20px
     
.team-container
  h4
    font-size: 10px
    font-weight: 700
    color: rgba(44, 44, 44, 0.5)
    font-family: $raleway
    position: relative
    margin-top: 0
    
    
    
    sup
      font-size: 8px
      color: #2c2c2c
      font-family: initial
      padding-left: 5px
      
  ul
    list-style: none    
    padding-left: 20px
    margin-top: 30px
    
    li
      font-size: 12px
      color: #000
      line-height: 2em
    
</style>
