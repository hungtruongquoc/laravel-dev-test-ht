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

if (document.getElementById('request-list')) {
  const requestList = new Vue({
    el: '#request-list',
    name: 'RequestList',
    methods: {
      onDeletionCompleted({data: {id}}) {
        if (id) {
          this.$msgbox({
            title: 'Request Completed',
            message: `Request ${id} is deleted.`,
            type: 'success',
            confirmButtonText: 'OK',
            showClose: false
          });
        }
      },
      onDeletionFailed(itemId) {
        return ({response: {data: {message}}}) => {
          this.$msgbox({
            title: 'Request Failed',
            message: `Request ${itemId} cannot be deleted. Error: ${message}.`,
            type: 'error',
            showClose: false,
            confirmButtonText: 'OK'
          });
        };
      },
      performDelete(itemId) {
        this.$http.delete('/service-requests/' + itemId)
          .then(this.onDeletionCompleted.bind(this))
          .catch(this.onDeletionFailed(itemId).bind(this));
      },
      deleteItem(event) {
        const message = 'This will permanently delete request ' + event.target.dataset.itemId + '. Continue?';
        this.$confirm(message, 'Warning', {
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          type: 'warning',
          showClose: false
        }).then(this.performDelete.bind(this, event.target.dataset.itemId)).catch(() => {});
        event.preventDefault();
      }
    }
  });
}

if(document.getElementById('app')) {
  const app = new Vue({
    el: '#app',
    name: 'Page',
    data() {
      return {
        modelList: null,
        makeList: null,
        selectedMake: 1,
        selectedModel: null,
        client_name: null,
        client_email: null,
        description: null,
        client_phone: null,
        currentId: null
      };
    },
    mounted() {
      this.loadSelectInitialList();
      this.loadPreviousValues();
      if (this.selectedMake) {
        this.loadModels(this.selectedMake);
      }
      this.loadCurrentRequest();
    },
    methods: {
      loadCurrentRequest() {
        const currentRequestEl = document.getElementById('current-request');
        if (currentRequestEl) {
          const {client_name, client_email, client_phone, description, id} = JSON.parse(currentRequestEl.value);
          this.client_name = client_name;
          this.client_email = client_email;
          this.client_phone = client_phone;
          this.description = description;
          this.currentId = id;
        }
      },
      loadSelectInitialList() {
        // Load initial select list if the data property is set
        const elementList = [...document.getElementsByClassName('select-input')];
        elementList.forEach(element => {
          if (element && element.dataset && element.dataset.list && element.dataset.property) {
            this[element.dataset.property] = JSON.parse(element.dataset.list);
          }
        });
      },
      loadPreviousValues() {
        const fields = ['client_name', 'client_email', 'description', 'client_phone'];
        fields.forEach(this.setPreviousValue.bind(this));
      },
      setPreviousValue(fieldName) {
        const previousHiddenInput = document.getElementById('previous-' + fieldName);
        if (previousHiddenInput && previousHiddenInput.value) {
          this[fieldName] = previousHiddenInput.value;
        }
      },
      onGetModelSuccess({data: {data}}) {
        this.modelList = JSON.parse(JSON.stringify(data));
        if (this.modelList && this.modelList.length > 0) {
          this.selectedModel = this.modelList[0].id;
        }
      },
      onGetModelFailed() {
        this.modelList = null;
      },
      loadModels(makeId) {
        this.$http.get('/vehicle-model?make=' + makeId)
          .then(this.onGetModelSuccess.bind(this))
          .catch(this.onGetModelFailed.bind(this));
      },
      checkFormValidity(e) {
        if (this.hasValidForm) {
          return true;
        }
        e.preventDefault();
      }
    },
    computed: {
      hasInvalidName() {
        return !this.client_name || this.client_name.length > 200;
      },
      hasInvalidForm() {
        return !this.selectedModel || !this.selectedMake || this.hasInvalidDescription || this.hasInvalidName
          || this.hasInvalidEmail || this.hasInvalidPhone;
      },
      hasInvalidEmail() {
        return !this.client_email || this.client_email.match(/^.+@[^\.].*\.[a-z]{2,}$/g) === null;
      },
      hasValidForm() {
        return !this.hasInvalidForm;
      },
      hasInvalidPhone() {
        return !this.client_phone;
      },
      hasInvalidDescription() {
        return !this.description || this.description.length > 10000 ||
          this.description.match(/^[a-zA-Z\s]*$/g) === null;
      }
    }
  });
}

