<template>
    <div class="epigram">
        <div class="page-title-container">
            <h1>AP 12.132b, 22</h1>
        </div>
        <div class="row">
            <div class="col-md-2 col-md-offset-1">
                <div class="inner-links">
                    <a v-link="{ name: 'summary', params: { theme: 'maleagre-in-love' }}">
                      <span class="dash"></span>
                      Les thèmes
                    </a>
                </div>
            </div>
            <div class="col-md-1 col-md-offset-7">
                <div class="index">
                    <p class="total">09</p>
                    <span class="separator"></span>
                    <p class="active">01</p>
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
                <div class="sound">
                    <audio class="french-sound">
                        <source src="../static/sound/sound.mp3" type="audio/mpeg">
                    </audio>
                    <audio class="greek-sound">
                      <source src="../static/sound/sound-greek.mp3" type="audio/mpeg">
                    </audio>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mute french-mute">
                  <span class="glyphicon glyphicon-volume-up"></span>
                </div>
                <div class="text-container">
                    <div class="text-theme">
                        <h2>
                          <span class="bg"></span>
                          Méléagre in love
                        </h2>
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
                <div class="greek-translation dropdown">
                    <p>Traduction grecque
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="border-bottom"></span>
                    </p>
                    <div class="dropdown-drop">
                      <div class="dropdown-content">
                        <div class="mute greek-mute">
                          <span class="glyphicon glyphicon-volume-up"></span>
                        </div>
                        <p>ἆ ψυχὴ βαρύμοχθε, σὺ δ' ἄρτι μὲν ἐκ πυρὸς αἴθῃ,
                          ἄρτι δ' ἀναψύχεις πνεῦμ' ἀναλεξαμένη.
                          τί κλαίεις; τὸν ἄτεγκτον ὅτ' ἐν κόλποισιν Ἔρωτα
                          ἔτρεφες, οὐκ ᾔδεις, ὡς ἐπὶ σοὶ τρέφετο;
                          οὐκ ᾔδεις; νῦν γνῶθι καλῶν ἄλλαγμα τροφείων,
                          πῦρ ἅμα καὶ ψυχρὰν δεξαμένη χιόνα.
                          αὐτὴ ταῦθ' εἵλου· φέρε τὸν πόνον. ἄξια πάσχεις,
                          ὧν ἔδρας, ὀπτῷ καιομένη μέλιτι.</p>
                      </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-md-offset-4">
                <div class="notes dropdown">
                    <p>Les notes
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="border-bottom"></span>
                    </p>
                    <div class="dropdown-drop">
                        <div class="dropdown-text-container">
                            <span class="glyphicon glyphicon-chevron-left dropdown-arrow dropdown-arrow-left"></span>
                            <div class="dropdown-text-wrapper">
                                <div class="dropdown-text visible" id="note1">
                                    <div class="dropdown-desc">
                                        <q>Méléagre parle à son âme et la réprimande d’avoir fait confiance à Érôs. Érôs est un personnage fréquent dans les épigrammes, en particulier celles de Méléagre....</q>
                                    </div>
                                </div>
                                <div class="dropdown-text" id="note2">
                                    <div class="dropdown-desc">
                                        <q>Dieu de l’Amour, dans la mythologie grecque. Le personnage d'Éros est souvent utilisé comme figure allégorique représentant le désir ou le plaisir sexuels, ou plus généralement la pulsion de vie, et souvent opposé à Thanatos, dieu de la Mort.</q>
                                    </div>
                                </div>
                                <div class="dropdown-text" id="note3">
                                    <div class="dropdown-desc">
                                        <q>Dieu de l’Amour, dans la mythologie grecque. Le personnage d'Éros est souvent utilisé comme figure allégorique représentant le désir ou le plaisir sexuels, ou plus généralement la pulsion de vie, et souvent opposé à Thanatos, dieu de la Mort.</q>
                                    </div>
                                </div>
                            </div>
                            <span class="glyphicon glyphicon-chevron-right dropdown-arrow dropdown-arrow-right"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-2">
                <div class="characters dropdown">
                    <p>Les personnages
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="border-bottom"></span>
                    </p>
                    <div class="dropdown-drop">
                        <ul>
                            <li><a data-click="eros" href="#"><span class="dash"></span>Eros</a></li>
                            <li><a data-click="ulysse" href="#"><span class="dash"></span>Ulysse</a></li>
                            <li><a data-click="odyssey" href="#"><span class="dash"></span>Odyssey</a></li>
                        </ul>
                    </div>
                    <div class="dropdown-text-container">
                        <span class="glyphicon glyphicon-chevron-left dropdown-arrow dropdown-arrow-left"></span>
                        <div class="dropdown-text-wrapper">
                            <div class="dropdown-text" id="eros">
                                <div class="dropdown-title">
                                  <h4>Eros</h4>
                                </div>
                                <div class="dropdown-desc">
                                  <q>Dieu de l’Amour, dans la mythologie grecque. Le personnage d'Éros est souvent utilisé comme figure allégorique représentant le désir ou le plaisir sexuels, ou plus généralement la pulsion de vie, et souvent opposé à Thanatos, dieu de la Mort.</q>
                                </div>
                            </div>
                            <div class="dropdown-text" id="ulysse">
                                <div class="dropdown-title">
                                    <h4>Ulysse</h4>
                                </div>
                                <div class="dropdown-desc">
                                    <q>Dieu de l’Amour, dans la mythologie grecque. Le personnage d'Éros est souvent utilisé comme figure allégorique représentant le désir ou le plaisir sexuels, ou plus généralement la pulsion de vie, et souvent opposé à Thanatos, dieu de la Mort.</q>
                                </div>
                            </div>
                            <div class="dropdown-text" id="odyssey">
                                <div class="dropdown-title">
                                    <h4>Odyssey</h4>
                                </div>
                                <div class="dropdown-desc">
                                    <q>Dieu de l’Amour, dans la mythologie grecque. Le personnage d'Éros est souvent utilisé comme figure allégorique représentant le désir ou le plaisir sexuels, ou plus généralement la pulsion de vie, et souvent opposé à Thanatos, dieu de la Mort.</q>
                                </div>
                            </div>
                        </div>
                        <span class="glyphicon glyphicon-chevron-right dropdown-arrow dropdown-arrow-right"></span>
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
        <div class="manuscript-popin">
          <img src="~assets/img/popin/manuscript.png">
        </div>
    </div>
