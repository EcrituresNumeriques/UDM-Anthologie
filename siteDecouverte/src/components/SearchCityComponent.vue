<template>
  <div class="search-component">
    <loader></loader>
    <div
      v-if="dataCity[city]"
      class="row scroll">
      <scroll-progress-bar></scroll-progress-bar>
      <div class="col-md-5 col-md-offset-1 left-column">
        <div class="search-content-container">
          <div class="search-title-container">
            <h3><span>{{ dataCity[city].city_translations[0].name }}</span><sup>{{ dataCity[city].gps }}</sup></h3>
          </div>
          <div
            v-if="dataCity[city]"
            class="search-subtext-container"
          >
            <p>{{ dataCity[city].city_translations[0].name }}<span class="type-text-bg">Ville</span></p>
          </div>
        </div>
        <div
          v-if="dataCity[city]"
          class="search-desc-container"
        >
          <q>{{ dataCity[city].city_translations[0].description }}</q>
        </div>
        <div class="page-subtitle-container">
          <span class="dash"></span>
          <h2>Recherche &<br> découverte Palatine.</h2>
        </div>
      </div>
      <div class="col-md-6 right-column">
        <div class="img-container">
          <img
            v-if="dataCity[city].images[0].url"
            :src="dataCity[city].images[0].url"
            alt="{{ dataCity[city].city_translations[0].name }}"
          >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
/* global apiAuth, api */
import ScrollProgressBar from './partials/ProgressBar.vue'
import Loader from './partials/Loader'

import $ from 'jquery'

export default {
  components: {
    ScrollProgressBar,
    Loader
  },
  name: 'searchCity',
  data () {
    return {
      dataCity: {},
      city: this.city
    }
  },
  route: {
    data: function (transition) {
      transition.next({
        city: transition.to.params.id - 1
      })
    }
  },
  ready: function () {
    this.getCitiesData()
  },
  methods: {
    getCitiesData: function () {
      var self = this
      this.$http.get(apiAuth).then(function (response) {
        self.$set('token', response.data.access_token)
        self.$http.get(api + 'city?access_token=' + self.token, {progress () {
          $('.loader').fadeIn()
        }}).then(function (response) {
          $('.loader').fadeOut()
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
