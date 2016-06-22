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
import Keywords from './components/KeywordsComponent'
import Authors from './components/AuthorsComponent'
import Characters from './components/CharactersComponent'
import Epigram from './components/EpigramComponent'
import SearchComponent from './components/SearchComponent'
import NotFound from './components/404Component'

// install router & resource
Vue.use(Router)
Vue.use(Resource)

// VUe Config
Vue.config.silent = true // Supress all Vue.js logs and warnings -> because of strange and useless warnings when loading an epigram

// configuration Resource
global.api = require('./service/api.js')

Vue.http.options.root = '/'

// Vue.http.get('http://anthologie.raphaelaupee.fr/oauth/v2/token?client_id=3_2cikyz2e58sg4084gckkokcow0sgsgc080wwooc8ckoc8840o4&client_secret=3xf5jg4tz1a8wg0o80os0wcgcckwkk4scws84go84w0w04ogg8&grant_type=password&username=front&password=owiowi').then(function (response) {
//   Vue.http.headers.common['Authorization'] = response.data.token_type + ' ' + response.data.access_token
//   console.log('Authorization: ' + response.data.token_type + ' ' + response.data.access_token)
// }, function (response) {
//   console.log('global error: ' + response.status)
// })

// routing
export var router = new Router({
  history: true
})

router.map({
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
  '/mots-cles': {
    component: Keywords,
    name: 'keywords'
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
    component: Epigram,
    name: 'epigram'
  },
  'theme/:themeId/:theme/:id': {
    component: Epigram,
    name: 'theme'
  },
  'recherche/:type/:name': {
    component: SearchComponent,
    name: 'search'
  },
  '/404': {
    component: NotFound,
    name: 'NotFound'
  }
})

router.redirect({
  '*': '/404',
  '/': '/accueil'
})

// start the app
router.start(App, 'app')
