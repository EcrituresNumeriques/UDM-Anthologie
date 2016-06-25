<template>
    <div class="keywords">
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

export default {
  components: {
    BackBtn,
    ScrollProgressBar
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
      this.$http.get('http://anthologie.raphaelaupee.fr/oauth/v2/token?client_id=1_2on8mj00wu68oc4oso0cwck8gcc4ccogkc04owgk8g4og4wggk&client_secret=1vfwitjfzz0kkko8kw80cwk844ws8000w8cs40o88g00488www&grant_type=password&username=front&password=owiowi').then(function (response) {
        self.$set('token', response.data.access_token)
        self.$http.get('anthologie.raphaelaupee.fr/api/v1/genre?access_token=' + self.token).then(function (response) {
          self.$set('dataGenres', response.data)
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

.keywords
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
