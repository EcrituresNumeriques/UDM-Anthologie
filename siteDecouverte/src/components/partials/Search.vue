<template>
  <div class="search-partial scroll">
    <span class="search-scroll-progress-bar">
      <span class="scroll-dot active"></span>
      <span class="scroll-dot"></span>
      <span class="scroll-dot"></span>
      <span class="scroll-dot"></span>
      <span class="scroll-dot"></span>
      <span class="scroll-dot"></span>
      <span class="scroll-dot"></span>
      <span class="scroll-dot"></span>
      <span class="scroll-dot"></span>
      <span class="scroll-dot"></span>
    </span>
    <span class="search-scroll-arrows">
      <span @click="onScrollLeftArrowClick" class="glyphicon glyphicon-chevron-left"></span>
      <span @click="onScrollRightArrowClick" class="glyphicon glyphicon-chevron-right"></span>
    </span>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
        <div
          v-if="dataEpigram.length == 0 && dataGenre.length == 0 && dataAuthor.length == 0 && dataEra.length ==  0 && dataCity.length == 0"
        >
          <p>Il n'y a aucune donnée à afficher</p>
        </div>
        <div class="search-list vertical-list-container">
          <ul
            v-if="filteredDataEpigram.length > 0"
            class="vertical-list-wrapper"
          >
            <li v-for="epigram in filteredDataEpigram">
              <router-link to="{ name: 'epigram', params: { id: epigram.id }}"
                           @click="closeSearchPartial">
                <span class="dash">
                  <span class="inner-dash"></span>
                </span>
                {{ epigram.title }}
                <span class="type-text-bg">épigramme</span>
              </router-link>
            </li>
          </ul>
          <ul
            v-if="dataGenre.length > 0"
            v-for="genres in dataGenre"
            class="vertical-list-wrapper"
          >
            <li v-for="genre in genres.filteredGenreTranslations">
              <router-link to="{ name: 'searchGenre', params: { id: genre.id }}"
                           @click="closeSearchPartial">
                <span class="dash">
                  <span class="inner-dash"></span>
                </span>
                {{ genre.title }}
                <span class="type-text-bg">genre</span>
              </router-link>
            </li>
          </ul>
          <ul
            v-if="dataAuthor.length > 0"
            v-for="authors in dataAuthor"
            class="vertical-list-wrapper"
          >
            <li v-for="author in authors.filteredAuthorTranslations">
              <router-link to="{ name: 'searchAuthor', params: { id: author.id }}"
                           @click="closeSearchPartial">
                <span class="dash">
                  <span class="inner-dash"></span>
                </span>
                {{ author.name }}
                <span class="type-text-bg">Auteur</span>
              </router-link>
            </li>
          </ul>
          <ul
            v-if="dataEra.length > 0"
            v-for="eras in dataEra"
            class="vertical-list-wrapper"
          >
            <li v-for="era in filteredEraTranslations">
              <router-link to="{ name: 'searchEra', params: { id: era.id }}"
                           @click="closeSearchPartial">
                <span class="dash">
                  <span class="inner-dash"></span>
                </span>
                {{ era.name }}
                <span class="type-text-bg">ère</span>
              </router-link>
            </li>
          </ul>
          <ul
            v-if="dataCity.length > 0"
            v-for="cities in dataCity"
            class="vertical-list-wrapper"
          >
            <li v-for="city in filteredCities">
              <router-link to="{ name: 'searchCity', params: { id: city.id }}"
                           @click="closeSearchPartial">
                <span class="dash">
                  <span class="inner-dash"></span>
                </span>
                {{ city.name }}
                <span class="type-text-bg">Ville</span>
              </router-link>
            </li>
          </ul>
          <ul
            v-if="dataCharacter.keywords.length > 0"
            v-for="characters in dataCharacter.keywords"
            class="vertical-list-wrapper"
          >
            <li v-for="character in filteredCharactersTranslations">
              <router-link to="{ name: 'searchCharacter', params: { id: character.id }}"
                           @click="closeSearchPartial">
                <span class="dash">
                  <span class="inner-dash"></span>
                </span>
                {{ character.title }}
                <span class="type-text-bg">Personnage</span>
              </router-link>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-1 left-column">
        <div class="page-subtitle-container">
          <span class="dash">
            <span class="inner-dash"></span>
          </span>
          <h2>Recherche &<br> découverte Palatine.</h2>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ScrollProgressBar from './ProgressBar'

import $ from 'jquery'

