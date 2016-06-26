<template>
  <div class="search-partial scroll">
    <scroll-progress-bar></scroll-progress-bar>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
        <div
          v-if="dataEpigram.length == 0 && dataGenre.length == 0 && dataAuthor.length == 0 && dataEra.length ==  0 && dataCity.length == 0"
        >
          <p>Il n'y a aucune donnée à aficher</p>
        </div>
        <div class="search-list vertical-list-container">
          <ul
            v-if="dataEpigram.length > 0"
            class="vertical-list-wrapper"
          >
            <li v-for="epigram in dataEpigram | filterBy search in 'title' ">
              <a
                @click="closeSearchPartial"
                v-link="{ name: 'epigram', params: { id: epigram.id }}">
                <span class="dash">
                  <span class="inner-dash"></span>
                </span>
                {{ epigram.title }}
                <sup>I</sup>
                <span class="type-text-bg">épigramme</span>
              </a>
            </li>
          </ul>
          <ul
            v-if="dataGenre.length > 0"
            v-for="genres in dataGenre"
            class="vertical-list-wrapper"
          >
            <li v-for="genre in genres.genre_translations | filterBy search in 'title' ">
              <a
                @click="closeSearchPartial"
                v-link="{ name: 'searchGenre', params: { id: genre.id }}">
                <span class="dash">
                  <span class="inner-dash"></span>
                </span>
                {{ genre.title }}
                <sup>I</sup>
                <span class="type-text-bg">genre</span>
              </a>
            </li>
          </ul>
          <ul
            v-if="dataAuthor.length > 0"
            v-for="authors in dataAuthor"
            class="vertical-list-wrapper"
          >
            <li v-for="author in authors.author_translations | filterBy search in 'name' ">
              <a
                @click="closeSearchPartial"
                v-link="{ name: 'searchAuthor', params: { id: author.id }}">
                <span class="dash">
                  <span class="inner-dash"></span>
                </span>
                {{ author.name }}
                <sup>I</sup>
                <span class="type-text-bg">Auteur</span>
              </a>
            </li>
          </ul>
          <ul
            v-if="dataEra.length > 0"
            v-for="eras in dataEra"
            class="vertical-list-wrapper"
          >
            <li v-for="era in eras.era_translations | filterBy search in 'name' ">
              <a
                @click="closeSearchPartial"
                v-link="{ name: 'searchEra', params: { id: era.id }}">
                <span class="dash">
                  <span class="inner-dash"></span>
                </span>
                {{ era.name }}
                <sup>I</sup>
                <span class="type-text-bg">ère</span>
              </a>
            </li>
          </ul>
          <ul
            v-if="dataCity.length > 0"
            v-for="cities in dataCity"
            class="vertical-list-wrapper"
          >
            <li v-for="city in cities.city_translations | filterBy search in 'name' ">
              <a
                @click="closeSearchPartial"
                v-link="{ name: 'searchCity', params: { id: city.id }}">
                <span class="dash">
                  <span class="inner-dash"></span>
                </span>
                {{ city.name }}
                <sup>I</sup>
                <span class="type-text-bg">Ville</span>
              </a>
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
/* global apiAuth, api */
import ScrollProgressBar from './ProgressBar'

import $ from 'jquery'

export default {
  components: {
    ScrollProgressBar
  },
  data () {
    return {
      dataEpigram: {},
      dataGenre: {},
      dataAuthor: {},
      dataEra: {},
      dataCity: {}
    }
  },
  props: {
    search: String
  },
  ready: function () {
    this.getGlobalData()
    var i = 0
    for (i; i < $('.search-list li').length; i++) {
      console.log(i)
    }
  },
  methods: {
    closeSearchPartial: function () {
      $('.search-partial').fadeOut(1000)
    },
    getGlobalData: function () {
      var self = this
      this.$http.get(apiAuth).then(function (response) {
        self.$set('token', response.data.access_token)
        self.$http.get(api + 'entity?access_token=' + self.token).then(function (response) {
          self.$set('dataEpigram', response.data)
        }, function (response) {
          console.log('error: ' + response)
        })
        self.$http.get(api + 'genre?access_token=' + self.token).then(function (response) {
          self.$set('dataGenre', response.data)
        }, function (response) {
          console.log('error: ' + response)
        })
        self.$http.get(api + 'author?access_token=' + self.token).then(function (response) {
          self.$set('dataAuthor', response.data)
        }, function (response) {
          console.log('error: ' + response)
        })
        self.$http.get(api + 'era?access_token=' + self.token).then(function (response) {
          self.$set('dataEra', response.data)
        }, function (response) {
          console.log('error: ' + response)
        })
        self.$http.get(api + 'city?access_token=' + self.token).then(function (response) {
          self.$set('dataCity', response.data)
        }, function (response) {
          console.log('error: ' + response)
        })
      }, function (response) {
        console.log('global error: ' + response.status)
      })
    }
  }
}
</script>

<style lang="sass" scoped>
$raleway: 'Raleway', Helvetica, Arial, sans-serif
$hover: .5s all ease-out

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
    columns: 29em
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
