<template>
<div class="auteur-single">
  <div class="page-title-container">
    <h1 v-if="author && author.versions">{{ author.versions[0].name }}</h1>
  </div>

  <div v-if="author && author.versions"
       class="row autuer-row">
    <div class="col-md-10 col-md-offset-1 column">
      <div class="inner-links">
        <router-link :to="{ name: 'authors' }">
          <span class="dash"></span>
          Voir tous les auteurs
        </router-link>
      </div>

      <h2>{{ versionLanguage(author.versions).name }}</h2>

      <p>Les épigrames de cet auteur&nbsp;:</p>

      <div class="overflow">
        <nav class="navbar navbar-default">
            <ul class="nav">
                <li class="index-list"
                    v-for="(listItem, index) in author.entities"
                    v-track-by="index"
                    @mouseover="addClass"
                    >
                  <router-link :to="{ name: 'epigram', params: { id: listItem.id_entity }}">
                    <span class="dash">
                      <span class="inner-dash"></span>
                    </span>
                    {{ listItem.title }}
                    <sup>{{ index + 1 | romanize }}</sup>
                  </router-link>
                </li>
            </ul>
        </nav>
      </div>
    </div>
  </div>
  <div v-else class="notExist">
    <p>L'auteur que vous cherchez n'existe pas</p>
    <back-btn></back-btn>
  </div>
</div>
</template>

<script>
import BackBtn from './partials/BackBtn'
import IndexNav from './partials/IndexNav'

import $ from 'jquery'

export default {
  name: 'AuthorSingle',
  components: {
    BackBtn,
    IndexNav
  },
  data () {
    return {
      author: {},
      authorId: 0
    }
  },
  created: function () {
    var self = this
    self.$set(self, 'authorId', self.$route.params.id)

    self.getAuthorData()
  },
  destroyed: function () {
    this.$off()
  },
  methods: {
    versionLanguage: function (versions, options) {
      return global.versionLanguage(versions, options)
    },
    showPopin: function () {
      $('.manuscript-popin').fadeIn(function () {
        $('.manuscript-popin img').addClass('big')
      }).css('display', 'flex').focus()
    },
    hidePopin: function () {
      $('.manuscript-popin img').removeClass('big')
      $('.manuscript-popin').fadeOut()
    },
    getAuthorData () {
      var self = this

      self.$http.get(global.api + 'authors/' + self.authorId).then(function (response) {
        var authorData = JSON.parse(response.bodyText)

        self.$set(this, 'author', authorData)
      }, function (err) {
        console.error('Error retrieving author', err)
      })
    },
    slugify: function (text) {
      if (!text) return ''

      return text.toString()
        .toLowerCase()
        .replace('/[éèê]/g', 'e')
        .replace('/à/g', 'a')
        .replace(/\s+/g, '-')         // Replace spaces with -
        .replace(/[^\w-]+/g, '')      // Remove all non-word chars
        .replace(/--+/g, '-')         // Replace multiple - with single -
        .replace(/^-+/, '')           // Trim - from start of text
        .replace(/-+$/, '')           // Trim - from end of text
    }
  }
}

$(document).ready(function () {
  var body = $('body')

  function onTextArrowClick (arrow) {
    var self = arrow
    var selfDropWrapper = self.siblings('.dropdown-text-wrapper')
    var selfDropText = selfDropWrapper.children()
    var selfDropTextLength = selfDropText.length
    var selfDropTextVisible = selfDropWrapper.children('.dropdown-text.visible')
    var selfDropTextVisibleIndex = selfDropTextVisible.index()
    self.show()
    self.siblings('.glyphicon').show()
    if (arrow.hasClass('glyphicon-chevron-left')) {
      selfDropTextVisible.hide().removeClass('visible').prev().show().addClass('visible')
      if (selfDropTextVisibleIndex === 1) {
        self.hide()
      }
    } else {
      selfDropTextVisible.hide().removeClass('visible').next().show().addClass('visible')
      if (selfDropTextVisibleIndex === selfDropTextLength - 2) {
        self.hide()
      }
    }
  }

  body.on('click', '.glyphicon-chevron-left', function () {
    onTextArrowClick($(this))
  })

  body.on('click', '.glyphicon-chevron-right', function () {
    onTextArrowClick($(this))
  })
})
</script>

<style lang="sass">
$raleway: 'Raleway', Helvetica, Arial, sans-serif
$hover: .5s all ease-out

