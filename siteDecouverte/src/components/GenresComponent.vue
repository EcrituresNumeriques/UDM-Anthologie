<template>
    <div class="genres">
      <loader></loader>
      <div class="page-title-container">
          <h1>Mots clés</h1>
      </div>
      <div class="row scroll">
        <scroll-progress-bar></scroll-progress-bar>
        <div class="col-md-5 col-md-offset-1">
              <back-btn></back-btn>
              <div class="page-subtitle-container">
                  <span class="dash"></span>
                  <h2>Les mots clés de<br> l'Anthologie Palatine</h2>
              </div>
          </div>
          <div class="col-md-6 pull-right">
              <div class="vertical-list-container">
                <div
                  v-for="genre in dataGenres"
                  class="vertical-list-wrapper">
                  <h3><span class="bg"></span>{{ genre.genre_translations[0].title }} <sup>{{ genre.id | romanize }}</sup></h3>
                  <ul>
                    <li
                      v-for="epigram in genre.entities"
                    >
                      <a v-link="{ name: 'epigram', params: { id: epigram.id }}">{{ epigram.title }}</a>
                    </li>
                  </ul>
                </div>
              </div>
          </div>
      </div>
    </div>
</template>

<script>
import BackBtn from './partials/BackBtn'
import ScrollProgressBar from './partials/ProgressBar'
import Loader from './partials/Loader'

import $ from 'jquery'

export default {
  components: {
    BackBtn,
    ScrollProgressBar,
    Loader
  },
  name: 'Genres',
  data () {
    return {
      token: '',
      dataAuthors: {}
    }
  },
  ready: function () {
    this.getGenresData()
  },
  methods: {
    getGenresData: function () {
      var self = this
      try {
//        this.$http.get(apiAuth).then(function (response) {
//          self.$set('token', response.data.access_token)
        self.$http.get(api + 'genre'/* + filterFr + 'access_token=' + self.token*/, {progress () {
          $('.loader').fadeIn()
        }}).then(function (response) {
          $('.loader').fadeOut()
          self.$set('dataGenres', response.data)
        }, function (response) {
          console.log('error: ' + response)
        })
//        }, function (response) {
//          console.log('global error: ' + response.status)
//        })
      } catch (err) {
        console.log('error try catch: ' + err)
      }
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .5s all linear
$raleway: 'Raleway', Helvetica, Arial, sans-serif


.genres
  width: 100%
  height: 100%

.row
  height: 100%

  >div:first-child
    position: initial

  >div
    height: 100%
    display: flex

    .page-subtitle-container
      align-self: flex-end
</style>
