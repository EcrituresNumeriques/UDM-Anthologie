<template>
  <div class="col-md-5 col-md-offset-2">
    <div
      v-if="data.themes[theme].epigrams[epigram].characters"
      class="characters dropdown"
    >
      <p @click="onCharactersDropdownClick">
        Les personnages
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="border-bottom"></span>
      </p>
      <div class="dropdown-drop">
        <ul>
          <li v-for="character in data.themes[theme].epigrams[epigram].characters">
            <a
              @click="onCharactersListClick"
              id="character-{{ character.id }}-list"
              data-click="character-{{ character.id }}"
              href="#"
            >
              <span class="dash"></span>{{ character.name | capitalize }}
            </a>
          </li>
        </ul>
      </div>
      <div class="dropdown-text-container">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <div class="dropdown-text-wrapper">
          <div
            v-for="character in data.themes[theme].epigrams[epigram].characters"
            id="character-{{ character.id }}"
            class="dropdown-text"
          >
            <div class="dropdown-title">
              <h4>{{ character.name | capitalize }}</h4>
            </div>
            <div class="dropdown-desc">
              <q>{{{ character.desc }}}</q>
            </div>
          </div>
        </div>
        <span class="glyphicon glyphicon-chevron-right"></span>
      </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'

export default {
  props: {
    data: Object,
    theme: Number,
    epigram: Number
  },
  methods: {
    onCharactersDropdownClick: function () {
      var charactersContainer = $('.characters')
      var charactersDropdown = charactersContainer.children('.dropdown-drop')
      var charactersTextContainer = charactersContainer.children('.dropdown-text-container')
      var charactersText = charactersTextContainer.find('.dropdown-text')
      var charactersDropdownArrow = charactersContainer.children('p').children('.glyphicon')
      var charactersTextArrows = charactersTextContainer.children('.glyphicon')
      if (!charactersContainer.hasClass('droped')) {
        charactersContainer.addClass('droped')
        charactersDropdownArrow.addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-right')
        charactersDropdown.addClass('visible')
        charactersTextContainer.addClass('visible')
      } else {
        charactersContainer.removeClass('droped')
        charactersDropdownArrow.addClass('glyphicon-chevron-right').removeClass('glyphicon-chevron-down')
        charactersDropdown.removeClass('visible')
        charactersTextContainer.removeClass('visible').fadeOut('500')
        charactersTextArrows.fadeOut('500')
        charactersText.removeClass('visible').fadeOut('500')
      }
    },
    onCharactersListClick: function (e) {
      e.preventDefault()
      var targetId = e.target.id
      var thisListClicked = $('.dropdown-drop a#' + targetId)
      var thisListClickedData = e.target.dataset.click
      var thisListClickedParent = thisListClicked.parents('.dropdown-drop')
      var thisListClickedTextContainer = thisListClickedParent.siblings('.dropdown-text-container')
      var thisListClickedDropWrapper = thisListClickedTextContainer.children('.dropdown-text-wrapper')
      var thisListClickedDropText = thisListClickedDropWrapper.children('.dropdown-text')
      var thisListClickedDropTextLength = thisListClickedDropText.length
      var thisListClickedArrowLeft = thisListClickedTextContainer.children('.glyphicon-chevron-left')
      var thisListClickedArrowRight = thisListClickedTextContainer.children('.glyphicon-chevron-right')
      thisListClickedTextContainer.css('display', 'flex')
      $('#' + thisListClickedData).addClass('visible').fadeIn('500')
      var thisListClickedDropTextVisibleIndex = $('#' + thisListClickedData).index()
      thisListClickedArrowLeft.show()
      thisListClickedArrowRight.show()
      if (thisListClickedDropTextVisibleIndex === 0) {
        thisListClickedArrowLeft.hide()
      }
      if (thisListClickedDropTextVisibleIndex === thisListClickedDropTextLength - 1) {
        thisListClickedArrowRight.hide()
      }
    }
  }
}
</script>

<style lang="sass" scoped>
$hover: .7s all ease-out

.characters
  margin-top: 150px

  .dropdown-drop
    ul
      list-style: none
      padding: 0

      li
        a
          font-size: 14px
          opacity: 0.5
          transition: $hover
          color: #2c2c2c

          .dash
            width: 0
            height: 1px
            margin-right: 0
            transition: $hover

          &:hover,
          &:focus
            opacity: 1
            text-decoration: none

            .dash
              width: 13px
              margin-right: 5px

  .dropdown-text-container
    opacity: 0

    &.visible
      opacity: 1
</style>
