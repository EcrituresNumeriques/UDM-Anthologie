<template>
  <div class="search-partial active">
    <div @click="onCrossClick" class="cross-container">
      <div class="cross"></div>
    </div>
    <div class="row">
      <div class="col-md-11 col-md-offset-1">
        <div class="search-list">
          <ul>
            <li>
              <a href="#">
                <span class="dash"></span>
                Mélé / Contraste
                <sup>I</sup>
                <span class="text-bg">Auteur</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="dash"></span>
                Méléagre in love
                <sup>II</sup>
                <span class="text-bg">Thème</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="dash"></span>
                La Couronne de Méléagre
                <sup>III</sup>
                <span class="text-bg">épigramme</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="dash"></span>
                L'Anthologie de Méléane
                <sup>IV</sup>
                <span class="text-bg">Thème</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="dash"></span>
                Agis de Méléi
                <sup>V</sup>
                <span class="text-bg">Auteur</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="dash"></span>
                Lettre à Méléag l'Égyptien
                <sup>VI</sup>
                <span class="text-bg">épigramme</span>
              </a>
            </li>
            <li>
              <a href="#">
                <span class="dash"></span>
                Le Thème de Méléagre
                <sup>VII</sup>
                <span class="text-bg">Thème</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-1 left-column">
        <div class="page-subtitle-container">
          <span class="dash"></span>
          <h2>Recherche &<br> découverte Palatine.</h2>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import $ from 'jquery'

export default {
  methods: {
    onCrossClick: function () {
      $('.search-partial').removeClass('active')
    }
  }
}
</script>

<style lang="sass" scoped>
$raleway: 'Raleway', Helvetica, Arial, sans-serif
$hover: .2s all ease-out

.search-partial
  position: absolute
  top: 0
  left: 0
  background: #fff
  display: flex
  flex-direction: column
  justify-content: flex-end
  transition: $hover
  transform: translateY(-100%)

  &.active
   transform: translateY(0)

  .cross-container
    position: absolute
    top: 50px
    right: 50px
    cursor: pointer
    display: flex
    width: 50px
    height: 50px
    justify-content: center
    align-items: center
    opacity: .5
    transition: $hover

    &:hover
      opacity: 1

    .cross
      width: 20px
      height: 1px
      background: #2c2c2c
      transform: rotate(45deg)

      &:after
        content: ""
        width: 20px
        height: 1px
        background: #2c2c2c
        transform: rotate(-90deg)
        position: absolute

  .search-list
    margin-bottom: 100px

  ul
    list-style: none
    padding: 0
    margin: 0

    li
      a
        font-size: 20px
        color: rgba(44, 44, 44, 0.5)
        align-items: center
        transition: $hover
        padding: 5px 15px 5px 0
        display: flex
        position: relative

        .dash
          width: 0
          height: 1px
          margin-right: 0
          transition: $hover

        sup
          font-size: 9px

        .text-bg
          position: absolute
          top: 50%
          left: 0
          transform: translate3d(0, -50%, 0)
          text-transform: uppercase
          font-family: $raleway
          font-size: 36px
          font-weight: 800
          color: rgba(44, 44, 44, .08)
          opacity: 0
          transition: $hover

        &:hover,
        &:focus
          opacity: 1
          color: #2c2c2c
          background: none;
          text-decoration: none

          .dash
            width: 20px
            margin-right: 20px

          .text-bg
            opacity: 1
            left: 12%
</style>
