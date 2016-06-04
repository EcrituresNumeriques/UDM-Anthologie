<template>
  <div class="col-md-3 translation">
    <div
      @click="onFrenchMuteClick"
      v-if="data.themes[theme].epigrams[epigram].sounds.french"
      class="mute french-mute"
    >
      <span class="glyphicon glyphicon-volume-up"></span>
    </div>
    <div class="text-container">
      <div class="text-theme">
        <h2>
          <span class="bg"></span>
          {{ data.themes[theme].name }}
        </h2>
      </div>
      <div class="text-title">
        <h3>{{ data.themes[theme].epigrams[epigram].title }}</h3>
        <div
          v-if="data.themes[theme].epigrams[epigram].langs"
          class="text-lang"
        >
          <select v-model="data.themes[theme].epigrams[epigram].langs.selected">
            <option
              v-for="lang in data.themes[theme].epigrams[epigram].langs.options"
              value="{{ lang.id - 1 }}"
            >
              {{ lang.text }}
            </option>
          </select>
        </div>
      </div>
      <div class="text-content">
        <p v-if="data.themes[theme].epigrams[epigram].langs">
          {{{ data.themes[theme].epigrams[epigram].texts[data.themes[theme].epigrams[epigram].langs.selected].content }}}
        </p>
        <p v-else>
          {{{ data.themes[theme].epigrams[epigram].texts[0].content }}}
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
import $ from 'jquery'

export default {
  props: {
    data: Object,
    theme: Number,
    epigram: Number
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
        right: 65px
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
