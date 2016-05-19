<template>
    <div class="epigram">
        <div class="page-title-container">
            <h1>AP 12.132b, 22</h1>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-1">
                <div class="themes">
                    <span class="dash"></span>
                    <a v-link="{ name: 'summary', params: { theme: 'maleagre-in-love' }}">Les thèmes</a>
                </div>
            </div>
            <div class="col-md-1 col-md-offset-7">
                <div class="index">
                    <p class="total">09</p>
                    <span class="separator"></span>
                    <p class="active">02</p>
                </div>
                <div class="arrows">
                    <span><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></span>
                    <span class="separator"></span>
                    <span><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></span>
                </div>
            </div>
            <div class="col-md-1 col-md-offset-1">
                <div class="player">
                    <div class="control">
                        <span class="glyphicon glyphicon-play"></span>
                    </div>
                    <div class="progressbar">
                        <span class="progress"></span>
                    </div>
                </div>
                <div class="mute">
                  <span class="glyphicon glyphicon-volume-up"></span>
                </div>
                <div class="sound">
                    <audio>
                        <source src="../static/sound/sound.mp3" type="audio/mpeg">
                    </audio>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-container">
                    <div class="text-theme">
                        <h2>Méléagre in love</h2>
                    </div>
                    <div class="text-title">
                        <h3>AP 12.132b, 22</h3>
                        <div class="text-lang">
                            <select>
                                <option value="fr">Fr</option>
                                <option value="gr">Gr</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-content">
                        <p>
                        Ame douloureuse, tantôt tu brûles de fièvre,<br>
                        tantôt tu te refroidis, ayant repris ton souffle.<br>
                        Pourquoi pleures-tu? Erôs l’inébranlable, lorsque sur ton sein,<br>
                        tu le nourrissais, tu ne savais pas qu’il était nourri contre toi?<br>
                        tu ne savais pas? Maintenant, apprends la récompense des beaux soins, ayant reçu fièvre et eau gelée.<br>
                        Toi-même, tu les as choisis. Supporte ta peine. Tu subis des choses dignes de ce que tu as fait, en étant brûlée par un miel rôti.
                        </p>
                    </div>
                    <div class="text-author">
                        <span class="dash"></span>
                        <p>Méléagre</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-1">
                <div class="greek-translation">
                    <p>Traduction grecque
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="border-bottom"></span>
                    </p>
                </div>
            </div>
            <div class="col-md-3 col-md-offset-4">
                <div class="notes">
                    <p>Les notes
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="border-bottom"></span>
                    </p>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-2">
                <div class="characters">
                    <p>Les personnages
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="border-bottom"></span>
                    </p>
                    <!--<div class="characters-list">
                        <ul>
                            <li><a href="#"><span class="dash"></span>Eros</a></li>
                            <li><a href="#"><span class="dash"></span>Ulysse</a></li>
                            <li><a href="#"><span class="dash"></span>Odyssey</a></li>
                        </ul>
                    </div>-->
                    <div class="characters-text-container">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <div class="characters-text-wrapper">
                            <div class="characters-text">
                                <div class="characters-title">
                                    <h4>Ulysse</h4>
                                </div>
                                <div class="characters-desc">
                                    <q>Dieu de l’Amour, dans la mythologie grecque. Le personnage d'Éros est souvent utilisé comme figure allégorique représentant le désir ou le plaisir sexuels, ou plus généralement la pulsion de vie, et souvent opposé à Thanatos, dieu de la Mort.</q>
                                </div>
                            </div>
                        </div>
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-md-offset-3">
                <div class="manuscript-image">
                    <p>Image du manuscrit
                        <span class="border-bottom"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import $ from 'jquery'

