<template>
    <div class="doc-content col-sm-8 col-md-9">
        <div class="content-container">
            <div class="title-container">
                <h3>{{ dataContent.title }}</h3>
            </div>
            <div class="subtitle-wrapper" v-for="section in dataContent.section">
                <div class="subtitle-container">
                    <h4 id="{{ section.slug }}">{{ section.subtitle }}</h4>
                </div>
                <div class="text-container">
                    <code><span class="text-uppercase">{{ section.method }} </span><em>{{ section.url.mandatory }}</em> <span class="opt"><em v-for="opt in section.url.opt">{{ opt }} </em></span></code>
                    <p>{{ section.desc }}</p>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <caption>Paramètres</cpation>
                                <thead>
                                    <tr>
                                        <th>Champs</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody v-for="param in section.param">
                                    <tr v-for="mandatory in param.mandatory">
                                        <td>{{ mandatory.field }}</td>
                                        <td>{{ mandatory.type }}</td>
                                        <td>{{ mandatory.desc }}</td>
                                    </tr>
                                    <tr v-for="opt in param.opt" class="table-opt">
                                        <td>{{ opt.field }}</td>
                                        <td>{{ opt.type }}</td>
                                        <td>(facultatif) {{{ opt.desc }}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" v-if="section.reponses.success.length">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <caption>Success</cpation>
                                <thead>
                                    <tr>
                                        <th>Champs</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="success in section.reponses.success">
                                        <td>{{ success.field }}</td>
                                        <td>{{ success.type }}</td>
                                        <td>{{ success.desc }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'

export default {
    
  props: {
    dataContent: Object
  },
  
  data () {
    return {
      data: {}
    }
  }
}
</script>

<style lang="sass">
$default-color: #366870
$bg-code: #434343
$grey: #848484

.doc
  position: relative
  margin: 0 -15px    
  >.row
    padding-top: 5%

nav.doc-nav
  margin: 0    
  .navbar-header        
    button            
      .glyphicon
        font-size: 30px           
      .glyphicon-menu-down
        display: initial   
      .glyphicon-menu-up
        display: none  
      &[aria-expanded="true"]
        .glyphicon-menu-down
          display: none
        .glyphicon-menu-up
          display: initial
    
  .navbar-collapse
    border-bottom: 1px solid $default-color
    padding: 0 10% 10%
    margin-bottom: 10%        
    ul            
      li
        margin: 5% 0
        padding: 0                
        a
          font-size: 24px
          font-weight: 700
          color: $grey
          transition: .2s all linear                    
          &:hover,
          &.v-link-active
            color: $default-color
            text-decoration: none   
          &.v-link-active
            ~ul
              display: block
        ul
          list-style: none
          display: none
          li
            a
              font-size: 15px
              font-weight: 400
              color: $default-color
              opacity: .4
              &:hover
                opacity: 1
                
  @media (min-width: 768px)
    .navbar-collapse
      border: none
      
.content-container
  padding: 0 10%
  margin-bottom: 50px    
  .subtitle-container,
  .text-container
    margin: 5% 0
  .title-container
    margin: 0 0 10%
    h3
      font-size: 36px
      font-weight: 700
      margin-top: 0
    
  .subtitle-container
    h4
      font-size: 24px  
                
  table
    td
      opacity: .6
      tr.table-opt
        color: #4c949f
        opacity: 1
        
  .text-container        
    p
      font-size: 16px
      color: #000
      line-height: 1.6
      margin: 5% 0 10%      
    code
      background: $bg-code
      border-radius: 0
      color: #fff
      padding: 2% 5%
      font-family: 'Inconsolata', sans-serif
      width: 100%
      display: inline-block
      overflow-x: scroll
      white-space: nowrap
      font-size: 18px      
      .opt
        color: #4c949f

</style>