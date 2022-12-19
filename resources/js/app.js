require('./bootstrap');

// https://techvblogs.com/blog/how-to-install-vue3-laravel
import { createApp } from 'vue'
import Catalogue from './components/catalogue/Index'
// import Panier from './components/panier/Index'
import BtnAjouter from './components/btnAjouter/Index'
import IconPanier from './components/iconPanier/Index'
// import Voiture from './components/catalogue/Voiture'

const app = createApp({})

app.component('catalogue', Catalogue)
// app.component('panier', Panier)
app.component('btnajouter', BtnAjouter)
app.component('iconpanier', IconPanier)
// app.component('voiture', Voiture)

app.mount('#app')

