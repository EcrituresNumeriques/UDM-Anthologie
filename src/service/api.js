import Vue from 'vue'

const host = 'localhost:8080/src/'

exports.dataHome = Vue.resource(host+'mock/home.json');
exports.dataNav = Vue.resource(host+'mock/doc-nav.json');
exports.baseUrl = host+'mock/doc/';