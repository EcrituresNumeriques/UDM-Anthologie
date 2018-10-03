<template>
  <div class="pagination-partial">
    <div class="index">
      <p class="total">
        {{ length | numberize }}
      </p>
      <span class="separator"></span>
      <p class="current">
        {{ current + 1 | numberize }}
      </p>
    </div>
    <div class="arrows">
      <span>
        <router-link :to="{ name: 'parcoursSingle', params: { parcoursIndex: current - 1 }}"
          @click="onPaginationClick"
          v-show="!(current == 0)">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </router-link>
      </span>
      <span class="separator"></span>
      <span>
        <router-link :to="{ name: 'parcoursSingle', params: { parcoursIndex: current + 1 }}"
          @click="onPaginationClick"
          v-show="!(current === length -1)">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </router-link>
      </span>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'
import $ from 'jquery'

Vue.filter('numberize', function (value) {
  if (value < 10) {
    value = '0' + value
  }
  return value
})

export default {
  props: {
    parcours: {},
    length: Number,
    current: Number
  },
  created: function () {
    console.log('Pagination props', this.length)
  },
  methods: {
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
  width: 55px
  float: right
  margin-top: 90px
  display: flex
  justify-content: space-between
  align-items: center

  &:after
    clear: both

  .separator
    height: 10px
    width: 1px
    background: #2c2c2c
    display: inline-block
    opacity: 0.15

  >span
    a
      font-size: 10px
      color: #2c2c2c
      opacity: 0.3
      transition: $hover
      display: block

      &:hover
        text-decoration: none
        opacity: 1

    &:first-child,
    &:last-child
      flex-grow: 2

    &:first-child
      a
        &:hover
          transform: translateX(-5px)

    &:last-child
      text-align: right

      a
        &:hover
          transform: translateX(5px)
</style>
