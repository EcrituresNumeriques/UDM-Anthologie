<template>
    <div class="index-nav"
         :epigrams="epigrams"
         :parcours-id="parcoursId">
        <nav class="navbar navbar-default">
            <ul class="nav">
                <li class="index-list"
                    v-for="(epigram, index) in epigrams"
                    v-track-by="index"
                    tag="li"
                    @mouseover="addClass"
                    >
                  <router-link :to="{ name: 'parcoursSingle', params: { parcoursId: parcoursId, parcoursSlug: parcoursSlug, epigramIndex: index + 1 }}">
                    <span class="dash">
                      <span class="inner-dash"></span>
                    </span>
                    {{ index + 1 }}
                  </router-link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>

import $ from 'jquery'

export default {
  props: {
    epigrams: {},
    parcoursId: 0,
    parcoursSlug: ''
  },
  created: function () {
  },
  methods: {
    addClass: function (e) {
      $(e.target).addClass('active')
      $(e.target).parent().siblings().children().removeClass('active')
    }
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
</script>

<style lang="sass" scoped>
$hover: .5s all ease-out

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
