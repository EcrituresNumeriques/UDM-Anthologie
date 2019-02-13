<template>
  <div class="home">
    <div class="fake-loader-container">
      <div class="fake-loader-percentage">0%</div>
      <div class="fake-loader-bar-container">
        <div class="fake-loader-bar">
          <div class="fake-loader-bar-hide"></div>
        </div>
      </div>
    </div>
    <div class="row home-row">
      <div class="col-md-6 col-md-offset-1 left-column">

        <div class="index-nav">
          <nav class="navbar navbar-default">
              <ul class="nav">
                  <li class="index-list"
                      v-for="(parcours, index) in selectedParcours"
                      v-track-by="index"
                      @mouseover="addClass"
                      >
                    <router-link :to="{ name: 'parcoursIndex', params: { parcoursId: parcours.id_keyword }}">
                      <span class="dash">
                        <span class="inner-dash"></span>
                      </span>
                      {{ parcours.versions[0].title }}
                      <sup>{{ index + 1 | romanize }}</sup>
                    </router-link>
                  </li>
              </ul>
          </nav>
        </div>

        <div class="page-subtitle-container">
          <span class="dash"></span>
          <h2>L’Anthologie<br> Palatine &amp; découverte.</h2>
        </div>
      </div>
      <div class="col-md-5 right-column">
        <div class="img-container">
          <img v-bind:src="data" />
        </div>
      </div>
     </div>
  </div>
</template>

<script>
import MainNav from './partials/MainNav'
import $ from 'jquery'

export default {
  components: {
    MainNav
  },
  name: 'home',
  data () {
    return {
      data: '/static/img/home/meleagre-in-love.png',
      selectedParcours: []
    }
  },
  created: function () {
    var self = this

    // run $nextTick to ensure DOM is available
    self.$nextTick(function () {
      self.loader()
      self.hide()
      self.getCurrentThemeImg()
      self.getParcoursData()
    })
  },
  methods: {
    getParcoursData () {
      var self = this

      self.$http.get(global.api + 'keywords?category=' + global.parcoursKeywordId).then(function (response) {
        var parcoursData = JSON.parse(response.bodyText)
        var selectedParcours = []
        var selectedParcoursIds = [
          432, // Bestiaire
          433, // Banquet
          435 // Regrets de la vie passée
        ]

        // Only keep selected parcours
        parcoursData.forEach(function (parcours) {
          // If ID is within the selected parcours
          if (selectedParcoursIds.indexOf(parcours.id_keyword) !== -1) {
            console.log('selecting parcours', parcours.id_keyword)
            selectedParcours.push(parcours)
          }
        })

        self.$set(self, 'selectedParcours', selectedParcours)
        console.log('selected parcours is ', selectedParcours)
      }, function (err) {
        console.error('Error retrieving parcours', err)
      })
    },
    addClass: function (e) {
      $(e.target).addClass('active')
      $(e.target).parent().siblings().children().removeClass('active')
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
    },
    getCurrentThemeImg: function () {
//      var self = this
//      $('body').on('mouseenter', '.discover-list a', function () {
//        var dataId = $(this).data('id')
//        return global.theme.dataDiscover.get().then(function (response) {
//          self.$set('data', response.data.themes[dataId - 1].imgUrl)
//        }, function (response) { console.log(response.status) })
//      })
    },
    loader: function () {
//      $(window).on('load', function () {
      setTimeout(function () {
        var homeRow = $('.home-row')
        var homeSubtitle = $('.home .page-subtitle-container')
        var copyright = $('.copyright')

        var loaderContainer = $('.fake-loader-container')
        var loaderPercentage = $('.fake-loader-percentage')
        var loaderBarContainer = $('.fake-loader-bar-container')
        var loaderBarContainerWidth = loaderBarContainer.width()
        var loaderBar = loaderBarContainer.children()
        var loaderBarHide = loaderBar.children()

        loaderBar.animate({
          width: '100%'
        }, 2000, function () {
          loaderBarHide.addClass('active')
          loaderPercentage.fadeOut(500, function () {
            loaderContainer.hide()
          })
          clearInterval(loaderInterval)
          homeSubtitle.fadeIn('2000').addClass('visible')
          copyright.fadeIn('2000')
          setTimeout(function () {
            homeRow.fadeIn(2000)
          }, 500)
        })
        var loaderInterval = setInterval(function () {
          var loaderWidth = loaderBar.width()
          var percentage = Math.round(loaderWidth / loaderBarContainerWidth * 100)
          loaderPercentage.text(percentage + '%')
        }, 100)
      }, 500)
//      })
    },
    hide: function () {
//      $(window).on('load', function () {
      var homeRow = $('.home-row')
      var loaderContainer = $('.fake-loader-container')
      var homeSubtitle = $('.home .page-subtitle-container')
      var copyright = $('.copyright')

      homeRow.hide(0)
      loaderContainer.show().css('display', 'flex')
      homeSubtitle.hide(0)
      copyright.hide(0)
//      })
    }
  }
}

