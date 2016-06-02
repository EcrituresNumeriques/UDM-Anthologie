<template>
  <span class="scroll-progress-bar">
    <span class="scroll-dot active"></span>
    <span class="scroll-dot"></span>
    <span class="scroll-dot"></span>
    <span class="scroll-dot"></span>
    <span class="scroll-dot"></span>
    <span class="scroll-dot"></span>
    <span class="scroll-dot"></span>
    <span class="scroll-dot"></span>
    <span class="scroll-dot"></span>
    <span class="scroll-dot"></span>
  </span>
</template>

<script>
import $ from 'jquery'

export default {
  name: 'ScrollProgressBar',
  ready: function () {
    this.onScrollProgressBar()
  },
  methods: {
    onScrollProgressBar: function () {
      var self = this
      $('.scroll').scroll(function () {
        self.scrollProgressBar()
      })
    },
    scrollProgressBar: function () {
      var max = $('.scroll')[0].scrollWidth - $('.scroll').width()
      var value = $('.scroll').scrollLeft()
      var percentage = value / max * 100
      var dotIndex = Math.ceil(percentage / 10) - 1
      if (dotIndex < 1) dotIndex = 0
      console.log(dotIndex)
      var dot = $('.scroll').find('.scroll-dot')
      dot.eq(dotIndex).addClass('active')
      dot.eq(dotIndex).prevAll().addClass('active')
      dot.eq(dotIndex).nextAll().removeClass('active')
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .2s all linear

.scroll-progress-bar
  position: fixed
  right: 300px
  top: 44px
  display: inline-block

  .scroll-dot
    width: 4px
    height: 4px
    border-radius: 50%
    display: inline-block
    background: #d4d4d4
    opacity: .5
    margin: 0 10px
    transition: $hover

    &.active
      background: #2c2c2c
      opacity: 1
</style>
