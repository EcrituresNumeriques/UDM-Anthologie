import Vue from 'vue'
// vue-router for routing ...
import Router from 'vue-router'
// import app component
import App from './App'

// import components
import Home from './components/Home.vue'
import Credits from './components/Credits'
import Summary from './components/Summary'

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
  }
})

// start the app
router.start(App, 'app')
