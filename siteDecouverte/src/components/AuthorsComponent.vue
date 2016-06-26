<template>
    <div class="authors">
      <loader></loader>
      <div class="page-title-container">
          <h1>Auteurs</h1>
      </div>
      <div class="row scroll">
          <scroll-progress-bar></scroll-progress-bar>
          <div class="col-md-5 col-md-offset-1">
              <back-btn></back-btn>
              <div class="page-subtitle-container">
                  <span class="dash"></span>
                  <h2>Les auteurs de<br> l'Anthologie Palatine</h2>
              </div>
          </div>
          <div class="col-md-6 pull-right">
              <div class="vertical-list-container">
                  <div
                    v-for="author in dataAuthors"
                    class="vertical-list-wrapper">
                    <h3><span class="bg"></span>{{ author.author_translations[0].name }} <sup>{{ author.id | romanize }}</sup></h3>
                    <ul>
                      <li
                        v-for="epigram in author.entities"
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
/* global apiAuth, api */
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
      token: '',
      dataAuthors: {}
    }
  },
  ready: function () {
    this.getAuthorsData()
  },
  methods: {
    getAuthorsData: function () {
      var self = this
      this.$http.get(apiAuth).then(function (response) {
        self.$set('token', response.data.access_token)
        self.$http.get(api + 'author?access_token=' + self.token, {progress () {
          $('.loader').fadeIn()
        }}).then(function (response) {
          $('.loader').fadeOut()
          self.$set('dataAuthors', response.data)
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
$hover: .5s all linear
$raleway: 'Raleway', Helvetica, Arial, sans-serif

.authors
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
