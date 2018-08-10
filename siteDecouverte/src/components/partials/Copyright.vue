<template>
    <div class="copyright row">
      <div class="col-sm-12 col-md-6 col-md-offset-1">
        <p>&copy Université de Montréal - 2016</p>
      </div>
    </div>
</template>

<style lang="sass" scoped>
$raleway: 'Raleway', Helvetica, Arial, sans-serif

.container-main .copyright
  position: absolute
  left: 0
  bottom: 0
  height: 25px
  text-align: center
  margin: 0

  @media (min-width: 992px)
    text-align: left

  p
    font-family: $raleway
    font-size: 12px

</style>
