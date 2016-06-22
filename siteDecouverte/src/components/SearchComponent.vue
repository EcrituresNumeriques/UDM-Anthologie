<template>
  <div class="search-component">
    <div class="row scroll">
      <scroll-progress-bar></scroll-progress-bar>
      <div class="col-md-5 col-md-offset-1 left-column">
        <div class="search-content-container">
          <div class="search-title-container">
            <h3><span>Méléagre</span><sup>310/305 av jc - 240</sup></h3>
          </div>
          <div class="search-subtext-container">
            <p>Héllénistique<span class="type-text-bg">Auteur</span></p>
          </div>
        </div>
        <div class="search-desc-container">
          <q>Il existe deux versions de son mythe. Dans la première, qui s'apparente à un conte populaire, la vie de Méléagre est liée à un tison qui, jeté dans le feu, entraîne la mort du héros. Dans la seconde, rapportée par Homère, Méléagre est un double d'Achille pendant la guerre de Troie : le héros en colère.</q>
        </div>
        <div class="page-subtitle-container">
          <span class="dash"></span>
          <h2>Recherche &<br> découverte Palatine.</h2>
        </div>
      </div>
      <div class="col-md-6 right-column">
        <div class="vertical-list-container">
          <div class="vertical-list-wrapper">
            <div>
              <h4><span class="bg"></span>épigrammes liées<sup>XII</sup></h4>
              <ul>
                <li><a href="#">AP 5.177, 37</a></li>
                <li><a href="#">AP 12.132b, 22</a></li>
                <li><a href="#">AP 5.152, 34</a></li>
                <li><a href="#">AP 7.417</a></li>
                <li><a href="#">AP 7.421 : Épitaphe «logogriphique»</a></li>
                <li><a href="#">AP 5.177, 37</a></li>
                <li><a href="#">AP 12.132b, 22</a></li>
                <li><a href="#">AP 5.152, 34</a></li>
                <li><a href="#">AP 7.417</a></li>
                <li><a href="#">AP 7.421 : Épitaphe «logogriphique»</a></li>
                <li><a href="#">AP 5.152, 34</a></li>
                <li><a href="#">AP 7.417</a></li>
                <li><a href="#">AP 5.177, 37</a></li>
                <li><a href="#">AP 12.132b, 22</a></li>
                <li><a href="#">AP 5.152, 34</a></li>
                <li><a href="#">AP 7.417</a></li>
                <li><a href="#">AP 7.421 : Épitaphe «logogriphique»</a></li>
                <li><a href="#">AP 5.177, 37</a></li>
                <li><a href="#">AP 12.132b, 22</a></li>
                <li><a href="#">AP 5.152, 34</a></li>
                <li><a href="#">AP 7.417</a></li>
                <li><a href="#">AP 7.421 : Épitaphe «logogriphique»</a></li>
                <li><a href="#">AP 5.152, 34</a></li>
                <li><a href="#">AP 7.417</a></li>
                <li><a href="#">AP 5.177, 37</a></li>
                <li><a href="#">AP 12.132b, 22</a></li>
                <li><a href="#">AP 5.152, 34</a></li>
                <li><a href="#">AP 7.417</a></li>
                <li><a href="#">AP 7.421 : Épitaphe «logogriphique»</a></li>
                <li><a href="#">AP 5.177, 37</a></li>
                <li><a href="#">AP 12.132b, 22</a></li>
                <li><a href="#">AP 5.152, 34</a></li>
                <li><a href="#">AP 7.417</a></li>
                <li><a href="#">AP 7.421 : Épitaphe «logogriphique»</a></li>
                <li><a href="#">AP 5.152, 34</a></li>
                <li><a href="#">AP 7.417</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="img-container">
          <img src="/static/img/search/meleagre.png" alt="">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ScrollProgressBar from './partials/ProgressBar.vue'

export default {
  components: {
    ScrollProgressBar
  },
  name: 'search'
}
</script>

<style lang="sass" scoped>
$raleway: 'Raleway', Helvetica, Arial, sans-serif

.search-component
  width: 100%
  height: 100%

  >.row
    width: 100%
    height: 100%

  .left-column
    height: 100%
    display: flex
    flex-direction: column
    justify-content: flex-end

    .search-title-container
      h3
        font-size: 18px
        font-weight: 700
        text-transform: capitalize
        display: inline-block
        letter-spacing: 1px

        span
          display: inline-table

          &:after
            content: ""
            width: 100%
            height: 1px
            background: #2c2c2c
            display: inline-block
            vertical-align: top

        sup
          font-size: 12px
          font-style: italic
          color: rgba(44, 44, 44, .5)
          vertical-align: super

    .search-subtext-container
      position: relative
      margin-left: 100px

      p
        font-size: 18px
        font-style: italic

        .type-text-bg
          opacity: 1
          font-style: normal
          font-size: 48px
          padding-left: 10px

    .search-desc-container
      width: 300px
      margin: 80px 0

      q
        line-height: 20px

        &:before
          top: 0

  .right-column
    height: 100%
    display: flex
    flex-direction: column
    justify-content: flex-end

    .vertical-list-container
      height: 27%

    .img-container
      align-self: flex-end
      margin-right: 130px
      margin-bottom: 45px
      margin-top: 100px
</style>
