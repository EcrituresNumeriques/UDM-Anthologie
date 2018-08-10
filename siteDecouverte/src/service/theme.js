import Vue from 'vue'

// const hostTheme = 'anthologie.valentin-crochemore.fr/static/'
//const hostTheme = 'localhost:8080/'

var dataDiscover = Vue.resource('/static/mock/discover.json')

var entities = Vue.resource(global.api + 'entities')

export {
  dataDiscover,
  entities
}
