import Vue from 'vue'

const host = 'localhost:8080/src/'

exports.dataDiscover = Vue.resource(host + 'mock/discover.json')