</template>

<script>
import $ from 'jquery'

$(document).ready(function () {
  var body = $('body')
  var controlBtn, playBtn, frenchSound, greekSound, progressBar, muteBtn
  var sound = $('audio')

  body.on('click', '.control', function () {
    var self = $(this)
    playBtn = self.children('.play-button')
    frenchSound = $('audio')[0]
    greekSound = $('audio')[1]
    if (self.hasClass('french-sound-playing')) {
      if (!frenchSound.paused) {
        frenchSound.pause()
        playBtn.addClass('paused')
      } else {
        frenchSound.play()
        playBtn.removeClass('paused')
      }
    } else if (self.hasClass('greek-sound-playing')) {
      if (!greekSound.paused) {
        greekSound.pause()
        playBtn.addClass('paused')
      } else {
        greekSound.play()
        playBtn.removeClass('paused')
      }
    } else {
      frenchSound.play()
      playBtn.removeClass('paused')
      self.addClass('french-sound-playing')
    }
  })

  body.on('click', '.french-mute span', function () {
    var self = $(this)
    controlBtn = $('.control')
    playBtn = controlBtn.children('.play-button')
    frenchSound = $('audio')[0]
    greekSound = $('audio')[1]
    $('.greek-mute span').removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
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
        self.removeClass('glyphicon-volume-up').addClass('glyphicon-volume-off')
      } else {
        frenchSound.volume = 1
        self.removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
      }
    }
  })

  body.on('click', '.greek-mute span', function () {
    var self = $(this)
    controlBtn = $('.control')
    playBtn = controlBtn.children('.play-button')
    frenchSound = $('audio')[0]
    greekSound = $('audio')[1]
    $('.french-mute span').removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
    if (frenchSound.currentTime > 0) {
      frenchSound.pause()
      frenchSound.currentTime = 0
      frenchSound.volume = 1
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
        self.removeClass('glyphicon-volume-up').addClass('glyphicon-volume-off')
      } else {
        greekSound.volume = 1
        self.removeClass('glyphicon-volume-off').addClass('glyphicon-volume-up')
      }
    }
  })
  sound.on('timeupdate', function (e) {
    var currentTime, duration
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
  })

  sound.on('ended', function () {
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
  })

  function onDropdownClick (dropdown) {
    var self = dropdown
    var selfArrow = self.children('.glyphicon')
    var selfParent = self.parent('.dropdown')
    var selfList = selfParent.children('.dropdown-drop')
    if ($('#note1').hasClass('visible')) {
      $('.notes .glyphicon-chevron-left').hide()
    }
    if (!selfParent.hasClass('droped')) {
      selfParent.addClass('droped')
      selfList.addClass('visible').next('.dropdown-text-container').addClass('visible')
      selfArrow.addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-right')
    } else {
      selfParent.removeClass('droped')
      selfList.removeClass('visible')
        .next('.dropdown-text-container')
          .removeClass('visible').fadeOut('500')
            .find('.dropdown-text').removeClass('visible').fadeOut('500')
      selfArrow.addClass('glyphicon-chevron-right').removeClass('glyphicon-chevron-down')
    }
  }

  $('body').on('click', '.dropdown > p', function () {
    onDropdownClick($(this))
  })

  $('body').on('click', '.dropdown-drop a', function (e) {
    e.preventDefault()
    var self = $(this)
    var selfData = self.data('click')
    var selfParent = self.parents('.dropdown-drop')
    var selfTextContainer = selfParent.siblings('.dropdown-text-container')
    var selfDropWrapper = selfTextContainer.children('.dropdown-text-wrapper')
    var selfDropText = selfDropWrapper.children()
    var selfDropTextLength = selfDropText.length
    var selfArrowLeft = selfTextContainer.children('.dropdown-arrow-left')
    var selfArrowRight = selfTextContainer.children('.dropdown-arrow-right')
    selfTextContainer.css('display', 'flex')
    $('#' + selfData).addClass('visible').fadeIn('500')
    var selfDropTextVisibleIndex = $('#' + selfData).index()
    selfArrowLeft.show()
    selfArrowRight.show()
    if (selfDropTextVisibleIndex === 0) {
      selfArrowLeft.hide()
    } else if (selfDropTextVisibleIndex === selfDropTextLength - 1) {
      selfArrowRight.hide()
    }
  })

  function onDropArrowClick (arrow) {
    var self = arrow
    var selfDropWrapper = self.siblings('.dropdown-text-wrapper')
    var selfDropText = selfDropWrapper.children()
    var selfDropTextLength = selfDropText.length
    var selfDropTextVisible = selfDropWrapper.children('.dropdown-text.visible')
    var selfDropTextVisibleIndex = selfDropTextVisible.index()

    self.show()
    self.siblings('.glyphicon').show()
    if (arrow.hasClass('dropdown-arrow-left')) {
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

  body.on('click', '.dropdown-arrow-left', function () {
    onDropArrowClick($(this))
  })

  body.on('click', '.dropdown-arrow-right', function () {
    onDropArrowClick($(this))
  })

  var manuscriptPopin = $('.manuscript-popin')
  var manuscriptImage = manuscriptPopin.children('img')
  body.on('click', '.manuscript-image > p', function () {
    manuscriptPopin.fadeIn(function () {
      manuscriptImage.addClass('big')
    }).css('display', 'flex')
  })

  body.on('click', '.manuscript-popin', function () {
    manuscriptImage.removeClass('big')
    manuscriptPopin.fadeOut()
  })
})
</script>

