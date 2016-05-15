<template>
  <div id="credits">
    <div class="page-title-container">
      <h1>Crédits</h1>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
        <back-btn></back-btn>
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
        <div class="page-subtitle-container">
            <span class="dash"></span>
            <h2>L’Université de<br> Montréal & Hétic.</h2>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BackBtn from './BackBtn'

export default {
  components: {
    BackBtn
  },
  name: 'credits'
}

</script>

<style lang="sass" scoped>  
$hover: .2s all linear
$raleway: 'Raileway', Helvetica, Arial, sans-serif

#credits
  width: 100%
  height: 100%
  display: flex
  flex-direction: column
  justify-content: flex-end
    
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
    text-transform: uppercase
    
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
