<template>
  <div class="home">
    <div class="loader-container">
      <div class="loader-percentage">0%</div>
      <div class="loader-bar-container">
        <div class="loader-bar">
          <div class="loader-bar-hide"></div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-1 left-column">
            <discover-nav></discover-nav>
            <div class="page-subtitle-container">
                <span class="dash"></span>
                <h2>L’Anthologie<br> Palatine & découverte.</h2>
            </div>
        </div>
        <div class="col-md-5 right-column">
          <div class="img-container">
            <img src="{{ data }}">
          </div>
        </div>
     </div>
  </div>
</template>

<script>
/* global api */
import MainNav from './partials/MainNav'
import DiscoverNav from './partials/DiscoverNav'
import $ from 'jquery'

export default {
  components: {
    MainNav,
    DiscoverNav
  },
  name: 'home',
  data () {
    return {
      data: '/static/img/home/meleagre-in-love.png'
    }
  },
  created: function () {
    this.hide()
  },
  ready: function () {
    this.loader()
    this.getCurrentThemeImg()
  },
  methods: {
    getCurrentThemeImg: function () {
      var self = this
      $('body').on('mouseenter', '.discover-list a', function () {
        var dataId = $(this).data('id')
        return api.dataDiscover.get().then(function (response) {
          self.$set('data', response.data.themes[dataId - 1].imgUrl)
        }, function (response) { console.log(response.status) })
      })
    },
    loader: function () {
      $(window).on('load', function () {
        setTimeout(function () {
          var mainNav = $('.main-nav')
          var homeDiscoverNav = $('.home .discover-nav')
          var homeImg = $('.home .img-container')
          var homeSubtitle = $('.home .page-subtitle-container')

          var loaderContainer = $('.loader-container')
          var loaderPercentage = $('.loader-percentage')
          var loaderBarContainer = $('.loader-bar-container')
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
            setTimeout(function () {
              mainNav.fadeIn(2000)
              homeDiscoverNav.fadeIn(2000)
              homeImg.fadeIn(2000)
            }, 500)
          })
          var loaderInterval = setInterval(function () {
            var loaderWidth = loaderBar.width()
            var percentage = Math.round(loaderWidth / loaderBarContainerWidth * 100)
            loaderPercentage.text(percentage + '%')
          }, 100)
        }, 500)
      })
    },
    hide: function () {
      $(window).on('load', function () {
        var mainNav = $('.main-nav')
        var homeDiscoverNav = $('.home .discover-nav')
        var homeImg = $('.home .img-container')
        var loaderContainer = $('.loader-container')
        var homeSubtitle = $('.home .page-subtitle-container')

        mainNav.hide(0)
        homeDiscoverNav.hide()
        homeImg.hide()
        loaderContainer.show().css('display', 'flex')
        homeSubtitle.hide()
      })
    }
  }
}

</script>

<style lang="sass" scoped>
$hover: .5s all linear

.home
  height: 100%
  width: 100%

  >.row
    height: 100%
    margin-left: -17px

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


.loader-container
  width: 8.33333333%
  position: absolute
  left: 0
  bottom: 95px
  text-align: right
  opacity: 0
  animation: fadeIn 2s linear forwards
  display: none
  justify-content: flex-end
  flex-direction: column

  .loader-percentage
    font-size: 20px
    font-weight: 500
    font-style: italic
    margin-right: -20px

.loader-bar-container
  width: 100%
  height: 2px

  .loader-bar
    width: 0
    height: 2px
    background: #2c2c2c
    position: relative

    .loader-bar-hide
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

</style>
