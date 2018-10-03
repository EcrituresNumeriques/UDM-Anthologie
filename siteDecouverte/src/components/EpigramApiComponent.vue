<template>
  <div class="epigram-api">
    <loader></loader>
    <div>
      <div class="page-title-container">
        <h1 v-if="epigram">{{ backgroundTitle }}</h1>
      </div>
      <div class="row epigram-row">
        <div class="col-md-2 col-md-offset-1">
          <div class="inner-links">
            <a href="#!/sommaire">
              <span class="dash"></span>
              Les thèmes
            </a>
          </div>
        </div>
        <!-- WIP: dataEpigrams? -->
        <pagination length="3"
                    epigram="1"></pagination>
        <div class="col-md-1 col-md-offset-1 ">
          <player :data="epigram"></player>
        </div>
        <!-- WIP: translation component not working, crashes the page -->
        <div class="col-md-3">
          <translation v-bind:epigram="epigram"></translation>
        </div>
        <div class="col-md-6 col-md-offset-1">
          <greek-text v-bind:epigram="epigram"></greek-text>
        </div>
        <div class="col-md-3 col-md-offset-4">
          <notes :data="epigram"></notes>
        </div>
        <div class="">
          <characters :data="epigram"></characters>
        </div>
        <div class="col-md-9 col-md-offset-3">
<!--
          <div v-if="epigram.images">
            <div v-for="image in epigram.images"
                 class="manuscript-image">
              <p @click="showPopin">
                Image du manuscrit
              </p>
            </div>
            <div
              tabindex="0"
              @click="hidePopin"
              @keyup.esc="hidePopin"
              v-if="image.url"
              class="manuscript-popin"
            >
              <div
                @click="hidePopin"
                class="popin-cross-container"
              >
                <div class="popin-cross"></div>
              </div>
              <img
                :src="image.url"
                v-bind:alt="epigram.authors[0].author_translations[0].name"
              >
            </div>
          </div>
-->
        </div>
      </div>
    </div>


    <div class="notExist" v-show="false">
        <p>L'épigramme que vous cherchez n'existe pas</p>
        <back-btn></back-btn>
    </div>
    <div class="problem" v-show="false">
        <p>Un problème est survenu.</p>
        <back-btn></back-btn>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'

import BackBtn from './partials/BackBtn'
import Pagination from './partials/epigramApi/Pagination'
//import Player from './partials/epigramApi/Player'
import Translation from './partials/epigramApi/Translation'
import GreekText from './partials/epigramApi/GreekText'
//import Notes from './partials/epigramApi/Notes'
//import Characters from './partials/epigramApi/Characters'
import Loader from './partials/Loader'
//import Languages from '../service/languages'

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
//    Player,
    Translation,
    GreekText,
//    Notes,
//    Characters,
    Loader
  },
  computed: {
    backgroundTitle: function () {
      if (this.epigram && this.epigram.title) {
        return this.epigram.title.replace(/Greek Anthology/i, 'AP')
      } else {
        return 'AP'
      }
    }
  },
  route: {
    data: function (transition) {
      transition.next({
        epigram: transition.to.params.id - 1
      })
    }
  },
  props: {
    epigram: Object,
    languages: Array
  },
  created: function () {
    var self = this
    self.$nextTick(function () {
      $('.loader').show()
      self.getEpigramData()
    })
  },
  methods: {
    getEpigramData: function () {
      var self = this
//      this.$http.get(global.apiAuth).then(function (response) {
//        self.$set('token', response.data.access_token)
      self.$http.get(global.api + 'entities/' + this.$route.params.id/* + filterFr + 'access_token=' + self.token */, {progerss () {
      }}).then(function (response) {
        var epigramData = JSON.parse(response.bodyText)
        console.log('Successfully retrieved entity', epigramData)
        self.$set(self, 'epigram', epigramData)
      }, function (response) {
        if (response.status === 404) {
          $('.notExist').show()
        }
        $('.problem').show()
        console.error('[epigramApiComponent] Error retrieving Epigram', response)
        self.epigram = {}
      }).finally(function () {
        $('.loader').fadeOut()
      })
//      }, function (response) {
//        console.log('global error: ' + response.status)
//      })
    },
    showPopin: function () {
      $('.manuscript-popin').fadeIn(function () {
        $('.manuscript-popin img').addClass('big')
      }).css('display', 'flex').focus()
    },
    hidePopin: function () {
      $('.manuscript-popin img').removeClass('big')
      $('.manuscript-popin').fadeOut()
    }
  }
}
</script>

<style lang="sass">
  $raleway: 'Raleway', Helvetica, Arial, sans-serif
  $hover: .5s all ease-out

  .epigram-api
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
    margin-top: 100px
    margin-right: 4px

    span
      color: #2c2c2c
      font-size: 20px
      cursor: pointer

  .border-bottom
    width: 100%
    height: 2px
    background: #222222
    display: inline-block
    vertical-align: top

  .greek-translation,
  .notes,
  .characters
    p
      span.glyphicon
        transition: $hover

      &:hover
        span.glyphicon-chevron-right
          transform: translateX(5px)

  .notes,
  .characters
    p
      font-style: italic
      font-weight: 600
      font-size: 16px
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

    .dropdown-text-wrapper,
    .dropdown-drop ul
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

  .manuscript-image
    margin-top: 25px

    p
      font-family: $raleway
      font-size: 12px
      font-weight: 600
      display: inline-block
      cursor: pointer
      position: relative
      padding-bottom: 2px

      &:before
        content: ''
        display: block
        position: absolute
        left: 0
        bottom: 0
        height: 2px
        width: 100%
        transition: width 0s ease

      &:after
        content: ''
        display: block
        position: absolute
        right: 0
        bottom: 0
        height: 2px
        width: 100%
        background: #2C2C2C
        transition: width .5s ease

      &:hover
        &:before
          width: 0%
          background: #2C2C2C
          transition: width .5s ease

        &:after
          width: 0%
          background: transparent
          transition: width 0s ease

  .manuscript-popin
    position: absolute
    width: 100%
    height: 100%
    top: 0
    left: 0
    z-index: 30
    align-items: center
    justify-content: center
    background: rgba(0, 0, 0, .5)
    display: none
    cursor: pointer

    .popin-cross-container
      position: absolute
      width: 50px
      height: 50px
      top: 30px
      right: 30px
      cursor: pointer
      display: flex
      align-items: center
      justify-content: center

      .popin-cross
        display: inline-block
        width: 100%
        height: 1px
        background: #fff
        transform: rotate(45deg)

        &:after
          content: ""
          width: 100%
          height: 1px
          position: absolute
          background: #fff
          transform: rotate(90deg)

    img
      transform: scale(0.5)
      transition: .5s
      max-width: 80%
      max-height: 80%

      &.big
        transform: scale(1)
        max-width: 80%
        max-height: 80%
</style>
