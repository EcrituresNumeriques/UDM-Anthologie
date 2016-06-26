<template>
  <div class="loader">
    <div class="loader-bar">
      <p>Veuillez patienter s'il vous plait ...</p>
    </div>
  </div>
</template>

<style lang="sass" scoped>
$hover: .5s all linear
$raleway: 'Raleway', Helvetica, Arial, sans-serif

.loader
  position: absolute
  top: 50%
  left: 50%
  transform: translate3d(-50%, -50%, 0)
  display: none
  width: 25%

  .loader-bar
    background: transparent
    position: relative
    transition: $hover
    text-align: center

    p
      font-size: 20px
      font-family: $raleway
      padding-bottom: 15px

    &:after
      content: ''
      background: #000
      height: 2px
      width: 0
      position: absolute
      bottom: 0
      left: 0
      transition: $hover
      animation: loader 2s ease-out infinite

@keyframes loader
  from
    width: 0

  to
    width: 100%
</style>
