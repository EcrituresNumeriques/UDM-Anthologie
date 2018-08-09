<template>
  <div>
    <search :search="search"></search>
    <div class="main-nav col-md-6 col-md-offset-1">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header col-md-2">
            <router-link to="{ path : '/accueil' }"
              @click="closeSearchPartial"
              class="navbar-brand"

            >
              <h1>Antho<span>logie</span></h1>
            </router-link>
          </div>
          <div class="navbar-link col-md-2">
            <router-link to="{ name: 'credits' }"
              @click="closeSearchPartial">
              Crédits<span class="dash"></span>
            </router-link>
          </div>
          <div class="navbar-list col-md-2">
            <p>Listes :</p>
            <ul>
              <router-link to="{ name: 'genres' }"
                           tag="li"
                           @click="closeSearchPartial"
              >
                Genres<span class="dash"></span>
              </router-link>

              <router-link to="{ name: 'authors' }"
                           tag="li"
                           @click="closeSearchPartial"
              >
                  Auteurs<span class="dash"></span>
              </router-link>
              <router-link to="{ name: 'characters' }"
                           tag="li"
                           @click="closeSearchPartial"
              >
                  Personnages<span class="dash"></span>
              </router-link>
            </ul>
          </div>
          <form class="navbar-form navbar-left col-md-4" role="search">
            <div class="form-group search-container col-md-12">
              <input
                v-model="search"
                @click="onSearchFocus"
                type="search"
                class="form-control"
                placeholder="Recherche"
              >
              <div class="search-icon"><span class="glyphicon glyphicon-search"></span></div>
              <button
                @click="closeSearchPartial && onResetClick"
                type="reset"
                class="reset"
              >
                <span class="reset-cross"></span>
              </button>
            </div>
          </form>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
import Search from './Search'

import $ from 'jquery'

export default {
  components: {
    Search
  },
  data () {
    return {
      search: ''
    }
  },
  mounted: function () {
  },
  methods: {
    onSearchFocus: function () {
      $('.search-partial').fadeIn(1000).css('display', 'flex')
      setTimeout(function () {
        if ($('.search-partial.scroll')[0].scrollWidth > $('.search-partial.scroll').width()) {
          $('.search-scroll-progress-bar').show()
          $('.search-scroll-arrows').show()
        }
      }, 1000)
    },
    closeSearchPartial: function () {
      $('.search-partial').fadeOut(1000)
    },
    onResetClick: function (e) {
      e.preventDefault()
      $('input[type="search"]').val('').focus()
    }
  }
}
</script>

<style lang="sass" scoped>
$raleway: 'Raleway', Helvetica, Arial, sans-serif
$nav-color: #2c2c2c
$hover: .5s all linear

.router-link-active
  &:hover
    cursor: default

.main-nav
  font-family: $raleway
  position: fixed
  top: 40px
  left: 0
  z-index: 20
  padding-left: 0

.navbar-default
  margin: 0

.navbar-header
  a
    padding: 0
    opacity: 1
    transition: $hover

    h1
      font-size: 12px
      font-weight: 600
      color: $nav-color
      display: inline-block
      margin: 0
      vertical-align: top

      span
        font-weight: 300

    &.router-link-active
      opacity: .3

      &:hover
        opacity: .3

    &:hover
      opacity: 1

.navbar-link,
.navbar-list
  li
    height: 20px
    margin-bottom: 5px

  a
    font-size: 12px
    font-weight: 400
    color: $nav-color
    text-decoration: none
    display: inline-block
    opacity: .3
    transition: $hover
    height: 20px

    &:hover,
    &.router-link-active
      opacity: 1

    &.router-link-active
      .dash
        background: #000

    .dash
      width: 100%
      height: 1px
      display: block
      position: relative
      background: none
      vertical-align: top

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

    &:hover
      text-decoration: none
      color: #000000

      .dash
        &:before
          width: 100%
          background: #2c2c2c
          transition: width .5s ease

        &:after
          width: 100%
          background: transparent
          transition: all 0s ease

.navbar-link
  float: left

  a
    vertical-align: top
    font-weight: 600
    padding: 0

.navbar-list
  p
    font-weight: 600
    font-size: 12px
    color: $nav-color
    margin-bottom: 5px
    opacity: .3

  ul
    list-style: none
    padding: 0
    margin: 0

form
  margin: 0

.form-group
  vertical-align: top

.search-container
  position: relative
  margin-top: -11px

  input[type="search"]
    padding: 6px 15px 6px 20px
    font-size: 12px
    font-weight: 600
    border: none
    border-radius: 0
    opacity: .3
    transition: $hover
    box-shadow: none

    &:focus
      border-bottom: 1px solid black
      opacity: 1
      box-shadow: none

      ~.search-icon
        opacity: 1

      ~button[type="reset"]
        visibility: visible

  .search-icon
    transform: translate3d(0, -50%, 0)
    position: absolute
    top: 50%
    left: 15px
    border: none
    background: none
    opacity: .3
    transition: $hover
    z-index: 2
    height: 100%

    span
      padding: 11px 0
      transform: rotateZ(90deg)
      font-size: 12px
      color: #555

  button[type="reset"]
    transform: translate3d(0, -50%, 0)
    position: absolute
    top: 50%
    right: 22px
    background: none
    border: none
    visibility: hidden
    opacity: .3
    transition: $hover
    z-index: 2
    height: 100%
    cursor: pointer

    &:hover,
    &:focus
      opacity: 1
      outline: none

    .reset-cross
      width: 12px
      height: 1px
      background: #2c2c2c
      display: inline-block
      transform: rotate(45deg)
      vertical-align: middle

      &:after
        content: ""
        width: 12px
        height: 1px
        background: #2c2c2c
        transform: rotate(90deg)
        position: absolute
        top: 0
        left: 0

</style>