export default {
  components: {
    ScrollProgressBar
  },
  computed: {
    filteredDataEpigram: function () {
      var self = this
      return self.dataEpigram.filter(function (epigram) {
        return epigram.title.indexOf(self.search) !== -1
      })
    },
    filteredGenreTranslations: function () {
      var self = this
      return self.genre_translations.filter(function (genreTranslation) {
        return genreTranslation.title.indexOf(self.search) !== -1
      })
    },
    filteredAuthorTranslations: function () {
      var self = this
      return self.author_translations.filter(function (authorTranslation) {
        return authorTranslation.name.indexOf(self.search) !== -1
      })
    },
    filteredEraTranslations: function () {
      var self = this
      return self.eras.era_translations.filter(function (eraTranslation) {
        return eraTranslation.name.indexOf(self.search) !== -1
      })
    },
    filteredCityTranslations: function () {
      var self = this
      return self.cities.city_translations.filter(function (cityTranslation) {
        return cityTranslation.name.indexOf(self.search) !== -1
      })
    },
    filteredCharactersTranslations: function () {
      var self = this
      return self.characters.keywords_translations.filter(function (characterTranslation) {
        return characterTranslation.title.indexOf(self.search) !== -1
      })
    }
  },
  data () {
    return {
      dataEpigram: [],
      dataGenre: {},
      dataAuthor: {},
      dataEra: {},
      dataCity: {},
      dataCharacter: {}
    }
  },
  propsData: {
    search: String
  },
  mounted: function () {
    this.onScrollProgressBar()
    this.onDotClick()
    this.getGlobalData()
  },
  methods: {
    closeSearchPartial: function () {
      $('.search-partial').fadeOut(1000)
      this.$off()
    },
    onScrollProgressBar: function () {
      var scroll = $('.search-partial.scroll')
      var self = this
      scroll.scroll(function () {
        self.scrollProgressBar()
      })
    },
    scrollProgressBar: function () {
      var scroll = $('.search-partial.scroll')
      var max = scroll[0].scrollWidth - scroll.width()
      var value = scroll.scrollLeft()
      var percentage = value / max * 100
      var dotIndex = Math.ceil(percentage / 10)
      if (dotIndex < 1) dotIndex = 0
      var dot = scroll.find('.scroll-dot')
      dot.eq(dotIndex).addClass('active')
      dot.eq(dotIndex).prevAll().addClass('active')
      dot.eq(dotIndex).nextAll().removeClass('active')
    },
    onDotClick: function () {
      var scroll = $('.search-partial.scroll')
      $('body').on('click', '.scroll-dot', function () {
        $(this).addClass('active')
        var thisIndex = $(this).index()
        var percentage = thisIndex + '0'
        var max = scroll[0].scrollWidth - scroll.width()
        var value = percentage * max / 100
        scroll.animate({
          scrollLeft: value
        })
      })
    },
    onScrollLeftArrowClick: function () {
      var scroll = $('.search-partial.scroll')
      var lastActiveIndex = $('.search-scroll-progress-bar .scroll-dot.active').last().index()
      var prevIndex = $('.search-scroll-progress-bar .scroll-dot').eq(lastActiveIndex - 1)
      prevIndex.addClass('active')
      var percentage = prevIndex.index() + '0'
      var max = scroll[0].scrollWidth - scroll.width()
      var value = percentage * max / 100
      scroll.animate({
        scrollLeft: value
      })
    },
    onScrollRightArrowClick: function () {
      var scroll = $('.search-partial.scroll')
      var lastActiveIndex = $('.search-scroll-progress-bar .scroll-dot.active').last().index()
      var nextIndex = $('.search-scroll-progress-bar .scroll-dot').eq(lastActiveIndex + 1)
      nextIndex.addClass('active')
      var percentage = nextIndex.index() + '0'
      var max = scroll[0].scrollWidth - scroll.width()
      var value = percentage * max / 100
      scroll.animate({
        scrollLeft: value
      })
    },
    getGlobalData: function () {
      var self = this
//      this.$http.get(global.apiAuth).then(function (response) {
//        self.$set('token', response.data.access_token)
      self.$http.get(global.api + 'entity' /* + filterFr + 'access_token=' + self.token*/).then(function (response) {
        self.$set('dataEpigram', response.data)
      }, function (response) {
        console.log('error: ' + response)
      })
      self.$http.get(global.api + 'genre' /* + filterFr + 'access_token=' + self.token*/).then(function (response) {
        self.$set('dataGenre', response.data)
      }, function (response) {
        console.log('error: ' + response)
      })
      self.$http.get(global.api + 'author' /* + filterFr + 'access_token=' + self.token*/).then(function (response) {
        self.$set('dataAuthor', response.data)
      }, function (response) {
        console.log('error: ' + response)
      })
      self.$http.get(global.api + 'era' /* + filterFr + 'access_token=' + self.token*/).then(function (response) {
        self.$set('dataEra', response.data)
      }, function (response) {
        console.log('error: ' + response)
      })
      self.$http.get(global.api + 'city' /* + filterFr + 'access_token=' + self.token*/).then(function (response) {
        self.$set('dataCity', response.data)
      }, function (response) {
        console.log('error: ' + response)
      })
      self.$http.get(global.api + 'keyword/family/1' /* + filterFr + 'access_token=' + self.token*/).then(function (response) {
        self.$set('dataCharacter', response.data)
      }, function (response) {
        console.log('error: ' + response)
      })
//      }, function (response) {
//        console.log('global error: ' + response.status)
//        throw (response)
//      })
    }
  }
}
</script>

