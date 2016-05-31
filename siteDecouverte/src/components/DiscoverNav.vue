<template>
    <div class="discover-nav">
        <nav class="navbar navbar-default">
            <ul class="nav">
                <li class="discover-list" v-for="theme in data.themes" v-if="theme.epigrams">
                  <a data-id="{{ theme.id }}" v-link="{ name: 'theme', params: { theme: theme.slug, themeId: theme.id, id: '1' }}">
                    <span class="dash"></span>
                    {{ theme.name }}
                    <sup></sup>
                  </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
/* global api */
import Epigram from './Epigram'
import $ from 'jquery'

function romanize (num) {
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
}

$(window).load(function () {
  $('li.discover-list').each(function () {
    var index = $(this).index() + 1
    var romanized = romanize(index)
    $(this).find('sup').text(romanized)
  })
})

export default {
  components: {
    Epigram
  },
  data () {
    return {
      data: {},
      dataThemeId: {}
    }
  },
  ready: function () {
    this.getCurrentId()
    var self = this
    return api.dataDiscover.get().then(function (response) {
      self.$set('data', response.data)
    }, function (response) { console.log(response.status) })
  },
  methods: {
    getCurrentId: function () {
      var self = this
      $('body').on('click', '.discover-list a', function (e) {
        e.preventDefault()
        var dataId = $(this).data('id')
        return api.dataDiscover.get().then(function (response) {
          self.$set('dataThemeId', response.data.themes[dataId - 1])
        }, function (response) { console.log(response.status) })
      })
    }
  }
}

</script>

<style lang="sass" scoped>
$hover: .2s all ease-out

.discover-nav
  margin-top: 150px

.nav>li>a
  display: flex

ul
  li
    a
      font-size: 17px
      color: rgba(0, 0, 0, 0.5)
      align-items: center
      transition: $hover
      padding: 5px 15px 5px 0

      .dash
        width: 0
        height: 1px
        margin-right: 0
        transition: $hover

      sup
        font-size: 9px

      &:hover,
      &:focus,
      &.v-link-active
        opacity: 1
        color: #2c2c2c
        background: none;

        .dash
          width: 20px
          margin-right: 20px
</style>
