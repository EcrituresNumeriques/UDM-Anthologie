<template>
  <div class="pagination-partial">
    <div class="index">
      <p class="total">
        {{ total | numberize }}
      </p>
      <span class="separator"></span>
      <p class="current">
        {{ current + 1 | numberize }}
      </p>
    </div>
    <div class="arrows">
      <span @click="prev"
            v-show="current !== 0">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </span>
      <span class="separator"></span>
      <span @click="next"
            v-show=" current + 1 < total">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </span>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import $ from 'jquery'

Vue.filter('numberize', function (value) {
  if (typeof value === 'string') {
    value = parseInt(value)
  }

  if (value < 10) {
    value = '0' + value.toString()
  }
  return value
})

export default {
  props: {
    total: Number,
    current: Number
  },
  computed () {
    var self = this
    return {
      showPrev () {
        return self.current !== 0
      },
      showNext () {
        console.log('should I show next?', self.current, self.total)
        return self.current + 1 < self.total
      }
    }
  },
  created: function () {
    console.log('created with props', this.current, this.total)
  },
  methods: {
    prev () {
      this.$emit('prev')
    },
    next () {
      this.$emit('next')
    },
    onPaginationClick: function () {
      $('.notes.dropdown > p .glyphicon').addClass('glyphicon-chevron-right').removeClass('glyphicon-chevron-down')
      $('.notes').removeClass('droped')
      $('.notes .dropdown-drop').removeClass('visible')
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .5s all ease-out

.index
  position: relative

  p
    position: absolute
    color: #2c2c2c

    &.total
      font-weight: 700
      font-size: 16px
      right: 0
      top: 0

    &.current
      font-size: 48px
      right: 23px
      top: 10px

  span.separator
    position: absolute
    right: 5px
    top: 18px
    width: 30px
    height: 1px
    transform: rotate(45deg)
    background: #2c2c2c

.arrows
  width: 80px
  float: right
  margin-top: 80px
  text-align: right

  &:after
    clear: both

  .separator
    height: 10px
    width: 1px
    background: #2c2c2c
    display: inline-block
    opacity: 0.15

  >span
    font-size: 10px
    color: #2c2c2c
    opacity: 0.3
    transition: $hover
    display: block
    display: inline-block
    cursor: pointer

    &:hover
      text-decoration: none
      opacity: 1

    &:first-child,
    &:last-child
      flex-grow: 2
      padding: 10px

    &:first-child
      &:hover
        transform: translateX(-5px)

    &:last-child
      text-align: right

      &:hover
        transform: translateX(5px)
</style>
