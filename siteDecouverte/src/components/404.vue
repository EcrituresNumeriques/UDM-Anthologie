<template>
    <div class="not-found">
        <div class="row">
            <div class="col-md-11 col-md-offset-1">
                <back-btn></back-btn>
            </div>
        </div>
        <div class="row content-container">
            <div>
                <p><span class="error"><span class="dash"></span><i>Erreur</i></span><strong>404</strong></p>
                <p>La page demandée n’existe pas</p>
                <p>ζητούμενη σελίδα δεν έχει βρεθεί</p>
            </div>
        </div>
    </div>
</template>

<script>
import BackBtn from './BackBtn'

export default {
  components: {
    BackBtn
  },
  name: 'NotFound'
}
</script>

<style lang="sass" scoped>
.not-found
  width: 100%
  height: 100%

.content-container
  height: 100%
  display: flex
  justify-content: center
  align-items: center

  p
    font-size: 30px
    line-height: 1
    margin-bottom: 0

    .error
      vertical-align: top
      display: inline-block

      .dash
        height: 2px
        width: 24px
        margin-right: 15px

      i
        font-style: italic
        color: #2c2c2c

    strong
      font-style: italic
      font-size: 200px
      color: #2c2c2c
      margin-left: -50px

    &:nth-child(2)
      margin: 0 0 0 145px
      color: #2c2c2c

    &:last-child
      margin-left: 190px
      opacity: 0.4

</style>
