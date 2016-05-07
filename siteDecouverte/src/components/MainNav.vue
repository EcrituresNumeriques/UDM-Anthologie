<template>
    <div class="main-nav">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header col-md-2">
                    <a class="navbar-brand" v-link="{ name : 'home' }">
                        <h1>Antho<span>logie</span></h1>
                    </a>
                </div>
                <div class="navbar-link col-md-2">
                    <a href="#">Crédits</a>
                </div>
                <form class="navbar-form navbar-left col-md-4" role="search">
                    <div class="form-group col-md-6">
                        <fieldset>
                            <legend>Listes :</legend>
                            <input type="radio" name="list" value="keywords" id="keywords">
                            <label for="keywords">Mots clès</label>
                            <input type="radio" name="list" value="authors" id="authors">
                            <label for="authors">Auteurs</label>
                        </fieldset>
                    </div>
                    <div class="form-group search-container col-md-6">
                        <input type="search" class="form-control" placeholder="Recherche">                        
                        <button type="submit"><img src="~assets/img/search.png" alt="Recherche"></button>
                    </div>
                </form>
            </div>
        </nav>
    </div>
</template>

<script>
</script>

<style lang="sass" scoped>
$raleway: 'Raleway', Helvetica, Arial, sans-serif
$nav-color: #2c2c2c
$hover: .2s all linear

.main-nav
  font-family: $raleway

.navbar-header
  a
    padding: 0
    
    h1
      font-size: 12px
      font-weight: 600
      color: $nav-color
      display: inline-block
      margin: 0
      vertical-align: top
    
      span
        font-weight: 300
 
.navbar-link   
  float: left
         
  a
    font-size: 12px
    font-weight: 600
    padding: 0
    color: $nav-color
    text-decoration: none
    vertical-align: top
    display: inline-block
        
form
  margin: 0
  
.form-group
  vertical-align: top
    
fieldset

  legend
    font-weight: 700
    font-size: 10px 
    color: $nav-color
    border: none
    margin-bottom: 15px
    
  [type="radio"]:not(:checked),
  [type="radio"]:checked
    position: absolute
    left: -9999px   
    
  [type="radio"]:not(:checked) + label,
  [type="radio"]:checked + label
    font-weight: 400
    font-size: 12px
    display: block
    cursor: pointer
    
  [type="radio"]:checked + label,
  [type="radio"]:hover + label,
  [type="radio"]:focus + label
    opacity: 1
    
  label
    transition: $hover
    opacity: 0.7
    
.search-container
  position: relative    
  margin-top: -11px
  padding: 0
  
  input[type="search"]
    padding: 6px 15px 6px 30px
    font-size: 12px
    font-weight: 600
    border: none
  
  button
    transform: translate3d(0, -50%, 0)
    position: absolute
    top: 50%
    left: 0
    border: none
    background: none

</style>
