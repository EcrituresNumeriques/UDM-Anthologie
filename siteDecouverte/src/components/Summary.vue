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
                        <li><a href="#">001	AP 5.177, 37</a></li>
                        <li><a href="#">002	AP 12.132b, 22</a></li>
                        <li><a href="#">003	AP 5.152, 34</a></li>
                        <li><a href="#">004	AP 7.417</a></li>
                        <li><a href="#">005	AP 7.421 : Épitaphe «logogriphique»</a></li>
                        <li><a href="#">006	AP 5.177, 37</a></li>
                        <li><a href="#">007	AP 12.132b, 22</a></li>
                        <li><a href="#">008	AP 5.152, 34</a></li>
                        <li><a href="#">009	AP 7.417</a></li>
                        <li><a href="#">010	AP 7.421 : Épitaphe «logogriphique»</a></li>
                        <li><a href="#">011	AP 5.152, 34</a></li>
                        <li><a href="#">012	AP 7.417</a></li>
                    </ul>
                </nav>
                <div class="small-img-container">
                    <img src="~assets/img/small-img.png">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BackBtn from './BackBtn'
import DiscoverNav from './DiscoverNav'

export default {
  components: {
    BackBtn,
    DiscoverNav
  },
  name: 'summary'
}
</script>

<style lang="sass">
$hover: .2s all linear

.summary
  width: 100%
  height: 100%
  display: flex
  flex-direction: column
  justify-content: flex-end
  
.summary-right-column
  .nav
    li
      a
        font-size: 12px
        color: #000
        padding: 8px 0
        transition: $hover
        
        &:hover,
        &:focus
          transform: translateX(10px)
          
.small-img-container
  margin: 35px 0 0 30px

</style>