<template>
    <div class="doc">
        <div class="row">
            <div class="doc-nav col-sm-4 col-md-3">
                <nav class="navbar doc-nav">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <span class="glyphicon glyphicon-menu-down"></span>
                            <span class="glyphicon glyphicon-menu-up"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="myNavbar">
                        <ul class="nav navbar-nav">
                            <li class="col-md-12" v-for="nav in data.nav">
                                <a id="nav-title" v-link="{ name: 'doc', params: { section: nav.slug }}" v-on:click="getRelatedJson(nav.link)">{{ nav.title | capitalize }}</a>
                                <ul>
                                    <li v-for="subtitle in nav.subtitle">
                                        <a href="#{{ subtitle.slug }}">{{ subtitle.name }}</a>
                                    </li>
                                </uL>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <doc-content :data-content="dataContent" ></doc-content>
        </div>
    </div>
</template>

<script>
import DocContent from './doc-content.vue'
import Vue from 'vue'

export default {
    
    components: {
        DocContent  
    }, 
    name: "doc",
    data () {
        return {
        data: {},
        dataContent : {},
        url: 'notes.json'
        }
    },
  
    methods: {
        getRelatedJson: function(url){
            
            var self = this

            Vue.resource(api.baseUrl+url).get().then(function(response){
                
                self.dataContent = response.data
                    
                }, function(response){console.log(response.status)
            })
            
        }
    },
   
    ready: function() {

        var self = this

       api.dataNav.get().then(function(response){

            self.$set('data', response.data)
        
        }, function(response){console.log(response.status)
        })
       this.getRelatedJson(this.url)
       

    }
}

</script>