</script>

<style lang="sass" scoped>
$hover: .5s all ease-out

.home
  height: 100%
  width: 100%

.home-row
  height: 100%

  >.row
    //height: 100%
    //margin-left: -17px

  .page-subtitle-container
    transform: translateX(-2%)
    transition: $hover

    &.visible
      transform: translateX(0)

.left-column,
.right-column
  display: inline-flex
  height: 100%

.left-column
  flex-direction: column
  justify-content: flex-end
  padding-right: 0
  padding-left: 0

.right-column
  align-items: center
  justify-content: flex-end
  padding: 0 17px 0 0

  .img-container
    height: 100%
    background: #2b2b2b

    img
      max-width: 100%
      height: 100%
      opacity: 0.65


.fake-loader-container
  width: 8.33333333%
  position: absolute
  left: 0
  bottom: 95px
  text-align: right
  opacity: 0
  animation: fadeIn 2s linear forwards
  display: block /* Show by default to avoid waiting for javascript to load */
  justify-content: flex-end
  flex-direction: column

  .fake-loader-percentage
    font-size: 20px
    font-weight: 500
    font-style: italic
    margin-right: -20px

.fake-loader-bar-container
  width: 100%
  height: 2px

  .fake-loader-bar
    width: 0
    height: 2px
    background: #2c2c2c
    position: relative

    .fake-loader-bar-hide
      position: absolute
      top: 0
      left: 0
      height: 2px
      width: 0
      background: #ffffff
      transition: $hover

      &.active
        width: 100%

@keyframes fadeIn
  from
    opacity: 0

  to
    opacity: 1

.index-nav
  margin-top: 15px
  width: 60%
  padding-left: 20px

  li
    margin: 5px 0

.nav>li>a
  display: flex

ul
  li
    a
      font-size: 17px
      color: #e0e0e0
      align-items: center
      transition: $hover
      padding: 5px 15px 5px 0

      .dash
        width: 20px
        height: 1px
        transition: $hover
        background: transparent
        position: relative
        margin-right: 0
        animation: marginRightOut .5s ease-out forwards

        .inner-dash
          background: #000
          height: 1px
          width: 0
          position: absolute
          top: 0
          left: 0
          transition: $hover
          animation: activeOut .5s ease-out forwards

      sup
        font-size: 9px

      &.active
        color: #2c2c2c
        background: none

        .dash
          animation: marginRightIn .5s ease-out .2s forwards

          .inner-dash
            animation: activeIn .5s ease-out forwards

@keyframes activeIn
  from
    width: 0

  to
    width: 20px

@keyframes activeOut
  from
    width: 20px

  to
    width: 0

@keyframes marginRightIn
  from
    margin-right: 0

  to
    margin-right: 10px

@keyframes marginRightOut
  from
    margin-right: 10px

  to
    margin-right: 0
</style>
