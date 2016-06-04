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
import NotFound from './components/404Component'

// install router & resource
Vue.use(Router)
Vue.use(Resource)

// VUe Config
Vue.config.silent = true // Supress all Vue.js logs and warnings -> because of strange and useless warnings when loading an epigram

// configuration Resource
global.api = require('./service/api.js')

Vue.http.options.root = '/'

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
