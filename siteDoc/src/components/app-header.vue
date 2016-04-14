<template>
    <div class="app-header">
        <div class="row">
            <nav class="navbar">
                <div class="hidden-xs hidden-sm navbar-header">
                    <a class="navbar-brand" v-link="{ path : '/home' }">Anthologie palatine</a>
                </div>
                <div class="nav navbar-nav navbar-right">
                    <ul class="list-inline col-xs-9 col-md-10 text-right">
                        <li><a v-link="{ path : '/home' }" v-link-active>Accueil</a></li>
                        <li><a v-link="{ path : '/documentation' }">Documentation</a></li>
                        <li class="hidden-xs hidden-sm"><a href="#">Accès API</a></li>
                        <li class="hidden-xs hidden-sm"><a href="#">Exemple</a></li>
                    </ul>
                    <div class="col-xs-3 col-md-2">
                        <select name="lang" id="lang" class="form-control">
                            <option value="fr">Fr</option>
                            <option value="en">En</option>
                        </select>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>

<style lang="sass">
$default-color: #366870;
$bg-color: #e6e6e6;

body{
    background: $bg-color;
}
    
.app-header{
    height: 60px;
    line-height: 60px;
    border-bottom: 1px solid $default-color;
    margin: 0 -15px;
    background: #fff;
      
    .navbar-header{
        padding-left: 50px;
          
        .navbar-brand{
            color: $default-color;
            font-weight: 700;
            transition: .2s all linear;
            font-size: 28px;
              
            &:hover,
            &:focus{
                text-decoration: none;
                opacity: .8;
            }
        }
    }
      
    ul{
        padding: 0;
          
        li{
              
            a{
                font-size: 16px;                                      
                color: #000;
                border-bottom: 2px solid transparent;
                transition: .2s all linear;
                margin: 0;   
                               
                &:hover,
                &:focus,
                &.v-link-active{
                    text-decoration: none;
                    border-bottom: 2px solid $default-color;
                    color: #000; 
                }
            }
                
            @media (min-width: 992px) { 
                
                a{
                    font-size: 24px;
                    margin: 0 12px;
                }                
            }
        }
    }
      
    select.form-control{
        border: none;
        opacity: 0.5;
        display: inline-block;
        font-size: 18px;
        width: 72%;
        cursor: pointer;
        padding: 0;
    }
    
    @media (min-width: 768px) {
        
        .navbar-right{
            width: 100%;
        }   
        
        select.form-control{
            width: 50%;                        
        }           
    }
    
    @media (min-width: 992px) {
        
        .navbar-right{
            width: 60%;
        }
        
        select.form-control{
            width: 50%;   
        }
    }
} 

</style>