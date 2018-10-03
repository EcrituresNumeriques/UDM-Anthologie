<template>
  <div class="translation">
    <div
      @click="onFrenchMuteClick"
      v-if="epigram.sounds"
      class="mute french-mute"
    >
      <span class="glyphicon glyphicon-volume-up"></span>
    </div>
    <div class="text-container">
      <div class="text-theme"
           v-show="theme">
        <h2>
          <span class="bg"></span>
          {{ theme }}
        </h2>
      </div>
      <div class="text-title">
        <h3>{{ epigram.title }}</h3>
        <div
          v-if="epigram.versions"
          class="text-lang"
        >
          <select v-model="selectedEpigram">
            <option v-for="version in epigram.versions.options"
                    v-bind:value="version.id_entity - 1"
                    >
              {{ version.text_translated }}
            </option>
          </select>
        </div>
      </div>
      <div class="text-content">
        <p v-if="epigram.versions"
           v-html="epigramTranslated"></p>
      </div>
      <div class="text-author" v-if="epigram.authors">
        <span class="dash"></span>
        <p v-for="(author, index) in epigram.authors">
          <span v-show="index !== 0">/</span>
          {{ author.name ? author.name : '(Auteur)' }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'

export default {
  props: {
    epigram: Object,
    authors: Array,
    languages: Array,
    selectedEpigram: Object
  },
  computed: {
    epigramTranslated: function () {
      var self = this
      var prefIndex = 0

      // determine which version is our favourite
      prefIndex = self.getPrefVersion()

      return self.epigram.versions[prefIndex].text_translated
    }
  },
  created () {
    var self = this
    self.$nextTick(function () {
      console.log('[Translation.vue] this.epigram', this.epigram)
      self.getLanguages()
    })
  },
  methods: {
    getLanguages: function () {
      var self = this
      self.$http.get(global.api + 'languages')
        .then(function (response) {
          var languages = JSON.parse(response.bodyText)
          self.$set(self, 'languages', languages)
          console.log('self.langs -- ', self.languages)
//          self.getPrefVersion()
        })
    },
    getPrefVersion: function (prefFamily, prefName) {
      // Get the closest version based on the lang preference
      // Currently, hard-coded preference is Français Moderne
      // Falls back to other versions of the same family
      // Then falls back to other langs if non available
      var self = this
      var prefIndex = 0 // defauls to first position in array
      var preferredFamily = prefFamily || 'Français'
      var preferredName = prefName || 'moderne'

      if (!self.languages) {
        // ugh, we can't do much without the languages loaded...

        return prefIndex
      }

      self.languages.each(function (language, index) {
        if (language.family === preferredFamily) {
          // language family match (general)
          prefIndex = index

          // bonus: language name match (specific in a language family)
          if (language.name === preferredName) {
            prefIndex = index
          }
        }
      })

      return prefIndex
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

      h2,
      h3,
      select
        font-family: $raleway
        font-weight: 600
        color: #5e5e5e

    .text-theme
      h2
        font-size: 14px
        position: relative
        display: inline-block

        span.bg
          left: -10px

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
      width: 300px
      height: 300px
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
