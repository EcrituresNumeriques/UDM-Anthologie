<template>
  <div class="search-partial scroll">
    <scroll-progress-bar></scroll-progress-bar>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
        <div class="search-list vertical-list-container">
          <ul class="vertical-list-wrapper">
            <li v-for="epigram in dataEpigram | filterBy search in 'title' ">
              <a
                @click="closeSearchPartial"
                v-link="{ name: 'epigram', params: { id: epigram.id }}">
                <span class="dash"></span>
                {{ epigram.title }}
                <sup>I</sup>
                <span class="type-text-bg">épigramme</span>
              </a>
            </li>
          </ul>
          <ul v-for="genres in dataGenre" class="vertical-list-wrapper">
            <li v-for="genre in genres.genre_translations | filterBy search in 'title' ">
              <a
                @click="closeSearchPartial"
                v-link="{ name: 'searchGenre', params: { id: genre.id }}">
                <span class="dash"></span>
                {{ genre.title }}
                <sup>I</sup>
                <span class="type-text-bg">genre</span>
              </a>
            </li>
          </ul>
          <ul v-for="authors in dataAuthor">
            <li v-for="author in authors.author_translations | filterBy search in 'name' ">
              <a
                @click="closeSearchPartial"
                v-link="{ name: 'searchAuthor', params: { id: author.id }}">
                <span class="dash"></span>
                {{ author.name }}
                <sup>I</sup>
                <span class="type-text-bg">Auteur</span>
              </a>
            </li>
          </ul>
          <ul v-for="eras in dataEra" class="vertical-list-wrapper">
            <li v-for="era in eras.era_translations | filterBy search in 'name' ">
              <a
                @click="closeSearchPartial"
                v-link="{ name: 'searchEra', params: { id: era.id }}">
                <span class="dash"></span>
                {{ era.name }}
                <sup>I</sup>
                <span class="type-text-bg">ère</span>
              </a>
            </li>
          </ul>
          <ul v-for="cities in dataCity" class="vertical-list-wrapper">
            <li v-for="city in cities.city_translations | filterBy search in 'name' ">
              <a
                @click="closeSearchPartial"
                v-link="{ name: 'searchCity', params: { id: city.id }}">
                <span class="dash"></span>
                {{ city.name }}
                <sup>I</sup>
                <span class="type-text-bg">ère</span>
              </a>
            </li>
          </ul>
            <!--<li>-->
              <!--<a-->
                <!--@click="closeSearchPartial"-->
                <!--v-link="{ name: 'search', params: { type: 'theme', name: 'meleagre-in-love' }}"-->
              <!--&gt;-->
                <!--<span class="dash"></span>-->
                <!--Méléagre in love-->
                <!--<sup>II</sup>-->
                <!--<span class="type-text-bg">Thème</span>-->
              <!--</a>-->
            <!--</li>-->
            <!--<li>-->
              <!--<a href="#">-->
                <!--<span class="dash"></span>-->
                <!--La Couronne de Méléagre-->
                <!--<sup>III</sup>-->
                <!--<span class="type-text-bg">épigramme</span>-->
              <!--</a>-->
            <!--</li>-->
            <!--<li>-->
              <!--<a href="#">-->
                <!--<span class="dash"></span>-->
                <!--L'Anthologie de Méléane-->
                <!--<sup>IV</sup>-->
                <!--<span class="type-text-bg">Thème</span>-->
              <!--</a>-->
            <!--</li>-->
            <!--<li>-->
              <!--<a href="#">-->
                <!--<span class="dash"></span>-->
                <!--Agis de Méléi-->
                <!--<sup>V</sup>-->
                <!--<span class="type-text-bg">Auteur</span>-->
              <!--</a>-->
            <!--</li>-->
            <!--<li>-->
              <!--<a href="#">-->
                <!--<span class="dash"></span>-->
                <!--Lettre à Méléag l'Égyptien-->
                <!--<sup>VI</sup>-->
                <!--<span class="type-text-bg">épigramme</span>-->
              <!--</a>-->
            <!--</li>-->
            <!--<li>-->
              <!--<a href="#">-->
                <!--<span class="dash"></span>-->
                <!--Le Thème de Méléagre-->
                <!--<sup>VII</sup>-->
                <!--<span class="type-text-bg">Thème</span>-->
              <!--</a>-->
            <!--</li>-->
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-1 left-column">
        <div class="page-subtitle-container">
          <span class="dash"></span>
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
  },
  methods: {
    closeSearchPartial: function () {
      $('.search-partial').fadeOut(1000)
    },
    getGlobalData: function () {
      var self = this
      this.$http.get('http://anthologie.raphaelaupee.fr/oauth/v2/token?client_id=1_2on8mj00wu68oc4oso0cwck8gcc4ccogkc04owgk8g4og4wggk&client_secret=1vfwitjfzz0kkko8kw80cwk844ws8000w8cs40o88g00488www&grant_type=password&username=front&password=owiowi').then(function (response) {
        self.$set('token', response.data.access_token)
        self.$http.get('anthologie.raphaelaupee.fr/api/v1/entity?access_token=' + self.token).then(function (response) {
          self.$set('dataEpigram', response.data)
        }, function (response) {
          console.log('error: ' + response)
        })
        self.$http.get('anthologie.raphaelaupee.fr/api/v1/genre?access_token=' + self.token).then(function (response) {
          self.$set('dataGenre', response.data)
        }, function (response) {
          console.log('error: ' + response)
        })
        self.$http.get('anthologie.raphaelaupee.fr/api/v1/author?access_token=' + self.token).then(function (response) {
          self.$set('dataAuthor', response.data)
        }, function (response) {
          console.log('error: ' + response)
        })
        self.$http.get('anthologie.raphaelaupee.fr/api/v1/era?access_token=' + self.token).then(function (response) {
          self.$set('dataEra', response.data)
        }, function (response) {
          console.log('error: ' + response)
        })
        self.$http.get('anthologie.raphaelaupee.fr/api/v1/city?access_token=' + self.token).then(function (response) {
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
  justify-content: flex-end
  display: none
  width: 100%
  height: 100%
  z-index: 19

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
    margin-bottom: 100px

  ul
    list-style: none
    padding: 0
    margin: 0

    li
      a
        font-size: 20px
        color: rgba(44, 44, 44, 0.5)
        align-items: center
        transition: $hover
        padding: 5px 15px 5px 0
        display: flex
        position: relative

        .dash
          width: 0
          height: 1px
          margin-right: 0
          transition: $hover

        sup
          font-size: 9px

        .type-text-bg
          opacity: 0
          left: 12%
          transition: $hover

        &:hover,
        &:focus
          opacity: 1
          color: #2c2c2c
          background: none;
          text-decoration: none

          .dash
            width: 20px
            margin-right: 20px

          .type-text-bg
            opacity: 1
</style>
