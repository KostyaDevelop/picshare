import Vue from 'vue'
import App from './App.vue'
import store from  './store'
import router from './routes'
import VueRouter from 'vue-router'
import axios from "axios";
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

axios.defaults.baseURL = process.env.VUE_APP_BASE_URL
axios.defaults.headers.common['Content-Type'] = 'application/x-www-form-urlencoded'
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

Vue.prototype.$store = store

Vue.use(VueRouter);
Vue.use(BootstrapVue)
Vue.config.productionTip = false

new Vue({
  render: h => h(App),
  store,
  router,
}).$mount('#app')
