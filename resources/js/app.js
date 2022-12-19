require('./bootstrap');

import Vue from 'vue';
import App from './components/App.vue';

import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faPenToSquare, faTrashCan, faPlus } from '@fortawesome/free-solid-svg-icons';

library.add(faPenToSquare, faTrashCan, faPlus);
Vue.component('font-awesome-icon', FontAwesomeIcon)

const app = new Vue({
    el: "#app",
    components: { App }
});
