<template>
  <div class="col-md-3 translation">
    <div class="text-container">
      <div class="text-title">
        <h3>{{ data.title }}</h3>
        <div
          v-if="data.entity_translations[0].language > 1"
          class="text-lang"
        >
          <select v-model="selected">
            <option
              v-for="lang in data.entity_translations"
              value="{{ lang.language.id - 1 }}"
            >
              {{ lang.language.name | cut }}
            </option>
          </select>
        </div>
      </div>
      <div class="text-content">
        <p v-if="data.entity_translations[0].language.length > 1">
          {{{ data.entity_translations[selected].text_translated }}}
        </p>
        <p v-else>
          {{{ data.entity_translations[0].text_translated }}}
        </p>
      </div>
      <div class="text-author">
        <span class="dash"></span>
        <p>Méléagre</p>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from 'vue'

import $ from 'jquery'

Vue.filter('cut', function (string) {
  var stringCut = string.substring(0, 2)
  return stringCut
})

export default {
  props: {
    data: Object
  },
  data () {
    return {
      selected: this.data.entity_translations[0].language.id - 1
    }
  },
  methods: {
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
        background: url('~assets/img/select-arrow.png') no-repeat right
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
      margin: 0 auto

      p
        font-size: 14px
        color: #2c2c2c
        line-height: 1.5em

        &::first-letter
          font-size: 36px

    .text-author

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
        font-family: "Times New Roman"
</style>
