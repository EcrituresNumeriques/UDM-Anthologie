<template>
  <div class="translation"
       v-if="epigram && epigram.versions">
<!--
    <div
      @click="onFrenchMuteClick"
      v-if="epigram.sounds.french"
      class="mute french-mute"
    >
      <span class="glyphicon glyphicon-volume-up"></span>
    </div>
-->
    <div class="text-container">
      <div class="text-title">
        <h2>
          <span class="bg"></span>
          {{ epigram.title }}
        </h2>
      </div>
<!--
      <div class="text-title">
          <select v-model="epigram.langs.selected">
            <option
              v-for="lang in preferredLanguageIds"
              v-bind:value="lang"
            >
              {{ lang.text }}
            </option>
          </select>
        </div>
-->
      </div>
      <div class="text-content">
        <p v-html="versionLanguage(epigram.versions).text_translated"></p>
      </div>
      <div class="text-author" v-if="epigram.authors">
        <div v-for="author in epigram.authors">
          <span class="dash"></span>
          <p><router-link :to="{ name: 'authorSingle', params: { id: author.id_author} }">{{ author.name ? author.name : '(Auteur)' }}</router-link></p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'

export default {
  props: {
    epigram: {},
    parcoursTitle: '',
    languages: []
  },
  created: function () {
    var self = this

    self.languages = global.languages

    self.$nextTick(function () {
//      console.log('Translation ready', self.epigram.versions[0])
    })
  },
  methods: {
    versionLanguage (versions, options) {
      return global.versionLanguage(versions, options)
    },
    onFrenchMuteClick: function () {
      var controlBtn, playBtn, frenchSound, greekSound, greekMute
      var frenchMute = $('.french-mute .glyphicon')
      controlBtn = $('.control')
      playBtn = controlBtn.children('.play-button')
      frenchSound = $('audio')[0]
      greekSound = $('audio')[1]
      greekMute = $('.greek-mute .glyphicon')
      greekMute.removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
      if (greekSound.currentTime > 0) {
        greekSound.pause()
        greekSound.currentTime = 0
        greekSound.volume = 1
      }
      if (frenchSound.paused) {
        frenchSound.play()
        controlBtn
          .removeClass('greek-sound-playing')
          .addClass('french-sound-playing')
        playBtn.removeClass('paused')
      } else {
        if (frenchSound.volume === 1) {
          frenchSound.volume = 0
          frenchMute.removeClass('glyphicon-volume-up').addClass('glyphicon-volume-off')
        } else {
          frenchSound.volume = 1
          frenchMute.removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
        }
      }
    }
  }
}
</script>

<style lang="sass" scoped>
$raleway: 'Raleway', Helvetica, Arial, sans-serif

.translation

  .text-container
    display: inline-block
    width: 86%

    .text-theme,
    .text-title
      text-align: center

      span.bg
        left: -0.5em
        height: 1.5em
        widht: 1.5em

      h2,
      h3,
      select
        font-family: $raleway
        font-weight: 600
        color: #5e5e5e

    .text-title
      margin-bottom: 10px

      h2
        font-size: 14px
        position: relative
        display: inline-block

    .text-title
      position: relative

      h3
        font-size: 12px

      .text-lang
        background: url('/assets/img/select-arrow.png') no-repeat right
        width: 34px
        overflow: hidden
        position: absolute
        top: 0
        right: 0
        margin-top: -5px

        select
          font-size: 10px
          text-transform: uppercase
          border: none
          color: #2c2c2c
          width: 55px
          background: transparent
          outline: none


    .text-content
      //width: 300px
      //height: 300px
      overflow-y: auto
      margin: 0 auto
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

      p
        font-size: 14px
        color: #2c2c2c
        line-height: 1.5em
        padding: 20px 0

        &::first-letter
          font-size: 36px

  .text-author
    margin-top: 20px

    .dash
      width: 10px
      height: 1px
      margin-right: 10px

    p
      display: inline-block
      margin: 0
      font-style: italic
      font-size: 14px
      color: #2c2c2c
      font-family: "Times New Roman", sans-serif
</style>
