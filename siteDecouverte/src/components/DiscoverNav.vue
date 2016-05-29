<template>
    <div class="discover-nav">
        <nav class="navbar navbar-default">
            <ul class="nav">
                <li><a href="#"><span class="dash"></span>Mélé / Contraste<sup>I</sup></a></li>
                <li><a v-link="{ name: 'epigram', params: { id: '1' }}"><span class="dash"></span>Méléagre in love<sup>II</sup></a></li>
                <li><a href="#"><span class="dash"></span>La Couronne de Méléagre<sup>III</sup></a></li>
                <li><a href="#"><span class="dash"></span>L'Anthologie de Méléane<sup>IV</sup></a></li>
                <li><a href="#"><span class="dash"></span>Agis de Méléi<sup>V</sup></a></li>
                <li><a href="#"><span class="dash"></span>Lettre à Méléag l'Égyptien<sup>VI</sup></a></li>
                <li><a href="#"><span class="dash"></span>Le Thème de Méléagren<sup>VII</sup></a></li>
            </ul>
        </nav>
    </div>
</template>

<script>
// var api = require('../service/api.js')
var resource = this.$resource('mock/discover.json')

export default {
  data () {
    return {
      data: {}
    }
  },

  ready: function () {
    return resource.get().then(function (response) {
//      self.$set('data', response.data)
      console.log(response.data)
    }, function (response) { console.log(response.status) })
//    this.$http.get('localhost:8080/src/mock/discover.json').then(function (response) {
//      console.log(response.data)
//    }, function (response) {})
  }

}
</script>

<style lang="sass" scoped>
$hover: .2s all ease-out

.discover-nav
  margin-top: 150px

.nav>li>a
  display: flex

ul
  li
    a
      font-size: 17px
      color: rgba(0, 0, 0, 0.5)
      align-items: center
      transition: $hover
      padding: 5px 15px 5px 0

      .dash
        width: 0
        height: 1px
        margin-right: 0
        transition: $hover

      sup
        font-size: 9px

      &:hover,
      &:focus,
      &.v-link-active
        opacity: 1
        color: #2c2c2c
        background: none;

        .dash
          width: 20px
          margin-right: 20px
</style>
