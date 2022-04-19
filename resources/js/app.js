require('./bootstrap');

window.Vue = require("vue");
import Vue from "vue";
import './scripts/axios';
import './scripts/helpers';
import Vuetify from 'vuetify';
import VueToastr from 'vue-toastr';
import VueRouter from 'vue-router';
import 'vuetify/dist/vuetify.min.css';
import { store } from "./scripts/store";
import { router } from './scripts/routes';
import Notifications from 'vue-notification';
import { Form, HasError, AlertError } from 'vform';

Vue.use(Vuetify)
Vue.use(VueToastr);
Vue.use(VueRouter);
Vue.use(Notifications)

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify: new Vuetify(),
});