import Vue from 'vue'
// vue-router for routing ...
import VueRouter from 'vue-router'

// import components
import Home from '../components/HomeComponent.vue'
import Credits from '../components/CreditsComponent'
import Summary from '../components/SummaryComponent'
import Genres from '../components/GenresComponent'
import Authors from '../components/AuthorsComponent'
import Characters from '../components/CharactersComponent'
import EpigramTheme from '../components/EpigramThemeComponent'
import EpigramApi from '../components/EpigramApiComponent'
import SearchGenreComponent from '../components/SearchGenreComponent'
import SearchAuthorComponent from '../components/SearchAuthorComponent'
import SearchEraComponent from '../components/SearchEraComponent'
import SearchCityComponent from '../components/SearchCityComponent'
import SearchCharacterComponent from '../components/SearchCharacterComponent'
import NotFound from '../components/404Component'

Vue.use(VueRouter)

export default new VueRouter({
  routes: [
    {
      path: '/',
      component: Home
    },
    {
      path: '/accueil',
      component: Home,
      name: 'home'
    },
    {
      path: '/credits',
      component: Credits,
      name: 'credits'
    },
    {
      path: '/sommaire',
      component: Summary,
      name: 'summary'
    },
    {
      path: '/genres',
      component: Genres,
      name: 'genres'
    },
    {
      path: '/auteurs',
      component: Authors,
      name: 'authors'
    },
    {
      path: '/personnages',
      component: Characters,
      name: 'characters'
    },
    {
      path: '/epigramme/:id',
      component: EpigramApi,
      name: 'epigram'
    },
    {
      path: 'theme/:themeId/:theme/:id',
      component: EpigramTheme,
      name: 'theme'
    },
    {
      path: 'recherche/genre/:id',
      component: SearchGenreComponent,
      name: 'searchGenre'
    },
    {
      path: 'recherche/auteur/:id',
      component: SearchAuthorComponent,
      name: 'searchAuthor'
    },
    {
      path: 'recherche/ere/:id',
      component: SearchEraComponent,
      name: 'searchEra'
    },
    {
      path: 'recherche/ville/:id',
      component: SearchCityComponent,
      name: 'searchCity'
    },
    {
      path: 'recherche/personnage/:id',
      component: SearchCharacterComponent,
      name: 'searchCharacter'
    },
    {
      path: '/404',
      component: NotFound,
      name: 'NotFound'
    },
    {
      path: '*',
      redirect: '404'
    }
  ],
  history: false,
  type: 'hash'
})
