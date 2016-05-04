<template>
  <div class="home">
    <div class="title-container text-center row">
        <h1>{{ data.title }}</h1>
    </div>
    <div class="subtitle-container text-center row">
        <h2>{{ data.subtitle }}</h2>
    </div>
    <div class="row link-container">
        <ul class="list-inline">
            <li class="hidden-xs hidden-sm col-md-4 text-right"><a href="#">Exemple</a></li>
            <li class="hidden-xs hidden-sm col-md-4 text-center"><a href="#">Accès API</a></li>
            <li class="col-xs-12 col-md-4 text-left"><a v-link="{ path: '/documentation' }">Get started</a></li>
        </ul>
    </div>
    <div class="row desc-container">
        <p>{{ data.desc }}</p>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      data: {}
    }
  },

  ready: function() {

  	var self = this

  	return api.dataHome.get().then(function(response){

  		self.$set('data', response.data)
  	
  	}, function(response){console.log(response.status)
  	})

  }

}
</script>

<style lang="sass">
$default-color: #366870;

home
  margin: 0 -15px

.title-container,
.subtitle-container,
.link-container,
.desc-container
  margin: 15% 0

.title-container
  h1
    font-weight: bold
    padding: 0 2%

.subtitle-container
  h2
   font-size: 24px
   opacity: .6;padding: 0 5%

.link-container
  a
    display: block
    background: $default-color
    color: #fff
    font-size: 18px
    font-weight: bold
    padding: 3.5% 0%
    border: 3px solid $default-color
    transition: .2s all linear
    width: 72%
    text-align: center
    margin: 0 auto
    
    &:hover,
    &:focus
      text-decoration: none
      background: #fff
      color: $default-color

.desc-container
  p
    padding: 0 5%
    color: #000
    line-height: 2em

@media (min-width: 992px)

  .title-container,
  .subtitle-container,
  .link-container,
  .desc-container
    margin: 11% 0
    
  .title-container
    h1
      font-size: 66px
      padding: 0
      
  .subtitle-container
    h2
      font-size: 44px
        
  .link-container
    a
      font-size: 34px
      margin: 0
      display: inline-block
          
  .desc-container
    p
      font-size: 24px
    
</style>
