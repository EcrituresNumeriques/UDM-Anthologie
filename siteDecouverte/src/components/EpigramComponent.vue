<template>
    <div class="epigram" :theme="theme" :epigram="epigram">
        <div v-if="data.themes[theme].epigrams[epigram]">
          <div class="page-title-container">
              <h1>{{ data.themes[theme].epigrams[epigram].title }}</h1>
          </div>
          <div class="row epigram-row">
              <div class="col-md-2 col-md-offset-1">
                  <div class="inner-links">
                      <a v-link="{ name: 'summary' }">
                        <span class="dash"></span>
                        Les thèmes
                      </a>
                  </div>
              </div>
              <pagination :data="data" :theme="theme" :epigram="epigram"></pagination>
              <player :data="data" :theme="theme" :epigram="epigram"></player>
              <translation :data="data" :theme="theme" :epigram="epigram"></translation>
              <greek-text :data="data" :theme="theme" :epigram="epigram"></greek-text>
              <notes :data="data" :theme="theme" :epigram="epigram"></notes>
              <characters :data="data" :theme="theme" :epigram="epigram"></characters>
              <div class="col-md-9 col-md-offset-3">
                  <div
                    v-if="data.themes[theme].epigrams[epigram].imageUrl"
                    class="manuscript-image"
                  >
                      <p @click="onImageTextClick">
                        Image du manuscrit
                        <span class="border-bottom"></span>
                      </p>
                  </div>
              </div>
          </div>
          <div
            @click="onImagePopinClick"
            v-if="data.themes[theme].epigrams[epigram].imageUrl"
            class="manuscript-popin"
          >
            <img
              :src="data.themes[theme].epigrams[epigram].imageUrl"
              alt="{{ data.themes[theme].epigrams[epigram].title }}"
            >
          </div>
        </div>
        <div v-else class="notExist">
            <p>L'épigramme que vous cherchez n'existe pas</p>
            <back-btn></back-btn>
        </div>
    </div>
</template>

<script>
/* global api */
import Vue from 'vue'

import BackBtn from './partials/BackBtn'
import Pagination from './partials/epigram/Pagination'
import Player from './partials/epigram/Player'
import Translation from './partials/epigram/Translation'
import GreekText from './partials/epigram/GreekText'
import Notes from './partials/epigram/Notes'
import Characters from './partials/epigram/Characters'

import $ from 'jquery'

Vue.filter('numberize', function (value) {
  if (value < 10) {
    value = '0' + value
  }
  return value
})

export default {
  name: 'epigram',
  components: {
    BackBtn,
    Pagination,
    Player,
    Translation,
    GreekText,
    Notes,
    Characters
  },
  route: {
    data: function (transition) {
      transition.next({
        theme: transition.to.params.themeId - 1,
        epigram: transition.to.params.id - 1
      })
    }
  },
  data () {
    return {
      data: {},
      theme: this.theme,
      epigram: this.epigram
    }
  },
  ready: function () {
    var self = this
    return api.dataDiscover.get().then(function (response) {
      self.$set('data', response.data)
    }, function (response) { console.log(response.status) })
  },
  destroyed: function () {
    this.$off()
  },
  methods: {
    onImageTextClick: function () {
      $('.manuscript-popin').fadeIn(function () {
        $('.manuscript-popin img').addClass('big')
      }).css('display', 'flex')
    },
    onImagePopinClick: function () {
      $('.manuscript-popin img').removeClass('big')
      $('.manuscript-popin').fadeOut()
    }
  }
}

$(document).ready(function () {
  var body = $('body')

  function onTextArrowClick (arrow) {
    var self = arrow
    var selfDropWrapper = self.siblings('.dropdown-text-wrapper')
    var selfDropText = selfDropWrapper.children()
    var selfDropTextLength = selfDropText.length
    var selfDropTextVisible = selfDropWrapper.children('.dropdown-text.visible')
    var selfDropTextVisibleIndex = selfDropTextVisible.index()

    self.show()
    self.siblings('.glyphicon').show()
    if (arrow.hasClass('glyphicon-chevron-left')) {
      selfDropTextVisible.hide().removeClass('visible').prev().show().addClass('visible')
      if (selfDropTextVisibleIndex === 1) {
        self.hide()
      }
    } else {
      selfDropTextVisible.hide().removeClass('visible').next().show().addClass('visible')
      if (selfDropTextVisibleIndex === selfDropTextLength - 2) {
        self.hide()
      }
    }
  }

  body.on('click', '.glyphicon-chevron-left', function (e) {
    onTextArrowClick($(this))
  })

  body.on('click', '.glyphicon-chevron-right', function () {
    onTextArrowClick($(this))
  })
})
</script>

