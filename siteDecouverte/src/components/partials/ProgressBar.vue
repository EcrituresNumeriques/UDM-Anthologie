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
  <span class="scroll-arrows">
    <span @click="onScrollLeftArrowClick" class="glyphicon glyphicon-chevron-left"></span>
    <span @click="onScrollRightArrowClick" class="glyphicon glyphicon-chevron-right"></span>
  </span>
</template>

<script>
import $ from 'jquery'

export default {
  name: 'ScrollProgressBar',
  ready: function () {
    this.onScrollProgressBar()
    this.onDotClick()
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
      var dotIndex = Math.ceil(percentage / 10)
      if (dotIndex < 1) dotIndex = 0
      var dot = $('.scroll').find('.scroll-dot')
      dot.eq(dotIndex).addClass('active')
      dot.eq(dotIndex).prevAll().addClass('active')
      dot.eq(dotIndex).nextAll().removeClass('active')
    },
    onDotClick: function () {
      $('body').on('click', '.scroll-dot', function () {
        $(this).addClass('active')
        var thisIndex = $(this).index()
        var percentage = thisIndex + '0'
        var max = $('.scroll')[0].scrollWidth - $('.scroll').width()
        var value = percentage * max / 100
        $('.scroll').animate({
          scrollLeft: value
        })
      })
    },
    onScrollLeftArrowClick: function () {
      var lastActiveIndex = $('.scroll-dot.active').last().index()
      var prevIndex = $('.scroll-dot').eq(lastActiveIndex - 1)
      prevIndex.addClass('active')
      var percentage = prevIndex.index() + '0'
      var max = $('.scroll')[0].scrollWidth - $('.scroll').width()
      var value = percentage * max / 100
      $('.scroll').animate({
        scrollLeft: value
      })
    },
    onScrollRightArrowClick: function () {
      var lastActiveIndex = $('.scroll-dot.active').last().index()
      var nextIndex = $('.scroll-dot').eq(lastActiveIndex + 1)
      nextIndex.addClass('active')
      var percentage = nextIndex.index() + '0'
      var max = $('.scroll')[0].scrollWidth - $('.scroll').width()
      var value = percentage * max / 100
      $('.scroll').animate({
        scrollLeft: value
      })
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .5s all linear

.scroll-progress-bar
  position: fixed
  right: 300px
  top: 44px
  display: inline-block
  z-index: 15

  .scroll-dot
    width: 4px
    height: 4px
    display: inline-block
    padding: 0 10px
    cursor: pointer
    position: relative

    &:after
      content: ''
      position: absolute
      width: 4px
      height: 4px
      background: #d4d4d4
      left: 50%
      top: 50%
      border-radius: 50%
      transition: $hover
      opacity: .5
      transform: translate3d(-50%, -50%, 0)

    &.active
      &:after
        background: #2c2c2c
        opacity: 1

    &.disable
      cursor: default

.scroll-arrows
  position: fixed
  right: 300px
  bottom: 64px
  display: inline-block
  z-index: 25
  color: #2c2c2c
  font-size: 10px
  width: 50px

  .glyphicon
    cursor: pointer
    transition: $hover
    display: inline-block
    width: 46%
    opacity: .3

    &:hover
       opacity: 1

    &:first-child
      &:hover
        transform: translateX(-5px)

    &:last-child
      text-align: right

      &:hover
        transform: translateX(5px)

</style>
