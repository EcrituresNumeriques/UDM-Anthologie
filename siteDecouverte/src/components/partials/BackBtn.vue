<template>
    <div class="back-btn">
        <div class="inner-links">
          <a @click="onBackClick" href="#" class="back">
            <span class="dash"></span>
            Retour
          </a>
        </div>
    </div>
</template>

<script>
export default {
  methods: {
    onBackClick: function (e) {
      e.preventDefault()
      window.history.back()
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .5s all linear
$raleway: 'Raleway', Helvetica, Arial, sans-serif

.back-btn
  position: absolute
  top: 140px
  z-index: 2

</style>
