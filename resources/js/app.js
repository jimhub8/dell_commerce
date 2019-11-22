
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.eventBus = new Vue()
import VueRouter from 'vue-router'
import Vuetify from 'vuetify'
import VueScrollTo from 'vue-scrollto'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
// import '@fortawesome/fontawesome-free/css/all.css' // Ensure you are using css-loader
import 'vuetify/dist/vuetify.min.css'
import * as VueGoogleMaps from 'vue2-google-maps'

// import ElementUI from 'element-ui';
// import 'element-ui/lib/theme-chalk/index.css';
// import lang from 'element-ui/lib/locale/lang/en'
// import locale from 'element-ui/lib/locale'
// import VueCarousel from 'vue-carousel';
// import VueLazyload from 'vue-lazyload'
// import JsonExcel from 'vue-json-excel'
// // // import CKEditor from '@ckeditor/ckeditor5-vue';
// import VueGoodTablePlugin from 'vue-good-table';

// import the styles
// import 'vue-good-table/dist/vue-good-table.css'
import StoreData from './store/store'

// Vue.use(VueGoodTablePlugin);
// Vue.use(ElementUI, { locale });

// Vue.use(VueLazyload)
// Vue.use(VueCarousel);
Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyBNzKeF6ZwxlAOUCyeH8UxvvYRHP_w_Guk',
        libraries: ['geometry', 'places'],
        // libraries: 'places',
    },
})
Vue.use(Vuetify)
Vue.use(VueRouter)
Vue.use(VueScrollTo, {
    container: "body",
    duration: 500,
    easing: "ease",
    offset: 0,
    force: true,
    cancelable: true,
    onStart: false,
    onDone: false,
    onCancel: false,
    x: false,
    y: true
})
// Vue.component('downloadExcel', JsonExcel)
// Vue.use(CKEditor);
import Vuex from 'vuex'
Vue.use(Vuex)
const store = new Vuex.Store(StoreData)
// import VueSwal from 'vue-swal'

// Vue.use(VueSwal)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


// Vue.component('example-component', require('./components/ExampleComponent.vue'));


// import myHeader from './components/include/Header.vue';
import myNavmenu from './components/include/Menu.vue';
import myRegister from './components/register/Register.vue';
import myFooter from './components/include/Footer.vue';
import myNav from './components/include/Headervue';
// import myProduct from './components/product/Sliders.vue';
import myHome from './components/home/Home.vue';
import productDetail from './components/Shop/Details';
import myShop from './components/Shop/Shop.vue';
import myCartHome from './components/cart/CartHome.vue';
// import myAbout from './components/about/About.vue';
import myFilter from './components/filter/Filter.vue';
import mywishList from './components/wish/Wish.vue';
import CategoryFilter from './components/filter/Category.vue';
import SearchP from './components/Shop/Search';
import myThanks from './components/Shop/Thankyou';
// import myunauth from './components/Unauthorized.vue';

import myFaq from './components/content/faq';
// import myPrivacy from './components/content/privacy';

// Clients
import myCheckout from './components/checkout'
// import myAccount from './components/client/Client';

import myAccount from './components/account';

const routes = [
    // { path: '/example', component: exampleComponent },

    { path: '/', component: myHome },
    { path: '/filter', component: myFilter },
    // { path: '/profile', component: myProfile },
    // { path: '/products', component: myProduct },
    { path: '/shop', component: myShop },
    { path: '/wishList', component: mywishList },
    { path: '/cartHome', component: myCartHome },
    // { path: '/about', component: myAbout },
    { path: '/details/:id', component: productDetail, name: 'details' },
    { path: '/category/:id', component: CategoryFilter, name: 'Category' },
    { path: '/search/:search', component: SearchP, name: 'search' },
    { path: '/thankyou', component: myThanks, name: 'thankyou' },
    // { path: '/unauthorized', component: myunauth },
    { path: '/account', component: myAccount },
    { path: '/checkout', component: myCheckout, name: 'checkout' },

    // { path: '/privacy', component: myPrivacy },
    { path: '/help_center', component: myFaq },


    // Clients
    // { path: '/myOrders', component: myClientOrders },



]
const router = new VueRouter({
    // mode: 'history',
    routes // short for `routes: routes`
})
const app = new Vue({
    el: '#app',
    store,
    router,
    components: {
        myNavmenu, myRegister, myFooter, myHome, productDetail, myShop, myCartHome, myFilter, mywishList, CategoryFilter, SearchP, myThanks, myAccount, myNav, myFaq,

        // , myunauth, myPrivacy
    },
});