<style lang="sass" scoped>
$raleway: 'Raleway', Helvetica, Arial, sans-serif
$hover: .5s all ease-out

.search-scroll-progress-bar
  position: fixed
  right: 300px
  top: 44px
  display: none
  z-index: 15

  .scroll-dot
    width: 4px
    height: 4px
    display: inline-block
    padding: 0 10px
    cursor: pointer
    position: relative

    &:after
      content: ''
      position: absolute
      width: 4px
      height: 4px
      background: #d4d4d4
      left: 50%
      top: 50%
      border-radius: 50%
      transition: $hover
      opacity: .5
      transform: translate3d(-50%, -50%, 0)

    &.active
      &:after
        background: #2c2c2c
        opacity: 1

    &.disable
      cursor: default

.search-scroll-arrows
  color: #2c2c2c
  font-size: 10px
  display: none

  .glyphicon
    cursor: pointer
    transition: $hover
    opacity: .3
    position: absolute
    top: 50%
    transform: translate3d(0, -50%, 0)
    z-index: 25
    width: 50px
    height: 50px
    display: flex
    justify-content: center
    align-items: center
    background: #ffffff

    &:hover
      opacity: 1

    &:first-child
      left: 20px

      &:hover
        transform: translate3d(-5px, -50%, 0)

    &:last-child
      right: 20px

      &:hover
        transform: translate3d(5px, -50%, 0)

.search-partial
  position: absolute
  top: 0
  left: 0
  background: #fff
  flex-direction: column
  justify-content: center
  display: none
  width: 100%
  height: 100%
  z-index: 19

  >.row
    &:last-child
      position: absolute
      width: 100%
      bottom: 0
      left: 0

  .cross-container
    position: absolute
    top: 50px
    right: 50px
    cursor: pointer
    display: flex
    width: 50px
    height: 50px
    justify-content: center
    align-items: center
    opacity: .5
    transition: $hover

    &:hover
      opacity: 1

    .cross
      width: 20px
      height: 1px
      background: #2c2c2c
      transform: rotate(45deg)

      &:after
        content: ""
        width: 20px
        height: 1px
        background: #2c2c2c
        transform: rotate(-90deg)
        position: absolute

  .search-list
    columns: 20em
    height: 100%

  ul
    list-style: none
    padding: 0
    margin: 0
    display: inline-block
    width: 100%

    li
      height: 60px

      a
        font-size: 20px
        color: rgba(44, 44, 44, 0.5)
        display: inline-block
        width: 100%
        transition: $hover
        padding: 5px 15px 5px 0
        position: relative

        .dash
          width: 20px
          height: 1px
          transition: $hover
          background: transparent
          position: relative
          margin-right: 0
          animation: marginRightOut .5s ease-out forwards

          .inner-dash
            background: #000
            height: 1px
            width: 0
            position: absolute
            top: 50%
            left: 0
            transform: translate3d(-50%, 0, 0)
            transition: $hover
            animation: activeOut .5s ease-out forwards

        sup
          font-size: 9px

        .type-text-bg
          opacity: 0
          left: 20%
          transition: $hover

        &:hover,
        &:focus
          opacity: 1
          color: #2c2c2c
          background: none
          text-decoration: none

          .dash
            animation: marginRightIn .5s ease-out .2s forwards

            .inner-dash
              animation: activeIn .5s ease-out forwards

          .type-text-bg
            opacity: 1

@keyframes activeIn
  from
    width: 0

  to
    width: 20px

@keyframes activeOut
  from
    width: 20px

  to
    width: 0

@keyframes marginRightIn
  from
    margin-right: 0

  to
    margin-right: 20px

@keyframes marginRightOut
  from
    margin-right: 20px

  to
    margin-right: 0
</style>
