import Vue from 'vue'
//vue-resource for web requests
import Resource from 'vue-resource'
//vue-router for routing ...
import Router from 'vue-router'
//import app component
import App from './App.vue'

// import components
import Home from './components/home.vue'
import Doc from './components/doc.vue'

// install router & resource
Vue.use(Router)
Vue.use(Resource)

// configuration Resource
global.api = require('./service/api.js')

Vue.http.options.root = '/'

// routing
export var router = new Router({
    history: true
})

router.map({
  "/home": {
    component: Home,
    name: 'home'
  },
  "/documentation/:section": {
    component: Doc,
    name: 'doc'
  }
})

// initial vue
router.redirect({
	'*': '/home',
    '/documentation': '/documentation/notes'
})

// start the app
router.start(App, 'app')
