<template>
  <div class="search-component">
    <div class="row scroll">
      <loader></loader>
      <scroll-progress-bar></scroll-progress-bar>
      <div class="col-md-5 col-md-offset-1 left-column">
        <div class="search-content-container">
          <div class="search-title-container">
            <h3><span>{{ dataEra[era].era_translations[0].name }}</span><sup>{{ dataEra[era].date_begin }} / {{ dataEra[era].date_end }}</sup></h3>
          </div>
          <div
            v-if="dataEra[era]"
            class="search-subtext-container"
          >
            <p>{{ dataEra[era].era_translations[0].name }}<span class="type-text-bg">ère</span></p>
          </div>
        </div>
        <div
          v-if="dataEra[era]"
          class="search-desc-container"
        >
          <q>{{ dataEra[era].era_translations[0].description }}</q>
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
                v-if="dataEra[era].entities.length > 0"
              >
                <span class="bg"></span>
                épigrammes liées
                <sup>{{ dataEra[era].entities.length | romanize }}</sup>
              </h4>
              <ul>
                <li v-for="epigram in dataEra[era].entities">
                  <a v-link="{ name: 'epigram', params: { id: epigram.id }}">{{ epigram.title }}</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="img-container">
          <img
            v-if="dataEra[era].images[0].url"
            :src="dataEra[era].images[0].url"
            alt="{{ dataEra[era].era_translations[0].name }}"
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
  name: 'searchEra',
  data () {
    return {
      dataEra: {},
      era: this.era
    }
  },
  route: {
    data: function (transition) {
      transition.next({
        era: transition.to.params.id - 1
      })
    }
  },
  ready: function () {
    this.getAuthorsData()
  },
  methods: {
    getAuthorsData: function () {
      var self = this
//      this.$http.get(apiAuth).then(function (response) {
//        self.$set('token', response.data.access_token)
      self.$http.get(api + 'era'/* + filterFr + 'access_token=' + self.token*/, {progress () {
        $('.loader').fadeIn()
      }}).then(function (response) {
        $('.loader').fadeOut()
        self.$set('dataEra', response.data)
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
