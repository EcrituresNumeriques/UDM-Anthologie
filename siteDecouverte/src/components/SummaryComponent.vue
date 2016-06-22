<template>
    <div class="summary">
        <div class="row">
            <div class="col-md-6 col-md-offset-1 left-column">
                <back-btn></back-btn>
                <discover-nav></discover-nav>
                <div class="page-subtitle-container">
                    <span class="dash"></span>
                    <h2>L’Anthologie<br> Palatine & découverte.</h2>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1 pull-right summary-right-column">
                <nav class="navbar navbar-default">
                    <ul class="nav">
                        <li v-for="epigram in data.epigrams">
                          <a
                            v-link="{ name: 'theme', params: { theme: data.slug, themeId: data.id, id: epigram.id }}"
                          >
                            {{ epigram.title }}
                          </a>
                        </li>
                    </ul>
                </nav>
                <div class="small-img-container">
                    <img :src="data.summaryImgUrl">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
/* global api */
import BackBtn from './partials/BackBtn'
import DiscoverNav from './partials/DiscoverNav'
import $ from 'jquery'

export default {
  components: {
    BackBtn,
    DiscoverNav
  },
  name: 'summary',
  data () {
    return {
      data: {}
    }
  },
  ready: function () {
    this.getCurrentThemeId()
    var self = this
    return api.dataDiscover.get().then(function (response) {
      self.$set('data', response.data.themes[0])
    }, function (response) { console.log(response.status) })
  },
  methods: {
    getCurrentThemeId: function () {
      var self = this
      $('body').on('mouseenter', '.discover-list a', function () {
        var dataId = $(this).data('id')
        return api.dataDiscover.get().then(function (response) {
          self.$set('data', response.data.themes[dataId - 1])
        }, function (response) { console.log(response.status) })
      })
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .5s all ease-out

.summary
  width: 100%
  height: 100%

  >.row
    height: 100%

  .left-column,
  .summary-right-column
    height: 100%
    display: flex
    flex-direction: column
    justify-content: flex-end

.row
  >div:first-child
    position: initial

.summary-right-column
  .nav
    li
      a
        font-size: 12px
        color: #2c2c2c
        padding: 8px 0
        transition: $hover

        &:hover,
        &:focus
          transform: translateX(10px)
          background: none

.small-img-container
  margin: 35px 0 45px 30px

</style>
