<template>
  <div class="parcours-single">
    <loader></loader>
    <div class="page-title-container"
         v-if="parcours && parcours.versions">
        <h1>{{ versionLanguage(parcours.versions).title }}</h1>
    </div>

    <div class="row"
         v-if="parcours && parcours.versions"
         >
      <div class="col-md-9 col-md-offset-1">
        <div class="inner-links">
          <router-link :to="{ name: 'parcoursIndex', params: { parcoursId: parcoursId, parcoursName: $route.parcoursName } }">
            <span class="dash"></span>
            Sommaire du parcours
          </router-link>
        </div>

        <br>
        <br>

        <div class="row">
          <div class="col-md-3 col-md-offset-1">
            <translation :epigram="epigram"
                         :parcours-title="parcours.versions[0].title"
                         ></translation>
          </div>

          <div class="col-md-3 col-md-offset-1">
            <greek-text :epigram="epigram"></greek-text>
          </div>

          <div class="col-md-3">
              <notes :epigram="epigram"></notes>
          </div>

          <div
                v-if="epigram && epigram.imageUrl"
                class="manuscript-image"
              >
                  <p @click="showPopin">
                    Image du manuscrit
                  </p>
              </div>
        </div>
      </div>

      <div class="col-md-1">
        <pagination v-if="parcours.entities"
                    :total="parcoursTotal"
                    :current="epigramIndex"
                    v-on:prev="prev()"
                    v-on:next="next()"></pagination>
      </div>
    </div>


<!--
      <div class="">
        <characters :data="epigram"></characters>
      </div>
-->

    <div class="component--carousel">
      <div v-if="epigram && epigram.externalRef && epigram.externalRef.length">
        <header class="carousel__header">
          <div class="row">
            <div class="col-md-4 col-md-offset-1">
              <div class="text-theme">
                <h3>
                  Références
                </h3>
              </div>
            </div>
          </div>
        </header>
        <div class="scroll carousel__container">
          <article class="carousel__wrapper">
            <a v-if="epigram"
               v-for="(ref, index) in epigram.externalRef"
               class="carousel__item -link"
               v-on:click="openFancybox(index, $event)"
               v-bind:href="ref.url"
               v-bind:data-src="ref.url"
               v-bind:data-caption="ref.title"
               >
              {{ ref.title }}
            </a>
          </article>
        </div>
      </div>
    </div>
    <div
      tabindex="0"
      @click="hidePopin"
      @keyup.esc="hidePopin"
      v-if="epigram && epigram.imageUrl"
      class="manuscript-popin"
    >
      <div
        @click="hidePopin"
        class="popin-cross-container"
      >
        <div class="popin-cross"></div>
      </div>
      <img v-if="epigram && epigram.imageUrl"
           :src="epigram.imageUrl"
           v-bind:alt="epigram.title"
      >
    </div>
  </div>
</template>

<script>
import Vue from 'vue'

import BackBtn from './partials/BackBtn'
import Pagination from './partials/parcours/Pagination'
//import Player from './partials/parcours/Player'
import Translation from './partials/parcours/Translation'
import GreekText from './partials/parcours/GreekText'
import Notes from './partials/parcours/Notes'

/*
 * NOTE ON JQUERY $
 * Use global `$` loaded by `<script>`s to pick up $.fancybox
 * since webpack does not automatically load the jQuery plugins.
 */
/* global $ */
//import $ from 'jquery'
//import router from 'vue-router'

Vue.filter('numberize', function (value) {
  if (value < 10) {
    value = '0' + value
  }
  return value
})

