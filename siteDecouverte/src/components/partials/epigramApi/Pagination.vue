<template>
  <div class="col-md-1 col-md-offset-10 pagination-partial">
    <div class="index">
      <p class="total">
        {{ length | numberize }}
      </p>
      <span class="separator"></span>
      <p class="current">
        {{ epigram + 1 | numberize }}
      </p>
    </div>
    <div class="arrows">
      <span>
        <a
          @click="onPaginationClick"
          v-show="!(data.id == 1)"
          v-link="{ name: 'epigram', params: { id: data.id - 1 }}"
        >
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
      </span>
      <span class="separator"></span>
      <span>
        <a
          @click="onPaginationClick"
          v-show="!(data.id == length)"
          v-link="{ name: 'epigram', params: { id: data.id + 1  }}"
        >
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </span>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'

export default {
  props: {
    data: Object,
    epigram: Number,
    length: Number
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
