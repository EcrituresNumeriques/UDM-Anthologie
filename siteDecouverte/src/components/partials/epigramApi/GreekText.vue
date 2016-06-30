<template>
  <div class="col-md-6 col-md-offset-1 greek-text">
    <div class="greek-translation dropdown">
      <p @click="onGreekDropdownClick">
        Traduction grecque
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="border-bottom"></span>
      </p>
      <div class="dropdown-drop">
        <div class="dropdown-content">
          <div
            @click="onGreekMuteClick"
            v-if="data.texts[0].text_translations[0].sound_url"
            class="mute greek-mute"
          >
            <span class="glyphicon glyphicon-volume-up"></span>
          </div>
          <p>
            {{{ data.texts[0].text_translations[0].text_translated }}}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'

export default {
  props: {
    data: Object
  },
  methods: {
    onGreekDropdownClick: function () {
      var greekContainer = $('.greek-translation')
      var greekDropdown = greekContainer.children('.dropdown-drop')
      var greekDropdownArrow = greekContainer.children('p').children('.glyphicon')
      if (!greekContainer.hasClass('droped')) {
        greekContainer.addClass('droped')
        greekDropdownArrow.addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-right')
        greekDropdown.addClass('visible')
      } else {
        greekContainer.removeClass('droped')
        greekDropdownArrow.addClass('glyphicon-chevron-right').removeClass('glyphicon-chevron-down')
        greekContainer.children('.dropdown-drop').removeClass('visible')
      }
    },
    onGreekMuteClick: function () {
      var controlBtn, playBtn, frenchSound, greekSound, frenchMute
      var greekMute = $('.greek-mute .glyphicon')
      var audioLength = $('audio').length - 1
      controlBtn = $('.control')
      playBtn = controlBtn.children('.play-button')
      frenchMute = $('.french-mute .glyphicon')
      greekSound = $('audio')[audioLength]
      frenchMute.removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
      if (audioLength !== 0) {
        frenchSound = $('audio')[0]
        if (frenchSound.currentTime > 0) {
          frenchSound.pause()
          frenchSound.currentTime = 0
          frenchSound.volume = 1
        }
      }
      if (greekSound.paused) {
        greekSound.play()
        controlBtn
          .removeClass('french-sound-playing')
          .addClass('greek-sound-playing')
        playBtn.removeClass('paused')
      } else {
        if (greekSound.volume === 1) {
          greekSound.volume = 0
          greekMute.removeClass('glyphicon-volume-up').addClass('glyphicon-volume-off')
        } else {
          greekSound.volume = 1
          greekMute.removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
        }
      }
    }
  }
}
</script>

<style lang="sass" scoped>
.greek-text
  .greek-translation
    display: inline-block

    >p
      cursor: pointer
      display: inline-block
      font-style: italic
      font-size: 18px
      color: #2c2c2c
      margin: 0
      letter-spacing: 0.02em

      span.glyphicon
        font-size: 10px
        margin-left: 14px


  .dropdown-drop
    width: 350px
    margin-left: -35px

    .mute
      margin-top: 8px

    .dropdown-content
      p
        font-size: 14px
        color: #2c2c2c
        line-height: 1.5em
        padding-top: 20px
        padding-bottom: 10px
        margin: 0
        display: inline-block
        word-wrap: break-word
        width: 89%
        height: 228px
        overflow-y: auto
        scrollbar-face-color: #2c2c2c
        scrollbar-track-color: #fff
        scrollbar-arrow-color: #fff

        &::first-letter
          font-size: 36px

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
</style>
