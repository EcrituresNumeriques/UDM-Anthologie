import Vue from 'vue'

const host = 'localhost:8080/static/'

exports.dataDiscover = Vue.resource(host + 'mock/discover.json')
