<template>
  <div class="search-component">
    <div class="row scroll">
      <scroll-progress-bar></scroll-progress-bar>
      <div class="col-md-5 col-md-offset-1 left-column">
        <div class="search-content-container">
          <div class="search-title-container">
            <h3><span>{{ dataGenre[genre].genre_translations[0].title }}</span></h3>
          </div>
          <div class="search-subtext-container">
            <p>{{ dataGenre[genre].genre_translations[0].title }}<span class="type-text-bg">Thème</span></p>
          </div>
        </div>
        <div class="search-desc-container">
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
              <h4><span class="bg"></span>épigrammes liées<sup>XII</sup></h4>
              <ul>
                <li v-for="epigram in dataGenre[genre].entities">
                  <a v-link="{ name: 'epigram', params: { id: epigram.id }}">{{ epigram.title }}</a>
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

export default {
  components: {
    ScrollProgressBar
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
  ready: function () {
    this.getGenresData()
  },
  methods: {
    getGenresData: function () {
      var self = this
      this.$http.get('http://anthologie.raphaelaupee.fr/oauth/v2/token?client_id=1_2on8mj00wu68oc4oso0cwck8gcc4ccogkc04owgk8g4og4wggk&client_secret=1vfwitjfzz0kkko8kw80cwk844ws8000w8cs40o88g00488www&grant_type=password&username=front&password=owiowi').then(function (response) {
        self.$set('token', response.data.access_token)
        self.$http.get('anthologie.raphaelaupee.fr/api/v1/genre?access_token=' + self.token).then(function (response) {
          self.$set('dataGenre', response.data)
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
$raleway: 'Raleway', Helvetica, Arial, sans-serif

.search-component
  width: 100%
  height: 100%

  >.row
    width: 100%
    height: 100%

  .left-column
    height: 100%
    display: flex
    flex-direction: column
    justify-content: flex-end

    .search-title-container
      h3
        font-size: 18px
        font-weight: 700
        text-transform: capitalize
        display: inline-block
        letter-spacing: 1px

        span
          display: inline-table

          &:after
            content: ""
            width: 100%
            height: 1px
            background: #2c2c2c
            display: inline-block
            vertical-align: top

        sup
          font-size: 12px
          font-style: italic
          color: rgba(44, 44, 44, .5)
          vertical-align: super

    .search-subtext-container
      position: relative
      margin-left: 100px

      p
        font-size: 18px
        font-style: italic

        .type-text-bg
          opacity: 1
          font-style: normal
          font-size: 48px
          padding-left: 10px

    .search-desc-container
      width: 300px
      margin: 80px 0

      q
        line-height: 20px

        &:before
          top: 0

  .right-column
    height: 100%
    display: flex
    flex-direction: column
    justify-content: flex-end

    .vertical-list-container
      height: 27%

    .img-container
      align-self: flex-end
      margin-right: 130px
      margin-bottom: 45px
      margin-top: 100px
      width: 250px
      height: 250px
</style>
