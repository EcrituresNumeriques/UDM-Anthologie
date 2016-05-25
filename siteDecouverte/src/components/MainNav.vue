<template>
    <div class="main-nav col-md-6 col-md-offset-1">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header col-md-2">
            <a class="navbar-brand" v-link="{ path : '/accueil' }">
              <h1>Antho<span>logie</span></h1>
            </a>
          </div>
          <div class="navbar-link col-md-2">
            <a v-link="{ name: 'credits' }">Crédits</span></a>
          </div>
          <div class="navbar-list col-md-2">
            <p>Listes :</p>
            <ul>
              <li><a v-link="{ name: 'authors' }">Auteurs</a></li>
              <li><a v-link="{ name: 'keywords' }">Mots clès</a></li>
              <li><a v-link="{ name: 'characters' }">Personnages</a></li>
            </ul>
          </div>
          <form class="navbar-form navbar-left col-md-4" role="search">
            <div class="form-group search-container col-md-12">
              <input type="search" class="form-control" placeholder="Recherche">
              <button type="submit"><span class="glyphicon glyphicon-search"></span></button>
              <button type="reset" class="reset"><span class="reset-cross"></span></button>
            </div>
          </form>
        </div>
      </nav>
    </div>
</template>

<script>
import $ from 'jquery'

$('body').on('click', '.reset', function (e) {
  e.preventDefault()
  $('input[type="search"]').val('').focus()
})
</script>

<style lang="sass" scoped>
$raleway: 'Raleway', Helvetica, Arial, sans-serif
$nav-color: #2c2c2c
$hover: .2s all linear

.main-nav
  font-family: $raleway
  position: fixed
  top: 40px
  left: 0
  z-index: 1
  padding-left: 0

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

    &.v-link-active
      opacity: .3

    &:hover
      opacity: 1

.navbar-link,
.navbar-list
  a
    font-size: 12px
    font-weight: 400
    padding: 5px 0
    color: $nav-color
    text-decoration: none
    display: inline-block
    opacity: .3
    transition: $hover

    &:after
      content: ""
      width: 100%
      height: 1px
      display: block
      vertical-align: top
      background: #000
      opacity: 0
      transition: $hover

    &:hover,
    &:focus,
    &.v-link-active
      opacity: 1

      &:after
        opacity: 1

.navbar-link
  float: left

  a
    vertical-align: top
    font-weight: 600
    padding: 0

.navbar-list
  p
    font-weight: 700
    font-size: 10px
    color: $nav-color
    margin-bottom: 15px
    opacity: .3

  ul
    list-style: none
    padding: 0

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

      ~button[type="submit"]
        opacity: 1

      ~button[type="reset"]
        visibility: visible

  button[type="submit"]
    transform: translate3d(0, -50%, 0)
    position: absolute
    top: 50%
    left: 9px
    border: none
    background: none
    opacity: .3
    transition: $hover
    z-index: 2
    height: 100%

    span
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

    &:hover
      opacity: 1

    .reset-cross
      width: 7px
      height: 1px
      background: #000
      display: inline-block
      transform: rotate(45deg)
      vertical-align: middle

      &:after
        content: ""
        width: 7px
        height: 1px
        background: #000
        transform: rotate(90deg)
        position: absolute
        top: 0
        left: 0

</style>
