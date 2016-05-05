import Vue from 'vue'
// vue-router for routing ...
import Router from 'vue-router'
// import app component
import App from './App'

// import components
import Home from './components/Home.vue'

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
  }
})

// start the app
router.start(App, 'app')
