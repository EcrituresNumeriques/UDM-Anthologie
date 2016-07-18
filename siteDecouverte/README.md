# Site Découverte

> A Vue.js project

## Build Setup

``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build
```

In src/main.js: Don't forget to change global.apiAuth and global.api to the api url as well as clientId, clientSecret, username and password to get the token
In the same file, global.langFr allow the site to get content from the api in french. The filter is the id of the language, so don't forget to put french language first in the DB/Api otherwise content of this site won't be in french.

In src/service/theme.js: You also have to change global.theme to site url to get themes

For detailed explanation on how things work, checkout the [guide](http://vuejs-templates.github.io/webpack/) and [docs for vue-loader](http://vuejs.github.io/vue-loader).
