<template>
  <div id="credits">
    <div class="page-title-container">
      <h1>Crédits</h1>
    </div>
    <div class="row content-container">
      <div class="col-md-4 col-md-offset-1">
        <div class="desc-container">
          <h3>Un projet collaboratif</h3>
          <q>
            L’Anthologie Palatine est un recueil byzantin d’épigrammes grecques dont l’ancêtre remonte à l’époque hellénistique (323-30 av. J.-C). Le manuscrit de l’Anthologie (le Codex Palatinus 23) a été retrouvé en 1606 par Claude Saumaise à Heidelberg. Ces poèmes ont dès lors exercé une influence majeure sur la littérature de la Renaissance jusqu’à aujourd’hui. Plus de détails sur Wikipedia.
            Le manuscrit est aujourd’hui conservé à la bibliothèque de l’université d’Heidelberg, où il a été numérisé et rendu disponible dans la collection numérique de la bibliothèque.
            Le texte grec de l’Anthologie est disponible sur le site du projet Perseus – superbe projet de numérisation hébergé par la Tufts University, dirigé par Gregory Crane. C’est là que nous l’avons pris. On peut consulter la traduction anglaise de W.R. Paton, disponible sur <a href="https://archive.org/" target="_blank">archive.org</a>.
            Notre site propose d’ouvrir un petit chantier de traduction de l’anthologie en Français - et en d’autres langues - auquel vous êtes invités à participer.
          </q>
        </div>
      </div>
      <div class="col-md-6 col-md-offset-1">
        <div class="team-container">
          <h4><span class="bg"></span>Notre équipe <sup>V</sup></h4>
          <ul>
            <li><a href="https://www.linkedin.com/in/milenatarriere" target="_blank">Miléna Tarrière : Chef de Projet<span class="dash"></span></a></li>
            <li><a href="http://nahelmoussi.com/" target="_blank">Nahel Moussi : UX/UI Designer site web<span class="dash"></span></a></li>
            <li><a href="http://raphaelaupee.fr/" target="_blank">Raphaël Aupée : Développeur Back<span class="dash"></span></a></li>
            <li><a href="http://paulchagnon.fr/" target="_blank">Paul Chagnon : UX/UI Designer documentation et back office<span class="dash"></span></a></li>
            <li><a href="http://valentin-crochemore.fr/" target="_blank">Valentin Crochemore : Développeur Front<span class="dash"></span></a></li>
          </ul>
          <ul>
            <li>Marcello Vitali-Rosati : Professeur à l’Univeristé de Montréal</li>
            <li>Elsa Bouchard : Professeure à l’Univeristé de Montréal</li>
            <li>Arthur Juchereau</li>
            <li>Servanne Monjour</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
        <div class="page-subtitle-container">
            <span class="dash"></span>
            <h2>L’Université de<br> Montréal & HETIC.</h2>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BackBtn from './partials/BackBtn'

import $ from 'jquery'

export default {
  components: {
    BackBtn
  },
  name: 'credits',
  ready: function () {
    var count = $('.team-container ul li').length
    var romanized = this.romanize(count)

    $('.team-container h4 sup').text(romanized)
  },
  methods: {
    romanize: function (num) {
      if (!+num) { return false }
      var digits = String(+num).split('')
      var key = ['', 'C', 'CC', 'CCC', 'CD', 'D', 'DC', 'DCC', 'DCCC', 'CM',
        '', 'X', 'XX', 'XXX', 'XL', 'L', 'LX', 'LXX', 'LXXX', 'XC',
        '', 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX']
      var roman
      roman = ''
      var i = 3
      while (i--) {
        roman = (key[+digits.pop() + (i * 10)] || '') + roman
      }
      return Array(+digits.join('') + 1).join('M') + roman
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .5s all linear
$raleway: 'Raileway', Helvetica, Arial, sans-serif

.row
  >div:first-child
    position: initial

.content-container
  position: absolute
  top: 50%
  transform: translate3d(0, -50%, 0)

#credits
  width: 100%
  height: 100%
  display: flex
  flex-direction: column
  justify-content: flex-end

.desc-container
  color: #2c2c2c
  margin-top: 40px

  h3
    font-style: italic
    font-size: 18px
    padding-left: 100px
    margin-top: 0
    letter-spacing: 0.02em

  q
    font-size: 14px
    margin-top: 80px
    display: inline-block
    quotes: "\201C""\201D""\2018""\2019"
    line-height: 1.5em

    &:before
      top: -6px

    &:after
      content: no-close-quote

    p
     padding-left: 20px

.team-container
  margin-top: 64px

  h4
    padding-left: 10px
    font-size: 10px
    font-weight: 700
    color: rgba(44, 44, 44, 0.5)
    font-family: $raleway
    position: relative
    margin-top: 0
    text-transform: uppercase
    letter-spacing: 0.1em

    sup
      font-size: 8px
      color: #2c2c2c
      font-family: initial
      padding-left: 5px

  ul
    list-style: none
    padding: 0 20px
    margin-top: 30px
    display: inline-block
    vertical-align: top

    li
      font-size: 12px
      line-height: 2em
      height: 24px

      a
        color: #2c2c2c
        transition: $hover
        display: inline-block

        .dash
          width: 100%
          height: 1px
          display: inline-table
          position: relative
          background: none
          vertical-align: top

          &:before
            content: ''
            display: block
            position: absolute
            left: 0
            bottom: 0
            height: 1px
            width: 0
            transition: width 0s ease, background .5s ease

          &:after
            content: ''
            display: block
            position: absolute
            right: 0
            bottom: 0
            height: 1px
            width: 0
            background: #2c2c2c
            transition: width .5s ease

        &:hover,
        &:focus
          text-decoration: none
          color: #000000

          .dash
            &:before
              width: 100%
              background: #2c2c2c
              transition: width .5s ease

            &:after
              width: 100%
              background: transparent
              transition: all 0s ease



.page-subtitle-container
  margin-top: 0

</style>
