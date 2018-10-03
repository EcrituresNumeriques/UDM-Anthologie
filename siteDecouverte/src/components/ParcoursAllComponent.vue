<template>
    <div class="parcours-all">
      <loader></loader>
      <div class="page-title-container">
          <h1>Parcours</h1>
      </div>
      <scroll-progress-bar></scroll-progress-bar>
      <div class="row scroll">
          <div class="col-md-5 col-md-offset-1 flex">
              <back-btn></back-btn>
            <div class="page-subtitle-container flex-end">
              <span class="dash"></span>
              <h2>Parcours de lecture</h2>
            </div>
          </div>
          <div class="col-md-6 pull-right flex">
              <div class="vertical-list-container">
                <div v-for="parcours in parcoursAll"
                     class="vertical-list-wrapper">
                  <h3>
                    <router-link :to="{ name: 'parcoursIndex', params: { parcoursId: parcours.id_keyword, parcoursSlug: slugify(parcours.versions[0].title) } }">
                      <span class="bg"></span>{{ parcours.versions[0].title }} <sup>{{ parcours.entities.length | romanize }}</sup>
                    </router-link>
                    </h3>
                  <ul>
                    <li v-for="(epigram, index) in parcours.entities"
                        v-track-by="index">
                      <router-link :to="{ name: 'parcoursSingle', params: { parcoursId: parcours.id_keyword, parcoursSlug: slugify(parcours.versions[0].title), epigramIndex: index + 1 }}">Épigramme {{ index + 1 }}</router-link>
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
  name: 'ParcoursAll',
  data () {
    return {
      parcoursAll: {}
    }
  },
  created: function () {
    this.$nextTick(function () {
      // ensure elements are in-document
      // immediately show loader
      $('.loader').fadeIn()
    })
    this.getParcoursData()
  },
  methods: {
    getParcoursData: function () {
      var self = this
      // keyword categories for 'Parcours de lecture' is 6
      // https://anthologia.ecrituresnumeriques.ca/api/v1/keyword_categories/6
      var parcoursKeywordId = 6
//      this.$http.get(global.apiAuth).then(function (response) {
//      self.$set('token', response.data.access_token)
      self.$http.get(global.api + 'keywords?category=' + parcoursKeywordId /* + filterFr + 'access_token=' + self.token*/, {progress () {
      }}).then(function (response) {
        var parcoursAll = JSON.parse(response.bodyText)
        console.log('GET parcours', parcoursAll)

        parcoursAll.forEach(function (parcours, i) {
          if (!parcours.versions || !parcours.versions.length) {
            parcours.versions.push({title: 'Sans titre'})
          }
        })

        self.$set(this, 'parcoursAll', parcoursAll)
      }, function (response) {
        console.log('Error retrieving parcours', response)
      }).finally(function () {
        $('.loader').fadeOut()
      })
//      }, function (response) {
//        console.log('global error: ' + response.status)
//      })
    },
    slugify: function (text) {
      if (!text) return ''

      return text.toString()
        .toLowerCase()
        .replace('/[éèê]/g', 'e')
        .replace('/à/g', 'a')
        .replace(/\s+/g, '-')         // Replace spaces with -
        .replace(/[^\w-]+/g, '')      // Remove all non-word chars
        .replace(/--+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')           // Trim - from start of text
        .replace(/-+$/, '')           // Trim - from end of text
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .5s all linear
$raleway: 'Raleway', Helvetica, Arial, sans-serif

.parcours-all
  width: 100%
  height: 100%
  display: flex
  flex-direction: column

.row.scroll
  height: 100%

  >.flex
    height: 100%
    display: flex

.flex-end
  align-self: flex-end

</style>
