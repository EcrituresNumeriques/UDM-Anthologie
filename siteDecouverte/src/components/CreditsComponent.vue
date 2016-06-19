<template>
  <div id="credits">
    <div class="page-title-container">
      <h1>Crédits</h1>
    </div>
    <div class="row back-btn-container">
      <div class="col-md-12 col-md-offset-1">
        <back-btn></back-btn>
      </div>
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
            <li>Marcello Vitali-Rosati : Professeur à l’Univeristé de Montréal</li>
            <li>Elsa Bouchard : Professeure à l’Univeristé de Montréal</li>
            <li>Arthur Juchereau</li>
            <li>Servanne Monjour</li>
          </ul>
          <ul>
            <li>Miléna Tarrière : Chef de Projet</li>
            <li>Nahel Moussi : UX/UI Designer</li>
            <li>Raphaël Aupée : Développeur Back</li>
            <li>Paul Chagnon : UX/UI Designer</li>
            <li>Valentin Crochemore : Développeur Front</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
        <div class="page-subtitle-container">
            <span class="dash"></span>
            <h2>L’Université de<br> Montréal & Hétic.</h2>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BackBtn from './partials/BackBtn'

export default {
  components: {
    BackBtn
  },
  name: 'credits'
}
</script>

<style lang="sass" scoped>
$hover: .2s all linear
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
    line-height: 20px;
    margin-top: 80px
    display: inline-block
    quotes: "\201C""\201D""\2018""\2019"

    &:before
      font-size: 30px
      margin-bottom: -15px
      vertical-align: bottom
      display: inline-block

    &:after
      content: no-close-quote

    p
     padding-left: 20px

.team-container
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

    li
      font-size: 12px
      color: #2c2c2c
      line-height: 2em

.page-subtitle-container
  margin-top: 0

</style>
