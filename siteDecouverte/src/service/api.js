import Vue from 'vue'

// const hostLocal = 'anthologie.valentin-crochemore.fr/static/'
const hostLocal = 'localhost:8080/static/'

exports.dataDiscover = Vue.resource(hostLocal + 'mock/discover.json')
