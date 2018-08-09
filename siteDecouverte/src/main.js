import Vue from 'vue'
// vue-resource for web requests
import VueResource from 'vue-resource'
// import app component
import App from './App'
// custom router
import router from './router'

// install resource
Vue.use(VueResource)

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

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
