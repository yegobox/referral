window.Vue = require("vue");
// window.VeeValidate = require("vee-validate");
window.axios = require("axios");
require("./bootstrap");
// require("ez-plus/src/jquery.ez-plus.js");
// locales = require("./lang/locales.js");


import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);

Vue.prototype.$http = axios
import VoerroTagsInput from '@voerro/vue-tagsinput';
Vue.component('tags-input', VoerroTagsInput);
window.eventBus = new Vue();

Vue.component("referral", require("./components/Referral.vue"));
Vue.component("list", require("./components/List.vue"));

new Vue({
    el: "#referral",
    components: { "v-tags-input": VoerroTagsInput },
});