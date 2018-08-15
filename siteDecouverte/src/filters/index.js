import Vue from 'vue'
import capitalize from './capitalize'
import romanize from './romanize'

Vue.filter('capitalize', capitalize)
Vue.filter('romanize', romanize)
