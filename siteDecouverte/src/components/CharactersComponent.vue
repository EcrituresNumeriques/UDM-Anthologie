<template>
    <div class="characters">
        <div class="page-title-container">
            <h1>Personnages</h1>
        </div>
        <div class="row scroll">
          <scroll-progress-bar></scroll-progress-bar>
          <div class="col-md-5 col-md-offset-1">
                <back-btn></back-btn>
                <div class="page-subtitle-container">
                    <span class="dash"></span>
                    <h2>Les personnages de<br> l'Anthologie Palatine</h2>
                </div>
            </div>
            <div class="col-md-6 pull-right">
                <div class="vertical-list-container">
                  <div
                    v-for="character in dataCharacters"
                    class="vertical-list-wrapper">
                    <h3><span class="bg"></span>{{ character.character_translations[0].name }} <sup>{{ character.id | romanize }}</sup></h3>
                    <ul>
                      <li
                        v-for="epigram in character.entities"
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
  name: 'characters',
  data () {
    return {
      token: '',
      dataCharacters: {}
    }
  },
  ready: function () {
    this.getCharactersData()
  },
  methods: {
    getCharactersData: function () {
      var self = this
      this.$http.get('http://anthologie.raphaelaupee.fr/oauth/v2/token?client_id=1_2on8mj00wu68oc4oso0cwck8gcc4ccogkc04owgk8g4og4wggk&client_secret=1vfwitjfzz0kkko8kw80cwk844ws8000w8cs40o88g00488www&grant_type=password&username=front&password=owiowi').then(function (response) {
        self.$set('token', response.data.access_token)
        self.$http.get('anthologie.raphaelaupee.fr/api/v1/keywordFamily?access_token=' + self.token).then(function (response) {
          self.$set('dataCharacters', response.data)
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

.characters
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
