<template>
  <div id="app" class="container-fluid">
    <div class="hidden-xs hidden-sm">
      <main-nav></main-nav>
      <router-view transition="fade" :data-theme-id="dataThemeId"></router-view>
    </div>
    <div class="hidden-md hidden-lg">
      <responsive></responsive>
    </div>
    <search></search>
    <copyright></copyright>
  </div>
</template>

<script>
import Responsive from './components/ResponsiveComponent'
import MainNav from './components/partials/MainNav'
import Home from './components/HomeComponent'
import Credits from './components/CreditsComponent'
import Summary from './components/SummaryComponent'
import Keywords from './components/KeywordsComponent'
import Authors from './components/AuthorsComponent'
import Characters from './components/CharactersComponent'
import Epigram from './components/EpigramComponent'
import SearchComponent from './components/SearchComponent'
import NotFound from './components/404Component'
import Search from './components/partials/Search'
import Copyright from './components/partials/Copyright'

export default {
  components: {
    Responsive,
    MainNav,
    Home,
    Credits,
    Summary,
    Keywords,
    Authors,
    Characters,
    Epigram,
    SearchComponent,
    NotFound,
    Search,
    Copyright
  }
}
</script>

<style lang="sass">
$hover: .2s all ease-out
$raleway: 'Raleway', Helvetica, Arial, sans-serif

.fade-transition
  transition: .5s all ease-out

.fade-enter,
.fade-leave
  opacity: 0

@font-face
  font-family: 'times'
  src: url(~assets/fonts/times/Times-Roman.ttf)

html
  height: 100%

body
  display: flex
  height: 100%
  font-family: 'times', Helvetica, Arial, sans-serif
  overflow: hidden

  .scroll
    overflow-y: scroll

    &::-webkit-scrollbar
      display: none

sup
  padding: 0 8px
  font-weight: 700

#app
  width: 100%
  height: 100%
  padding: 19px 17px

  >div
    width: 100%
    height: 100%

.v-link-active
  &:hover
    cursor: default

.navbar-default
  background: none
  border: none

q
  quotes: "\201C" "\201D" "\2018" "\2019"
  position: relative
  padding: 0 10px 10px 0;

  &:before
    font-size: 30px
    position: absolute
    top: -40px
    left: -20px

  &:after
    display: none

span.bg
  width: 20px
  height: 20px
  background: #e4e4e4
  position: absolute
  left: 0
  top: 50%
  transform: translate3d(0, -50%, 0)
  z-index: -1
  transition: $hover

.dash
  background: #2c2c2c
  display: inline-block
  vertical-align: middle

.page-title-container
  position: absolute
  top: 50%
  left: 50%
  transform: translate3d(-50%, -50%, 0)
  font-family: $raleway
  width: 100%
  text-align: center
  opacity: .04
  z-index: -1

  h1
    text-transform: uppercase
    font-size: 100px
    font-weight: 800
    letter-spacing: 0.12em

.page-subtitle-container
  display: flex
  align-items: center
  margin: 95px 0 45px

  .dash
    width: 24px
    height: 2px
    margin-right: 100px

  h2
    display: inline-block
    font-size: 30px
    font-style: italic
    margin: 0
    line-height: 32px

.vertical-list-container
  columns: 20em
  width: 100%
  height: 50%
  align-self: center

.vertical-list-wrapper
  padding-top: 10px
  height: 100%

  h3,
  h4
    padding-left: 10px
    position: relative
    font-family: $raleway
    font-size: 10px
    font-weight: 700
    color: rgba(44,44,44,.5)
    margin: 0
    text-transform: uppercase
    letter-spacing: 0.1em

    sup
        font-family: initial
        font-size: 8px
        color: #2c2c2c

  ul
    list-style: none
    padding: 0
    margin: 30px 0 50px
    height: 100%

    li
      padding-left: 20px

      a
        font-size: 12px
        color: #2c2c2c
        transition: $hover
        padding: 5px 0
        display: block

        &:hover
          padding-left: 10px
          text-decoration: none

.inner-links

  .dash
    width: 19px
    height: 1px
    margin-right: 10px
    display: inline-block
    position: relative
    background: none

    &:before
      content: ''
      display: block
      position: absolute
      left: 0
      bottom: 0
      height: 1px
      width: 0
      transition: width 0s ease, background .5s ease

    &:after
      content: ''
      display: block
      position: absolute
      right: 0
      bottom: 0
      height: 1px
      width: 0
      background: #2c2c2c
      transition: width .5s ease

  a
    font-family: $raleway
    font-size: 12px
    font-weight: 600
    color: #2c2c2c
    display: inline-block
    letter-spacing: 0.04em

    &:hover
      text-decoration: none

      .dash
        &:before
          width: 100%
          background: #2c2c2c
          transition: width .5s ease

        &:after
          width: 100%
          background: transparent
          transition: all 0s ease

.type-text-bg
  position: absolute
  top: 50%
  left: 0
  transform: translate3d(0, -50%, 0)
  text-transform: uppercase
  font-family: $raleway
  font-size: 36px
  font-weight: 800
  color: rgba(44, 44, 44, .08)
  opacity: 0
  transition: $hover
  z-index: -1
</style>