<style lang="sass" scoped>
$raleway: 'Raleway', Helvetica, Arial, sans-serif
$hover: .2s all ease-out

.epigram
  width: 100%
  height: 100%

  >.row
    position: absolute
    bottom: 15%
    width: 100%
    z-index: 2

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
      opacity: 0.3
      transition: $hover
      display: block

      &:hover
        text-decoration: none
        opacity: 1

    &:first-child,
    &:last-child
      flex-grow: 2

    &:first-child
      a
        &:hover
          transform: translateX(-5px)

    &:last-child
      text-align: right

      a
        &:hover
          transform: translateX(5px)

.player
  width: 45px
  text-align: center

  .control
    cursor: pointer
    width: 100%
    height: 45px
    line-height: 45px
    border-radius: 50%
    display: inline-block
    border: 1px solid #2c2c2c
    text-align: center

    .play-button
      height: 10px
      width: 10px
      display: inline-block
      overflow: hidden
      position: relative
      margin: 0 auto

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

    .paused
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

.mute
  display: inline-block
  vertical-align: top
  margin-top: 72px
  margin-right: 15px

  span
    color: #2c2c2c
    font-size: 16px
    cursor: pointer

.text-container,
.greek-translation
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


  .text-content,
  .dropdown-drop
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

.dropdown.greek-translation
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
    width: 400px
    margin-left: -35px

    .mute
      margin-top: 20px

    .dropdown-content
      >p
        padding-top: 20px
        padding-bottom: 10px
        margin: 0
        display: inline-block
        width: 80%

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

.notes.dropdown
  margin-top: 60px

  .dropdown-drop
    width: 100%
    padding-left: 20px;
    margin-left: -20px;

  .dropdown-text-container
    display: flex
    background: none

    .dropdown-text-wrapper
      width: 170px

      .dropdown-text
        .dropdown-desc
          q
            &:before
              top: -10px

    #note1
      display: initial

.characters
  margin-top: 150px

  .dropdown-text-container
    opacity: 0

    &.visible
      opacity: 1

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

  .dropdown-text-container
    display: none
    align-items: center
    height: auto
    overflow: initial
    background: #fff

    span.glyphicon
      opacity: .6
      font-size: 9px
      cursor: pointer
      transition: $hover

      &:first-child
        margin-right: 10px
        margin-left: -20px

      &:last-child
        margin-left: 20px

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

.manuscript-image
  margin-top: 25px

  p
   font-family: $raleway
   font-size: 12px
   font-weight: 600
   display: inline-block
   cursor: pointer

</style>
