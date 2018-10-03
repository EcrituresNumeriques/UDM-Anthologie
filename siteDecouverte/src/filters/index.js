import Vue from 'vue'
import capitalize from './capitalize'
import romanize from './romanize'
import slugify from './slugify'

Vue.filter('capitalize', capitalize)
Vue.filter('romanize', romanize)
Vue.filter('slugify', slugify)
