import Vue from 'vue'

const hostLocal = 'localhost:8080/static/'

exports.dataDiscover = Vue.resource(hostLocal + 'mock/discover.json')

// const host = 'anthologie.raphaelaupee.fr/api/v1/demo'
//
// exports.hostApi = Vue.resource(host)
