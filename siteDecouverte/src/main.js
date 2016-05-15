import Vue from 'vue'
// vue-router for routing ...
import Router from 'vue-router'
// import app component
import App from './App'

// import components
import Home from './components/Home.vue'
import Credits from './components/Credits'
import Summary from './components/Summary'
import Keywords from './components/Keywords'
import Authors from './components/Authors'
import Characters from './components/Characters'
import NotFound from './components/404'

// install router
Vue.use(Router)

// routing
export var router = new Router({
  history: true
})

router.map({
  '/': {
    component: Home,
    name: 'home'
  },
  '/accueil': {
    component: Home,
    name: 'home'
  },
  '/credits': {
    component: Credits,
    name: 'credits'
  },
  '/sommaire/:theme': {
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
