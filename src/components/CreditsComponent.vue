<template>
  <div id="credits">
    <div class="page-title-container">
      <h1>Crédits</h1>
    </div>
    <div class="row content-container">
      <div class="col-md-6 col-md-offset-1">
        <div class="desc-container">
          <h3>Un projet collaboratif</h3>
          <q>
            La Plateforme Ouverte des Parcours d'imaginaires (la POP) propose une édition numérique collaborative de l'Anthologie Palatine (AP) dirigée par la <a href="https://ecrituresnumeriques.ca/fr/Objets-de-recherche/">Chaire en Recherche du Canada sur les écritures numériques</a> (CRC) et son équipe interdisciplinaire et internationale (dirigée par Marcello Vitali-Rosati) en collaboration avec Elsa Bouchard et l'équipe d'HETIC. L’Anthologie Palatine est un recueil d’épigrammes grecques dont la source remonte à l’époque hellénistique (323-30 av. J.-C) qui a dès lors exercé une influence majeure sur la littérature, de la Renaissance jusqu’à nos jours. La POP propose une visualisation des versions grecques des épigrammes de l'AP et ses traductions, leurs métadonnées (auteur, date, lieu et mots-clefs) sous la forme de parcours de lecture thématiques. L'usager est invité à collaborer à cette édition en proposant directement sur la plateforme <a href="https://anthologia.ecrituresnumeriques.ca/home">Anthologia</a> des liens faibles, soit en associant à l’épigramme une référence (textuelle, iconographique, musicale, cinématographique ou autre) qui témoigne de l’imaginaire collectif suggéré par l’épigramme et vient ainsi ainsi enrichir le matériel anthologique.

             Sur la POP sont disponibles les versions grecques des épigrammes de l'AP et ses traductions (en français, anglais et italien), leurs métadonnées (auteur, date, lieu et mots-clefs) sous la forme de parcours de lecture thématiques. L'usager est invité à collaborer à cette édition en proposant des liens faibles, soit en associant à l’épigramme une référence (textuelle, iconographique, musicale, cinématographique ou autre) qui témoigne de l’imaginaire collectif suggéré par l’épigramme et vient ainsi ainsi enrichir le matériel anthologique. Ce projet invite donc à une appropriation d’un objet littéraire insaisissable soit à comprendre et associer l’AP avec nos propres chimères intérieures.

            <br><br>Pour plus d’informations, consultez le <a href="http://anthologia-doc.ecrituresnumeriques.ca/fr_FR/">site web</a> du projet.
          </q>
        </div>
      </div>
      <div class="col-md-4 col-md-offset-1">
        <div class="team-container">
          <h4><span class="bg"></span>Équipe Université de Montréal <sup></sup></h4>

          <ul>
            <li>Marcello Vitali-Rosati</li>
            <li>Elsa Bouchard</li>
            <li>Margot Mellet</li>
            <li>Arthur Juchereau</li>
            <li>Servanne Monjour</li>
            <li>Louis-Olivier Brassard</li>
            <li>Enrico Agostini-Marchese</li>
          </ul>

          <h4><span class="bg"></span>Équipe HETIC <sup></sup></h4>

          <ul>
            <li><a href="https://www.linkedin.com/in/milenatarriere" target="_blank">Miléna Tarrière : Chef de Projet<span class="dash"></span></a></li>
            <li><a href="http://nahelmoussi.com/" target="_blank">Nahel Moussi : UX/UI Designer site web<span class="dash"></span></a></li>
            <li><a href="http://raphaelaupee.fr/" target="_blank">Raphaël Aupée : Développeur Back<span class="dash"></span></a></li>
            <li><a href="http://paulchagnon.fr/" target="_blank">Paul Chagnon : UX/UI Designer documentation et back office<span class="dash"></span></a></li>
            <li><a href="http://valentin-crochemore.fr/" target="_blank">Valentin Crochemore : Développeur Front<span class="dash"></span></a></li>
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
  created: function () {
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
  //position: absolute
  //top: 50%
  //transform: translate3d(0, -50%, 0)

#credits
  width: 100%
  height: 100%
  display: flex
  flex-direction: column
  justify-content: flex-end

.desc-container
  color: #2c2c2c
  margin-top: 20vh
  padding: 40px 20px
  max-height: 66vh
  overflow: scroll


  h3
    font-style: italic
    font-size: 18px
    padding-left: 100px
    margin-top: 0
    letter-spacing: 0.02em

  q
    font-size: 14px
    margin-top: 1.2em
    display: inline-block
    quotes: "\201C""\201D""\2018""\2019"
    line-height: 1.5em

    &:before
      top: -6px

    &:after
      content: no-close-quote

    a
      .dash
        height: 1px
        display: inline-table
        position: relative
        background: none

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
          background: #337ab7
          transition: width .5s ease


      &:hover,
      &:focus
        text-decoration: none
        color: #337ab7

        .dash
          &:before
            width: 100%
            background: #337ab7
            transition: width .5s ease

          &:after
            width: 100%
            background: transparent
            transition: all 0s ease


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
    margin-bottom: 30px
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
