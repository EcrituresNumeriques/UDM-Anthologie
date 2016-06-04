<template>
  <div class="home">
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
  ready: function () {
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
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .2s all linear

.home
  height: 100%
  width: 100%

  >.row
    height: 100%

.left-column,
.right-column
  display: inline-flex
  height: 100%

.left-column
  flex-direction: column
  justify-content: flex-end
  padding-right: 0

.right-column
  align-items: center
  justify-content: flex-end
  padding: 0 17px 0 0

  .img-container
    height: 100%
    width: 100%
    background: #2b2b2b

    img
      width: 100%
      height: 100%
      opacity: 0.65

</style>
