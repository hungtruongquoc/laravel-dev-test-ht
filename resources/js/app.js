/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');
import axios from 'axios';
import VueAxios from 'vue-axios';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import RequestListPage from './pages/RequestList';
import RequestForm from './pages/RequestForm';

window.Vue = require('vue');
// Set up the base URL for axios
Vue.use(VueAxios, axios.create({baseURL: '/api'}));
Vue.use(ElementUI);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('app-select', require('./components/DropdownComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const navbar = new Vue({
//   el: '#navbarNav',
//   name: 'Navbar',
//   methods: {
//     logout(event) {
//       event.preventDefault();
//       this.$http.post(event.target.href);
//     }
//   }
// });

if (document.getElementById('request-list')) {
  const requestList = new Vue(RequestListPage);
}

if (document.getElementById('app')) {
  const app = new Vue(RequestForm);
}