<style lang="sass">
$raleway: 'Raleway', Helvetica, Arial, sans-serif
$hover: .2s all ease-out

.epigram
  width: 100%
  height: 100%

  .epigram-row
    position: absolute
    top: 20%
    width: 100%
    z-index: 2

.mute
  display: inline-block
  vertical-align: top
  margin-top: 72px
  margin-right: 15px

  span
    color: #2c2c2c
    font-size: 16px
    cursor: pointer

.border-bottom
  width: 100%
  height: 2px
  background: #2c2c2c
  display: inline-block
  vertical-align: top

.notes,
.characters
  p
    font-style: italic
    font-weight: 700
    font-size: 14px
    color: #727272
    cursor: pointer
    display: inline-block
    margin-bottom: 0

    span.glyphicon
      font-size: 10px
      margin-left: 14px

.dropdown
  position: relative

  .dropdown-drop
    opacity: 0

    &.visible
      opacity: 1

  .dropdown-drop,
  .dropdown-text-container
    position: absolute
    transition: .5s all ease-out
    z-index: 2

  .dropdown-text-container
    display: none
    align-items: center
    height: auto
    overflow: initial
    background: #fff

    span.glyphicon
      opacity: .6
      width: 30px
      font-size: 9px
      cursor: pointer
      transition: $hover

      &:first-child
        margin-left: -30px

        &:hover
          transform: translateX(-5px)

      &:last-child
        text-align: right

        &:hover
          transform: translateX(5px)

      &:hover
        opacity: 1

    .dropdown-text-wrapper
      display: inline-block
      width: 250px
      height: 150px
      overflow-y: auto
      position: relative
      scrollbar-face-color: #2c2c2c
      scrollbar-track-color: #fff
      scrollbar-arrow-color: #fff

      &:hover
        &::-webkit-scrollbar-thumb,
        &::-webkit-scrollbar-track
          visibility: visible

      &::-webkit-scrollbar
        background: #fff
        width: 3px

      &::-webkit-scrollbar-button
        display: none

      &::-webkit-scrollbar-thumb
        background: rgba(44, 44, 44, .3)
        visibility: hidden

        &:hover
          background: rgba(44, 44, 44, .8)

        &:active
          background: rgba(44, 44, 44, 1)

      &::-webkit-scrollbar-track
        border-bottom: 1px solid #2c2c2c
        border-top: 1px solid #2c2c2c
        visibility: hidden

      .dropdown-text
        font-size: 14px
        margin-left: 20px
        position: absolute
        display: none

        .dropdown-title
          h4
            font-weight: 700
            font-size: 14px

        .dropdown-desc
          q
            quotes: "\201C" "\201D" "\2018" "\2019"
            position: relative
            padding: 0 10px 10px 0;

            &:before
              font-size: 30px
              position: absolute
              top: -40px
              left: -20px

            &:after
              display: none

.manuscript-image
  margin-top: 25px

  p
   font-family: $raleway
   font-size: 12px
   font-weight: 600
   display: inline-block
   cursor: pointer

.manuscript-popin
  position: absolute
  width: 100%
  height: 100%
  top: 0
  left: 0
  z-index: 10
  display: flex
  align-items: center
  justify-content: center
  background: rgba(0, 0, 0, .5)
  cursor: pointer
  display: none

  img
    transform: scale(0.5)
    transition: .5s

    &.big
      transform: scale(1)

.notExist
  width: 100%
  height: 100%
  display: flex
  align-items: center
  justify-content: center
  position: relative

  p
    font-size: 30px
    color: #2c2c2c

  .back-btn
    left: 0

</style>
