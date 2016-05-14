<template>
    <div class="back-btn">
        <div class="back-container">
          <a href="#" class="back"><span class="bg"></span>Retour</a>
        </div>
    </div>
</template>

<script>
import $ from 'jquery'

$(document).ready(function () {
  $('body').on('click', '.back', function (e) {
    e.preventDefault()
    window.history.back()
  })
})

</script>

<style lang="sass" scoped>
$hover: .2s all linear
$raleway: 'Raileway', Helvetica, Arial, sans-serif

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
</style>