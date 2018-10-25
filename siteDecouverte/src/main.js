import Vue from 'vue'
// vue-resource for web requests
import VueResource from 'vue-resource'
// import app component
import App from './App'
// custom router
import router from './router'
// custom filters
import './filters'

// install resource
Vue.use(VueResource)

// VUe Config
Vue.config.silent = true // Supress all Vue.js logs and warnings -> because of strange and useless warnings when loading an epigramTheme

// configuration Resource
global.theme = require('./service/theme.js')

// keyword categories for 'Parcours de lecture' is 6
// https://anthologia.ecrituresnumeriques.ca/api/v1/keyword_categories/6
global.parcoursKeywordId = 6

//Vue.http.headers.common['access-control-allow-origin'] = '*'

var clientId = '2_2pbd2c7wctes4oogk844ckc4wsw00g04kggwkwggcg4c8sccw4'
var clientSecret = '4u08cwjiogmc0sc8ks0wscsww4wck88s08ogg0g04440o44kkk'
var grantType = 'password'
var username = 'front'
var password = 'owiowi'
global.apiAuth = 'https://anthologie.raphaelaupee.fr/oauth/v2/token?client_id=' + clientId + '&client_secret=' + clientSecret + '&grant_type=' + grantType + '&username=' + username + '&password=' + password
global.api = 'https://anthologia.ecrituresnumeriques.ca/api/v1/'
global.filterFr = '?lang=1&'

Vue.http.options.root = '/'

global.versionLanguage = function (versions, options) {
  options = options || {}

  var prefLanguageIds = [
    2, // français moderne
    5, // français littéraire
    1,
    3,
    5,
    6,
    10,
    11,
    8,
    7,
    4,
    9
  ]
//  var greekLanguageId = 1
  var greekPrefLanguageIds = [
    4,
    7,
    8,
    9
  ]
  var returnVersion = {}

  if (options.greekText) {
    // insert given language id at first position of the language list
//    prefLanguageIds.splice(0, options.forceLanguageId)
//
//    if (!options.fallback === false) {
//      // do not fallback to other languages
//      // remove all other languages except the first explicit one
//      prefLanguageIds.splice(1, prefLanguageIds.length - 1)
//    }
    prefLanguageIds = greekPrefLanguageIds
  }

  // Iterate over the preferred language order
  prefLanguageIds.forEach(function (langId) {
    versions.forEach(function (version) {
      if (version.id_language === langId) {
        returnVersion = version

        return
      }
    })
  })

  return returnVersion
}

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
