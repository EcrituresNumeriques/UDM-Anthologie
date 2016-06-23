import Vue from 'vue'

const hostLocal = 'anthologie.valentin-crochemore.fr/static/'

exports.dataDiscover = Vue.resource(hostLocal + 'mock/discover.json')
