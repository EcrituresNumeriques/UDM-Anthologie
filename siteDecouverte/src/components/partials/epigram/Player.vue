<template>
  <div class="col-md-1 col-md-offset-1 player">
    <div
      v-if="data.themes[theme].epigrams[epigram].sounds"
      class="player"
    >
      <div
        @click="onControlClick"
        class="control"
      >
        <a class="play-button paused" href="#">
          <div class="left"></div>
          <div class="right"></div>
          <div class="triangle-1"></div>
          <div class="triangle-2"></div>
        </a>
      </div>
      <div class="progressbar">
        <span class="progress"></span>
      </div>
    </div>
    <div
      v-if="data.themes[theme].epigrams[epigram].sounds"
      class="sound"
    >
      <audio
        @timeupdate="onAudioTimeUpdate"
        @ended="onAudioEnded"
        class="french-sound"
      >
        <source
          :src="data.themes[theme].epigrams[epigram].sounds.french"
          type="audio/mpeg"
        >
      </audio>
      <audio
        @timeupdate="onAudioTimeUpdate"
        @ended="onAudioEnded"
        class="greek-sound"
      >
        <source
          :src="data.themes[theme].epigrams[epigram].sounds.greek"
          type="audio/mpeg"
        >
      </audio>
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
    onControlClick: function () {
      var playBtn, frenchSound, greekSound
      var controlBtn = $('.control')
      playBtn = controlBtn.children('.play-button')
      frenchSound = $('audio')[0]
      greekSound = $('audio')[1]
      if (controlBtn.hasClass('french-sound-playing')) {
        if (!frenchSound.paused) {
          frenchSound.pause()
          playBtn.addClass('paused')
          $('.french-mute span').removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
          frenchSound.volume = 1
        } else {
          frenchSound.play()
          playBtn.removeClass('paused')
        }
      } else if (controlBtn.hasClass('greek-sound-playing')) {
        if (!greekSound.paused) {
          greekSound.pause()
          playBtn.addClass('paused')
          $('.greek-mute span').removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
          greekSound.volume = 1
        } else {
          greekSound.play()
          playBtn.removeClass('paused')
        }
      } else {
        frenchSound.play()
        playBtn.removeClass('paused')
        controlBtn.addClass('french-sound-playing')
      }
    },
    onAudioTimeUpdate: function () {
      var currentTime, duration, frenchSound, greekSound, progressBar, controlBtn
      controlBtn = $('.control')
      frenchSound = $('audio')[0]
      greekSound = $('audio')[1]
      progressBar = $('.progress')
      if (controlBtn.hasClass('french-sound-playing')) {
        currentTime = frenchSound.currentTime
        duration = frenchSound.duration
      } else {
        currentTime = greekSound.currentTime
        duration = greekSound.duration
      }
      var percent = currentTime / duration * 100
      progressBar.css('height', percent + '%')
    },
    onAudioEnded: function () {
      var controlBtn, playBtn, frenchSound, greekSound, muteBtn, progressBar
      controlBtn = $('.control')
      playBtn = controlBtn.children('.play-button')
      muteBtn = $('.mute span')
      frenchSound = $('audio')[0]
      greekSound = $('audio')[1]
      progressBar = $('.progress')
      progressBar.css('height', '0')
      controlBtn.removeClass('french-sound-playing').removeClass('greek-sound-playing')
      playBtn.addClass('paused')
      muteBtn.removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
      frenchSound.volume = 1
      greekSound.volume = 1
    }
  }
}
</script>

<style lang="sass" scoped>
.player
  width: 45px
  text-align: center
  margin-right: 50px

  .control
    cursor: pointer
    width: 100%
    height: 45px
    border-radius: 50%
    display: flex
    border: 1px solid #2c2c2c
    justify-content: center
    align-items: center

    .play-button
      height: 10px
      width: 10px
      display: inline-block
      overflow: hidden
      position: relative

      .left,
      .right
        height: 10px
        background: #2c2c2c
        transition: all 0.25s ease
        width: 3px

      .left
        float: left
        overflow: hidden

      .right
        float: right

      .triangle-1
        transform: translate(0, -100%)

      .triangle-2
        transform: translate(0, 100%)

      .triangle-1,
      .triangle-2
        position: absolute
        top: 0
        right: 0
        background: transparent
        width: 0
        height: 0
        border-right: 10px solid #fff
        border-top: 5px solid #2c2c2c
        border-bottom: 5px solid #2c2c2c
        transition: transform 0.25s ease

      &.paused
        .left,
        .right
          width: 50%

        .triangle-1
          transform: translate(0, -50%)

        .triangle-2
          transform: translate(0, 50%)

  .progressbar
    height: 300px
    width: 1px
    display: inline-block
    background: rgba(44, 44, 44, 0.2)

    .progress
      display: inline-block
      width: 100%
      height: 0
      background: #2c2c2c
</style>
