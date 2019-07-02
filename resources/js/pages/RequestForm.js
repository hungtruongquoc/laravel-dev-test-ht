import RedirectMixin from '../mixins/Redirect';

export default {
  el: '#app',
  name: 'Page',
  data() {
    return {
      modelList: null,
      makeList: null,
      selectedMake: null,
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
  mixins: [RedirectMixin],
  methods: {
    loadCurrentRequest() {
      const currentRequestEl = document.getElementById('request-form');
      if (currentRequestEl && currentRequestEl.dataset.currentRequest) {
        const currentRequest = JSON.parse(currentRequestEl.dataset.currentRequest);
        const {client_name, client_email, client_phone, description, id, vehicle_model_id} = currentRequest;
        this.client_name = client_name;
        this.client_email = client_email;
        this.client_phone = client_phone;
        this.description = description;
        this.currentId = id;
        this.selectedModel = parseInt(vehicle_model_id);
        this.selectedMake = parseInt(currentRequest.vehicle_model.vehicle_make_id);
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
      if (!this.selectedMake) {
        this.selectedMake = this.makeList[0].id;
      }
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
};
