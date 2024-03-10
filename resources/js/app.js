import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify';
import Router from 'vue-router';
import App from './App.vue';
import router from './router';
import 'vuetify/dist/vuetify.min.css';
import '@mdi/font/css/materialdesignicons.css';

const vuetify = new Vuetify({
  defaultSet: 'mdi',
});

Vue.use(Vuetify);
Vue.use(Router);

export default new Vue({
  router,
  vuetify,
  render: (h) => h(App),
}).$mount('#app');
