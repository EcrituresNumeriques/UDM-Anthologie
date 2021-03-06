import Vue from 'vue'
// vue-resource for web requests
import Resource from 'vue-resource'
// vue-router for routing ...
import Router from 'vue-router'
// import app component
import App from './App'

// import components
import Home from './components/HomeComponent.vue'
import Credits from './components/CreditsComponent'
import Summary from './components/SummaryComponent'
import Genres from './components/GenresComponent'
import Authors from './components/AuthorsComponent'
import Characters from './components/CharactersComponent'
import EpigramTheme from './components/EpigramThemeComponent'
import EpigramApi from './components/EpigramApiComponent'
import SearchGenreComponent from './components/SearchGenreComponent'
import SearchAuthorComponent from './components/SearchAuthorComponent'
import SearchEraComponent from './components/SearchEraComponent'
import SearchCityComponent from './components/SearchCityComponent'
import SearchCharacterComponent from './components/SearchCharacterComponent'
import NotFound from './components/404Component'

// install router & resource
Vue.use(Router)
Vue.use(Resource)

// VUe Config
Vue.config.silent = true // Supress all Vue.js logs and warnings -> because of strange and useless warnings when loading an epigramTheme

// configuration Resource
global.theme = require('./service/theme.js')

var clientId = '2_2pbd2c7wctes4oogk844ckc4wsw00g04kggwkwggcg4c8sccw4'
var clientSecret = '4u08cwjiogmc0sc8ks0wscsww4wck88s08ogg0g04440o44kkk'
var grantType = 'password'
var username = 'front'
var password = 'owiowi'
global.apiAuth = 'http://anthologie.raphaelaupee.fr/oauth/v2/token?client_id=' + clientId + '&client_secret=' + clientSecret + '&grant_type=' + grantType + '&username=' + username + '&password=' + password
global.api = 'anthologie.raphaelaupee.fr/api/v1/'
global.filterFr = '?lang=1&'

Vue.http.options.root = '/'

// routing
export var router = new Router({
  history: false,
  type: 'hash'
})

router.map({
  '/': {
    component: Home
  },
  '/accueil': {
    component: Home,
    name: 'home'
  },
  '/credits': {
    component: Credits,
    name: 'credits'
  },
  '/sommaire': {
    component: Summary,
    name: 'summary'
  },
  '/genres': {
    component: Genres,
    name: 'genres'
  },
  '/auteurs': {
    component: Authors,
    name: 'authors'
  },
  '/personnages': {
    component: Characters,
    name: 'characters'
  },
  '/epigramme/:id': {
    component: EpigramApi,
    name: 'epigram'
  },
  'theme/:themeId/:theme/:id': {
    component: EpigramTheme,
    name: 'theme'
  },
  'recherche/genre/:id': {
    component: SearchGenreComponent,
    name: 'searchGenre'
  },
  'recherche/auteur/:id': {
    component: SearchAuthorComponent,
    name: 'searchAuthor'
  },
  'recherche/ere/:id': {
    component: SearchEraComponent,
    name: 'searchEra'
  },
  'recherche/ville/:id': {
    component: SearchCityComponent,
    name: 'searchCity'
  },
  'recherche/personnage/:id': {
    component: SearchCharacterComponent,
    name: 'searchCharacter'
  },
  '/404': {
    component: NotFound,
    name: 'NotFound'
  }
})

router.redirect({
  '*': '/404'
})

// start the app
router.start(App, 'app')
