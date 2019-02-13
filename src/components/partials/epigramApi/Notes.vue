<template>
  <div class="notes-partial">
    <div
      v-if="data.notes.length > 0"
      class="notes dropdown"
    >
      <p @click="onNotesDropdownClick">
        Les notes
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="border-bottom"></span>
      </p>
      <div class="dropdown-drop">
        <div class="dropdown-text-container">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <div class="dropdown-text-wrapper">
            <div
              v-for="note in data.notes"
              v-bind:id="'note' + note.note_translations[0].id"
              class="dropdown-text"
            >
              <div class="dropdown-desc">
                <q v-html="note.note_translations[0].text"></q>
              </div>
            </div>
          </div>
          <span class="glyphicon glyphicon-chevron-right"></span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'

export default {
  propsData: {
    data: Object
  },
  methods: {
    onNotesDropdownClick: function () {
      var notesContainer = $('.notes')
      var notesDropdown = notesContainer.children('.dropdown-drop')
      var notesDropdownText = notesDropdown.find('.dropdown-text')
      var notesDropdownArrow = notesContainer.children('p').children('.glyphicon')
      var notesTextArrows = notesDropdown.find('.glyphicon')
      var notesTextArrowLeft = notesDropdown.find('.glyphicon-chevron-left')
      var notesTextArrowRight = notesDropdown.find('.glyphicon-chevron-right')
      if (!notesContainer.hasClass('droped')) {
        notesContainer.addClass('droped')
        notesDropdownArrow.addClass('glyphicon-chevron-down').removeClass('glyphicon-chevron-right')
        notesDropdown.addClass('visible')
        notesDropdownText.first().addClass('visible').fadeIn('500')
        notesTextArrowRight.show()
        notesTextArrowLeft.hide()
        if (notesDropdownText.length === 1) {
          notesTextArrowRight.hide()
        }
      } else {
        notesContainer.removeClass('droped')
        notesDropdownArrow.addClass('glyphicon-chevron-right').removeClass('glyphicon-chevron-down')
        notesDropdown.removeClass('visible')
        notesDropdownText.removeClass('visible').fadeOut('500')
        notesTextArrows.fadeOut('500')
      }
    }
  }
}
</script>

<style lang="sass" scoped>
.notes-partial
  .notes
    margin-top: 60px

    .dropdown-drop
      width: 100%
      padding-left: 20px;
      margin-left: -20px;

      .dropdown-text-container
        display: flex
        background: none

      .dropdown-text-wrapper
        width: 170px

        .dropdown-text
          .dropdown-desc
            q
              &:before
                top: -10px
</style>
