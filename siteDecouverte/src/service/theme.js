import Vue from 'vue'

// const hostTheme = 'anthologie.valentin-crochemore.fr/static/'
const hostTheme = 'localhost:8080/static/'

exports.dataDiscover = Vue.resource(hostTheme + 'mock/discover.json')
