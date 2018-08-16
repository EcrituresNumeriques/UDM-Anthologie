<template>
    <div class="authors">
      <loader></loader>
      <div class="page-title-container">
          <h1>Auteurs</h1>
      </div>
      <div class="row scroll">
          <scroll-progress-bar></scroll-progress-bar>
          <div class="col-md-5 col-md-offset-1 flex">
              <back-btn></back-btn>
              <div class="page-subtitle-container">
                  <span class="dash"></span>
                  <h2>Les auteurs de<br> l'Anthologie Palatine</h2>
              </div>
          </div>
          <div class="col-md-6 pull-right flex">
              <div class="vertical-list-container">
                  <div v-for="author in dataAuthors"
                       class="vertical-list-wrapper">
                    <h3><span class="bg"></span>{{ author.versions[0].name }} <sup>{{ author.id_author | romanize }}</sup></h3>
                    <ul>
                      <li v-for="epigram in author.entities">
                        <router-link :to="{ name: 'epigram', params: { id: epigram.id_entity }}">{{ epigram.title }}</router-link>
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
  name: 'Authors',
  data () {
    return {
      dataAuthors: {}
    }
  },
  created: function () {
    this.$nextTick(function () {
      // ensure elements are in-document
      // immediately show loader
      $('.loader').fadeIn()
    })
    this.getAuthorsData()
  },
  methods: {
    getAuthorsData: function () {
      var self = this
//      this.$http.get(global.apiAuth).then(function (response) {
//      self.$set('token', response.data.access_token)
      self.$http.get(global.api + 'authors'/* + filterFr + 'access_token=' + self.token*/, {progress () {
      }}).then(function (response) {
        var authors = JSON.parse(response.bodyText)
        self.$set(this, 'dataAuthors', authors)
      }, function (response) {
        console.log('Error retrieving authors', response)
      }).finally(function () {
        $('.loader').fadeOut()
      })
//      }, function (response) {
//        console.log('global error: ' + response.status)
//      })
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .5s all linear
$raleway: 'Raleway', Helvetica, Arial, sans-serif

.authors
  width: 100%
  height: 100%

.row
  height: 100%

  >.flex
    height: 100%
    display: flex

    .page-subtitle-container
      align-self: flex-end

</style>
