<template>
    <div class="discover-nav">
        <nav class="navbar navbar-default">
            <ul class="nav">
                <li
                  class="discover-list"
                  v-for="theme in data.themes"
                  v-if="theme.epigrams"
                >
                  <a
                    @mouseover="addClass"
                    data-id="{{ theme.id }}"
                    v-link="{ name: 'theme', params: { theme: theme.slug, themeId: theme.id, id: '1' }}"
                    :class="{ 'active': $index === 0 }"
                  >
                    <span class="dash">
                      <span class="inner-dash"></span>
                    </span>
                    {{ theme.name }}
                    <sup>{{ theme.id | romanize }}</sup>
                  </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
/* global api */
import Vue from 'vue'

import $ from 'jquery'

Vue.filter('romanize', function (num) {
  if (!+num) { return false }
  var digits = String(+num).split('')
  var key = ['', 'C', 'CC', 'CCC', 'CD', 'D', 'DC', 'DCC', 'DCCC', 'CM',
    '', 'X', 'XX', 'XXX', 'XL', 'L', 'LX', 'LXX', 'LXXX', 'XC',
    '', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX']
  var roman
  roman = ''
  var i = 3
  while (i--) {
    roman = (key[+digits.pop() + (i * 10)] || '') + roman
  }
  return Array(+digits.join('') + 1).join('M') + roman
})

export default {
  data () {
    return {
      data: {}
    }
  },
  ready: function () {
    var self = this
    return api.dataDiscover.get().then(function (response) {
      self.$set('data', response.data)
    }, function (response) { console.log(response.status) })
  },
  methods: {
    addClass: function (e) {
      $(e.target).addClass('active')
      $(e.target).parent().siblings().children().removeClass('active')
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .5s all ease-out

.tamere
  color: blue

.discover-nav
  margin-top: 150px
  width: 60%
  padding-left: 20px

  li
    margin: 5px 0

.nav>li>a
  display: flex

ul
  li
    a
      font-size: 17px
      color: #e0e0e0
      align-items: center
      transition: $hover
      padding: 5px 15px 5px 0

      .dash
        width: 20px
        height: 1px
        transition: $hover
        background: transparent
        position: relative
        margin-right: 0
        animation: marginRightOut .5s ease-out forwards

        .inner-dash
          background: #000
          height: 1px
          width: 0
          position: absolute
          top: 0
          left: 0
          transition: $hover
          animation: activeOut .5s ease-out forwards


      sup
        font-size: 9px

      &:focus,
      &.active
        color: #2c2c2c
        background: none

        .dash
          animation: marginRightIn .5s ease-out .2s forwards

          .inner-dash
            animation: activeIn .5s ease-out forwards

@keyframes activeIn
  from
    width: 0

  to
    width: 20px

@keyframes activeOut
  from
    width: 20px

  to
    width: 0

@keyframes marginRightIn
  from
    margin-right: 0

  to
    margin-right: 20px

@keyframes marginRightOut
  from
    margin-right: 20px

  to
    margin-right: 0
</style>