.auteur-single
  width: 100%
  height: 100%

  .auteur-row
    height: 100%
    .column
      height: 100%
      display: flex
      flex-direction: column


.mute
  display: inline-block
  vertical-align: top
  margin-top: 100px
  margin-right: 4px

  span
    color: #2c2c2c
    font-size: 20px
    cursor: pointer

.border-bottom
  width: 100%
  height: 2px
  background: #222222
  display: inline-block
  vertical-align: top

.greek-translation,
.notes,
.characters
  p
    span.glyphicon
      transition: $hover

    &:hover
      span.glyphicon-chevron-right
        transform: translateX(5px)

.notes,
.characters
  p
    font-style: italic
    font-weight: 600
    font-size: 16px
    color: #727272
    cursor: pointer
    display: inline-block
    margin-bottom: 0

    span.glyphicon
      font-size: 10px
      margin-left: 14px

.dropdown
  position: relative

  .dropdown-drop
    opacity: 0

    &.visible
      opacity: 1

  .dropdown-drop,
  .dropdown-text-container
    position: absolute
    transition: .5s all ease-out
    z-index: 2

  .dropdown-text-container
    display: none
    align-items: center
    height: auto
    overflow: initial
    background: #fff

    span.glyphicon
      opacity: .6
      width: 30px
      font-size: 9px
      cursor: pointer
      transition: $hover

      &:first-child
        margin-left: -30px

        &:hover
          transform: translateX(-5px)

      &:last-child
        text-align: right

        &:hover
          transform: translateX(5px)

      &:hover
        opacity: 1

  .dropdown-text-wrapper,
  .dropdown-drop ul
    display: inline-block
    width: 250px
    height: 150px
    overflow-y: auto
    position: relative
    scrollbar-face-color: #2c2c2c
    scrollbar-track-color: #fff
    scrollbar-arrow-color: #fff

    &:hover
      &::-webkit-scrollbar-thumb,
      &::-webkit-scrollbar-track
        visibility: visible

    &::-webkit-scrollbar
      background: #fff
      width: 3px

    &::-webkit-scrollbar-button
      display: none

    &::-webkit-scrollbar-thumb
      background: rgba(44, 44, 44, .3)
      visibility: hidden

      &:hover
        background: rgba(44, 44, 44, .8)

      &:active
        background: rgba(44, 44, 44, 1)

    &::-webkit-scrollbar-track
      border-bottom: 1px solid #2c2c2c
      border-top: 1px solid #2c2c2c
      visibility: hidden

    .dropdown-text
      font-size: 14px
      margin-left: 20px
      position: absolute
      display: none

      .dropdown-title
        h4
          font-weight: 700
          font-size: 14px

.manuscript-image
  margin-top: 25px

  p
   font-family: $raleway
   font-size: 12px
   font-weight: 600
   display: inline-block
   cursor: pointer
   position: relative
   padding-bottom: 2px

   &:before
     content: ''
     display: block
     position: absolute
     left: 0
     bottom: 0
     height: 2px
     width: 100%
     transition: width 0s ease

   &:after
     content: ''
     display: block
     position: absolute
     right: 0
     bottom: 0
     height: 2px
     width: 100%
     background: #2C2C2C
     transition: width .5s ease

   &:hover
     &:before
       width: 0%
       background: #2C2C2C
       transition: width .5s ease

     &:after
       width: 0%
       background: transparent
       transition: width 0s ease

.manuscript-popin
  position: absolute
  width: 100%
  height: 100%
  top: 0
  left: 0
  z-index: 30
  align-items: center
  justify-content: center
  background: rgba(0, 0, 0, .5)
  display: none
  cursor: pointer

  .popin-cross-container
    position: absolute
    width: 50px
    height: 50px
    top: 30px
    right: 30px
    cursor: pointer
    display: flex
    align-items: center
    justify-content: center

    .popin-cross
      display: inline-block
      width: 100%
      height: 1px
      background: #fff
      transform: rotate(45deg)

      &:after
        content: ""
        width: 100%
        height: 1px
        position: absolute
        background: #fff
        transform: rotate(90deg)

  img
    transform: scale(0.5)
    transition: .5s

    &.big
      transform: scale(1)

.overflow
  overflow: auto

.notExist
  width: 100%
  height: 100%
  display: flex
  align-items: center
  justify-content: center
  position: relative

  p
    font-size: 30px
    color: #2c2c2c

  .back-btn
    left: 0

</style>
