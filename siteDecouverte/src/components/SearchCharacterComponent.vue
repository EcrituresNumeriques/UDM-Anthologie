<template>
  <div class="search-component">
    <div class="row scroll">
      <loader></loader>
      <scroll-progress-bar></scroll-progress-bar>
      <div class="col-md-5 col-md-offset-1 left-column">
        <div class="search-content-container">
          <div class="search-title-container">
            <h3><span>{{ dataCharacter.keywords[character].keywords_translations[0].title }}</span></h3>
          </div>
          <div
            v-if="dataCharacter.keywords[character]"
            class="search-subtext-container"
          >
            <p>{{ dataCharacter.keywords[character].keywords_translations[0].title }}<span class="type-text-bg">Personnage</span></p>
          </div>
        </div>
        <div
          v-if="dataCharacter.keywords[character]"
          class="search-desc-container"
        >
          <q>{{ dataCharacter.keywords[character].keywords_translations[0].description }}</q>
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
                v-if="dataCharacter.keywords[character].entities.length > 0"
              >
                <span class="bg"></span>
                épigrammes liées
                <sup>{{ dataCharacter.keywords[character].entities.length | romanize }}</sup>
              </h4>
              <ul>
                <li v-for="epigram in dataCharacter.keywords[character].entities">
                  <a v-link="{ name: 'epigram', params: { id: epigram.id }}">{{ epigram.title }}</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="img-container">
          <img
            v-if="dataCharacter.keywords[character].images[0].url"
            :src="dataCharacter.keywords[character].images[0].url"
            alt="{{ dataCharacter.keywords[character].keywords_translations[0].title }}"
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
    name: 'searchCharacter',
    data () {
      return {
        dataCharacter: {},
        character: this.character
      }
    },
    route: {
      data: function (transition) {
        transition.next({
          character: transition.to.params.id - 1
        })
      }
    },
    ready: function () {
      this.getAuthorsData()
    },
    methods: {
      getAuthorsData: function () {
        var self = this
//        this.$http.get(apiAuth).then(function (response) {
//          self.$set('token', response.data.access_token)
        self.$http.get(api + 'keyword/family/1'/* + filterFr + 'access_token=' + self.token*/, {progress () {
          $('.loader').fadeIn()
        }}).then(function (response) {
          $('.loader').fadeOut()
          self.$set('dataCharacter', response.data)
        }, function (response) {
          console.log('error: ' + response)
        })
//        }, function (response) {
//          console.log('global error: ' + response.status)
//        })
      }
    }
  }
</script>
