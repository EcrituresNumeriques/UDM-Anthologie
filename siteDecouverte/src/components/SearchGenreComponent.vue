<template>
  <div class="search-component">
    <div class="row scroll">
      <loader></loader>
      <scroll-progress-bar></scroll-progress-bar>
      <div class="col-md-5 col-md-offset-1 left-column">
        <div class="search-content-container">
          <div class="search-title-container">
            <h3><span>{{ dataGenre[genre].genre_translations[0].title }}</span></h3>
          </div>
          <div
            v-if="dataGenre[genre]"
            class="search-subtext-container"
          >
            <p>{{ dataGenre[genre].genre_translations[0].title }}<span class="type-text-bg">Thème</span></p>
          </div>
        </div>
        <div
          v-if="dataGenre[genre]"
          class="search-desc-container"
        >
          <q>{{ dataGenre[genre].genre_translations[0].description }}</q>
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
              <h4
                v-if="dataGenre[genre].entities.length > 0"
              >
                <span class="bg"></span>
                épigrammes liées
                <sup>{{ dataGenre[genre].entities.length | romanize }}</sup>
              </h4>
              <ul>
                <li v-for="epigram in dataGenre[genre].entities">
                  <router-link to="{ name: 'epigram', params: { id: epigram.id }}">{{ epigram.title }}</router-link>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="img-container">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ScrollProgressBar from './partials/ProgressBar.vue'
import Loader from './partials/Loader'

import $ from 'jquery'

export default {
  components: {
    ScrollProgressBar,
    Loader
  },
  name: 'searchGenre',
  data () {
    return {
      dataGenre: {},
      genre: this.genre
    }
  },
  route: {
    data: function (transition) {
      transition.next({
        genre: transition.to.params.id - 1
      })
    }
  },
  mounted: function () {
    this.getGenresData()
  },
  methods: {
    getGenresData: function () {
      var self = this
//      this.$http.get(global.apiAuth).then(function (response) {
//        self.$set('token', response.data.access_token)
      self.$http.get(global.api + 'genre' /* + filterFr + 'access_token=' + self.token*/, {progress () {
        $('.loader').fadeIn()
      }}).then(function (response) {
        $('.loader').fadeOut()
        self.$set('dataGenre', response.data)
      }, function (response) {
        console.log('error: ' + response)
      })
//      }, function (response) {
//        console.log('global error: ' + response.status)
//      })
    }
  }
}
</script>