export default {
  name: 'ParcoursSingle',
  components: {
    BackBtn,
    Pagination,
//    Player,
    Translation,
    GreekText,
    Notes
  },
  data () {
    return {
      epigram: {},
      parcours: {},
      parcoursId: 0,
      epigramId: Number,
      epigramIndex: 0
    }
  },
  computed: {
    parcoursTotal: function () {
      return this.parcours.entities.length
    }
  },
  created: function () {
    var self = this

    this.$nextTick(function () {
      // ensure elements are in-document
      // immediately show loader
      $('.loader').fadeIn()
    })

    self.parcoursId = self.$route.params.parcoursId
    self.epigramIndex = self.$route.params.epigramIndex - 1

    self.getParcours()
    .then(function (parcoursData) {
      self.$set(self, 'parcours', parcoursData)
      // Set the full parcours data (for navigation)
//      console.log('parcoursData', parcoursData.entities[0])
      var epigramId

      if (parcoursData.entities[self.epigramIndex]) {
        epigramId = parcoursData.entities[self.epigramIndex].id_entity
        self.epigramId = epigramId
        self.getEpigram()
        .then(function (epigramData) {
          self.$set(self, 'epigram', epigramData)
        })
      }
    })
  },
  destroyed: function () {
    this.$off()
    $.fancybox.destroy()
  },
  methods: {
    versionLanguage (versions, options) {
      return global.versionLanguage(versions, options)
    },
    showPopin: function () {
      $('.manuscript-popin').fadeIn(function () {
        $('.manuscript-popin img').addClass('big')
      }).css('display', 'flex').focus()
    },
    hidePopin: function () {
      $('.manuscript-popin img').removeClass('big')
      $('.manuscript-popin').fadeOut()
    },
    getParcours () {
      var self = this

      return self.$http.get(global.api + 'keywords/' + self.parcoursId).then(function (response) {
        var parcoursData = JSON.parse(response.bodyText)

        return parcoursData
      }, function (err) {
        console.error('Error retrieving parcours (keyword) data', err)
      })
    },
    getEpigram () {
      var self = this

      if (self.epigramId) {
        return self.$http.get(global.api + 'entities/' + self.epigramId).then(function (response) {
          var epigramData = JSON.parse(response.bodyText)

          return epigramData
  //        console.log('SORTED EPIGRAM', global.versionLanguage(self.epigram.versions).id_entity)
        })
        .finally(function () {
          $('.loader').fadeOut()
        })
      } else {
        self.getEpigram()
      }
    },
    openFancybox (index, event) {
//      var self = this
      event.preventDefault()

      // Init fancybox
      var fancyboxInstance = $.fancybox.open(event.currentTarget.parentElement.children, {
        hash: false,
        buttons: [
          //'zoom',
          //'share',
          //'slideShow',
          //'fullScreen',
          //'download',
          'thumbs',
          'close'
        ],
        type: 'iframe',
        iframe: {
          preload: false
        },
        lang: 'fr',
        i18n: {
          fr: {
            CLOSE: 'Fermer',
            NEXT: 'Suivant',
            PREV: 'Précédent',
            ERROR: 'Le contenu demandé ne peut être affiché.<br> Veuillez réessayer plus tard.',
            PLAY_START: 'Démarrer le diaporama',
            PLAY_STOP: 'Suspendre le diaporama',
            FULL_SCREEN: 'Plein écran',
            THUMBS: 'Vignettes',
            DOWNLOAD: 'Télécharger',
            SHARE: 'Partager',
            ZOOM: 'Agrandir'
          }
        },
        beforeLoad (instance, slide) {
          console.log('beforeload slide', slide)

          var regexps = {
            https: /^https:/i,
            http: /^http:/i,
            youtube: /^https?:\/\/((www\.|m\.)?youtube\.com|youtu\.be)\/(watch\?v?=|)(.+)$/i
          }

          // Loading plain HTTP (unsafe) content on a HTTPS page is not allowed
          // If current location is HTTPS and remote content is HTTP, do not load
          // in place; open new tab
          // 1. Are we on HTTPS?
          if (regexps.https.test(window.location.protocol)) {
            // 2. Currently on HTTPS; is the target unsafe HTTP?
            if (regexps.http.test(slide.src)) {
              // 3. Unsafe HTTP external content; open in new tab
              console.warn('Not attempting to load unsafe HTTP content on HTTPS page; opening in new tab.')
              instance.close()
              window.open(slide.src, '_newtab')
            }
          } else {
            // App is on http page, all is OK
          }

          if (regexps.youtube.test(slide.src)) {
            console.log('---', slide.src.replace(regexps.youtube, '$4'))
            slide.src = slide.src.replace(regexps.youtube, 'https://youtube.com/embed/$4')
          }
        },
        afterClose () {
          $.fancybox.destroy()
        }
      })

      console.log('fancyboxInstance', fancyboxInstance)

      fancyboxInstance.jumpTo(index)
    },
    prev () {
      console.log('call prev')
      var self = this

      var prevIndex = self.epigramIndex

      self.$router.push({ name: 'parcoursSingle', params: { parcoursId: self.$route.params.parcoursId, parcourSlug: self.$route.params.parcoursSlug, epigramIndex: prevIndex } })
    },
    next () {
      console.log('call next')
      var self = this
      var nextIndex = self.epigramIndex + 2

      self.$router.push({ name: 'parcoursSingle', params: { parcoursId: self.$route.params.parcoursId, parcourSlug: self.$route.params.parcoursSlug, epigramIndex: nextIndex } })
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

  body.on('click', '.glyphicon-chevron-left', function () {
    onTextArrowClick($(this))
  })

  body.on('click', '.glyphicon-chevron-right', function () {
    onTextArrowClick($(this))
  })
})
</script>

<style lang="sass" scoped>
$raleway: 'Raleway', Helvetica, Arial, sans-serif
$hover: .5s all ease-out

.parcours-single
  width: 100%
  height: 100%
  display: flex
  flex-direction: column
  justify-content: space-between

.epigram-row
  //position: absolute
  //top: 100px
  //width: 100%
  //z-index: 2

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

.component--carousel
  width: 100%
  //overflow: hidden
  position: relative
  &::before,
  &::after
    content: ''
    position: absolute
    width: 8em
    //opacity: 0.8
    top: -20px
    bottom: -20px
    z-index: 3
    filter: blur(10px)
    transform: scaleY(1.05)
  &::before
    left: -20px
    background: linear-gradient(-90deg, rgba(255,255,255,0), rgba(255,255,255,1) 50%)
  &::after
    right: -20px
    background: linear-gradient(90deg, rgba(255,255,255,0), rgba(255,255,255,1) 50%)

.carousel__container
  padding-left: 8em
  padding-right: 8em

.carousel__wrapper
  display: flex
  flex-direction: row
  flex-wrap: nowrap
  // Add an empty transparent element at the end of the container
  // to create extra scrolling space
  &::after
    background-color: transparent !important
    content: ''
  &:after,
  .carousel__item
    width: 20em
    margin: 0 5px
    height: 100px
    flex-shrink: 0
    display: block
    background-color: #2c2c2c
    font-family: $raleway
    color: #aaa
    font-size: 16px
    justify-content: flex-end
    flex-direction: column
    padding: 10px
    display: flex
    &.-link
      opacity: 1
      transition: opacity 0.4s
      &:hover
        opacity: 0.9

</style>