$(document).ready(function () {
  var flag = true
  $('body').on('click', '.control', function () {
    if (flag) {
      $('audio')[0].play()
      $('.control .glyphicon').removeClass('glyphicon-play').addClass('glyphicon-pause')
      flag = false
    } else {
      $('audio')[0].pause()
      $('.control .glyphicon').removeClass('glyphicon-pause').addClass('glyphicon-play')
      flag = true
    }
  })

  $('audio').on('timeupdate', function (e) {
    var currentTime = $('audio')[0].currentTime
    var duration = $('audio')[0].duration

    var percent = currentTime / duration * 100
    console.log('timeupdate')
    $('.progress').css('height', percent + '%')
  })

  $('audio').on('ended', function () {
    console.log('ended')
    $('.progress').css('height', '0')
    $('.control .glyphicon').removeClass('glyphicon-pause').addClass('glyphicon-play')
  })

  var muteFlag = true
  $('body').on('click', '.mute span', function () {
    if (muteFlag) {
      $('audio')[0].volume = 0
      $('.mute span').removeClass('glyphicon-volume-up').addClass('glyphicon-volume-off')
      muteFlag = false
    } else {
      $('audio')[0].volume = 1
      $('.mute span').removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
      muteFlag = true
    }
  })

  var heightFlag = true
  $('body').on('click', '.characters', function () {
    if (heightFlag) {
      var charHeight = $('.characters-list ul').height()
      $('.characters-list').css('height', charHeight)
      heightFlag = false
    } else {
      $('.characters-list').css('height', '0')
      heightFlag = true
    }
  })
})
</script>

<style lang="sass" scoped>
$raleway: 'Raileway', Helvetica, Arial, sans-serif
$hover: .2s all linear

.epigram
  width: 100%
  height: 100%

  >.row
    padding-top: 200px

.themes
  .dash
    width: 19px
    height: 1px
    margin-right: 20px

  a
    font-family: $raleway
    font-size: 12px
    font-weight: 600
    color: #000
    display: inline-block

.index
  position: relative

  p
    position: absolute
    color: #2c2c2c

    &.total
      font-weight: 700
      font-size: 16px
      right: 0
      top: 0

    &.active
      font-size: 48px
      right: 23px
      top: 10px

  span.separator
    position: absolute
    right: 5px
    top: 18px
    width: 30px
    height: 1px
    transform: rotate(45deg)
    background: #2c2c2c

.arrows
  width: 55px
  float: right
  margin-top: 90px
  display: flex
  justify-content: space-between
  align-items: center

  &:after
    clear: both

  .separator
    height: 10px
    width: 1px
    background: #2c2c2c
    display: inline-block
    opacity: 0.15

  >span
    a
      font-size: 10px
      color: #2c2c2c
      opacity: 0.6
      transition: $hover

      &:hover
        text-decoration: none
        opacity: 1

.player
  width: 38px
  text-align: center

  .control
    cursor: pointer
    width: 100%
    height: 38px
    line-height: 38px
    border-radius: 50%
    display: inline-block
    border: 1px solid #2c2c2c
    text-align: center

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

.mute
  span
    cursor: pointer

.text-container
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
      right: 85px
      margin-top: -5px

      select
        font-size: 8px
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

.border-bottom
  width: 100%
  height: 2px
  background: #2c2c2c
  display: inline-block
  vertical-align: top

.greek-translation
  p
    cursor: pointer
    display: inline-block
    font-style: italic
    font-size: 18px
    color: #2c2c2c

    span.glyphicon
      font-size: 10px
      margin-left: 14px

.notes,
.characters
  p
   font-style: italic
   font-weight: 700
   font-size: 14px
   color: #727272
   cursor: pointer
   display: inline-block

   span.glyphicon
      font-size: 10px
      margin-left: 14px

.notes
  margin-top: 60px

.characters
  margin-top: 150px
  position: relative

  .characters-list
    position: absolute
    height: 0
    overflow: hidden
    transition: $hover
    z-index: 2

    ul
      list-style: none
      padding: 0

      li
        a
          font-size: 14px
          opacity: 0.5
          transition: $hover
          color: #2c2c2c

          .dash
            width: 0
            height: 1px
            margin-right: 0
            transition: $hover

          &:hover
            opacity: 1
            text-decoration: none

            .dash
              width: 13px
              margin-right: 15px

.manuscript-image
  margin-top: 25px

  p
   font-family: $raleway
   font-size: 12px
   font-weight: 600
   display: inline-block
   cursor: pointer

</style>
