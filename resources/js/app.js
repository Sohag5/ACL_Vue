require('./bootstrap');
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import {routes} from './routes';
import StoreData from './store';
import MainApp from './components/MainComponent.vue'
import {initialize} from './helpers/general';
import Mixin from './mixin';

import VueToast from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-default.css';
Vue.use(VueToast, {duration: 5000, dismissible: true, position: 'top-right'});




import VeeValidate from 'vee-validate';
Vue.use(VeeValidate, {
    events: 'input',
    fieldsBagName : '',
});



Vue.use(VueRouter);
Vue.use(Vuex);




const store = new Vuex.Store(StoreData);

const router = new VueRouter({
    routes,
    mode: 'history'
});

initialize(store, router);
Vue.mixin(Mixin);


import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);
import 'advanced-laravel-vue-paginate/dist/advanced-laravel-vue-paginate.css';
Vue.use(require('advanced-laravel-vue-paginate'));


const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        MainApp
    }
});
