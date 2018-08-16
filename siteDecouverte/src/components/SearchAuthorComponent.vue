<template>
  <div class="search-component">
    <div class="row scroll">
      <loader></loader>
      <scroll-progress-bar></scroll-progress-bar>
      <div class="col-md-5 col-md-offset-1 left-column">
        <div class="search-content-container">
          <div class="search-title-container">
            <h3><span>{{ dataAuthor[author].author_translations[0].name }}</span><sup>{{ dataAuthor[author].born }} / {{ dataAuthor[author].died }}</sup></h3>
          </div>
          <div
            v-if="dataAuthor[author]"
            class="search-subtext-container"
          >
            <p>{{ dataAuthor[author].era.era_translations[0].name }}<span class="type-text-bg">Auteur</span></p>
          </div>
        </div>
        <div
          v-if="dataAuthor[author]"
          class="search-desc-container"
        >
          <q>{{ dataAuthor[author].author_translations[0].about }}</q>
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
                v-if="dataAuthor[author].entities.length > 0"
              >
                <span class="bg"></span>
                épigrammes liées
                <sup>{{ dataAuthor[author].entities.length | romanize }}</sup>
              </h4>
              <ul>
                <li v-for="epigram in dataAuthor[author].entities">
                  <router-link to="{ name: 'epigram', params: { id: epigram.id }}">{{ epigram.title }}</router-link>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="img-container">
          <img
            v-if="dataAuthor[author].images[0].url"
            :src="dataAuthor[author].images[0].url"
            v-bind:alt="dataAuthor[author].author_translations[0].name"
          >
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
  name: 'searchAuthor',
  data () {
    return {
      dataAuthor: {},
      author: this.author
    }
  },
  route: {
    data: function (transition) {
      transition.next({
        author: transition.to.params.id - 1
      })
    }
  },
  created: function () {
    this.getAuthorsData()
  },
  methods: {
    getAuthorsData: function () {
      var self = this
//      this.$http.get(global.apiAuth).then(function (response) {
//        self.$set('token', response.data.access_token)
      self.$http.get(global.api + 'author'/* + filterFr + 'access_token=' + self.token*/, {progress () {
        $('.loader').fadeIn()
      }}).then(function (response) {
        $('.loader').fadeOut()
        self.$set('dataAuthor', response.data)
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
