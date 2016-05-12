<template>
  <div id="credits">
    <h1>Crédits</h1>
    <a href="#" class="back">Retour</a>
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
  $('.back').click(function (e) {
    $('#credits').css('background', 'red')
    e.preventDefault()
    window.history.back()
  })
})

</script>

<style lang="sass">  
</style>
